<?php

namespace App\Services;

use App\Models\MediaAsset;
use App\Models\MediaUsage;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class WatermarkService
{
    /**
     * Path to the official ATStekno transparent emblem logo.
     */
    protected static function getLogoPath(): string
    {
        return public_path('images/ats-logo.png');
    }

    /**
     * Create a resized, alpha-modulated stamp from the source logo.
     *
     * @param  \GdImage  $srcLogo
     * @param  int       $targetW
     * @param  int       $targetH
     * @param  float     $opacity  (0.0 = invisible, 1.0 = full source opacity)
     * @return \GdImage
     */
    protected static function createLogoStamp($srcLogo, int $targetW, int $targetH, float $opacity)
    {
        $stamp = imagecreatetruecolor($targetW, $targetH);
        imagealphablending($stamp, false);
        imagesavealpha($stamp, true);

        $transparent = imagecolorallocatealpha($stamp, 0, 0, 0, 127);
        imagefill($stamp, 0, 0, $transparent);

        imagecopyresampled($stamp, $srcLogo, 0, 0, 0, 0, $targetW, $targetH, imagesx($srcLogo), imagesy($srcLogo));

        // Modulate alpha channel by the desired opacity
        for ($y = 0; $y < $targetH; $y++) {
            for ($x = 0; $x < $targetW; $x++) {
                $color = imagecolorat($stamp, $x, $y);
                $origAlpha = ($color >> 24) & 0x7F; // 0 = opaque, 127 = fully transparent
                if ($origAlpha >= 127) {
                    continue;
                }

                $r = ($color >> 16) & 0xFF;
                $g = ($color >> 8) & 0xFF;
                $b = $color & 0xFF;

                $newAlpha = (int) round(127 - (127 - $origAlpha) * $opacity);
                $newAlpha = max(0, min(127, $newAlpha));

                $newColor = imagecolorallocatealpha($stamp, $r, $g, $b, $newAlpha);
                imagesetpixel($stamp, $x, $y, $newColor);
            }
        }

        return $stamp;
    }

    /**
     * Apply AI-resistant ATStekno watermark to an image file.
     *
     * Strategy against AI Watermark Removers:
     * 1. Multi-point lattice (staggered repeating grid) prevents corner-cropping or isolated patch inpainting.
     * 2. Spans across complex electrical component lines (breakers, busbars, wire runs, terminal blocks),
     *    ensuring AI removal models hallucinate/corrupt critical machine details.
     * 3. Dual-tone shadow offset disrupts boundary edge-detection algorithms.
     * 4. Balanced opacity preserves professional engineering clarity for human viewers.
     */
    public static function applyWatermark(string $imagePath, ?string $outputPath = null): bool
    {
        if (!file_exists($imagePath)) {
            return false;
        }

        $outputPath = $outputPath ?: $imagePath;
        $logoPath = self::getLogoPath();

        if (!file_exists($logoPath)) {
            Log::warning("WatermarkService: Logo not found at {$logoPath}");
            return false;
        }

        $imageInfo = @getimagesize($imagePath);
        if (!$imageInfo) {
            return false;
        }

        $mime = $imageInfo['mime'];
        $srcImg = null;

        if ($mime === 'image/jpeg') {
            $srcImg = @imagecreatefromjpeg($imagePath);
        } elseif ($mime === 'image/png') {
            $srcImg = @imagecreatefrompng($imagePath);
        } elseif ($mime === 'image/webp') {
            if (function_exists('imagecreatefromwebp')) {
                $srcImg = @imagecreatefromwebp($imagePath);
            }
        }

        if (!$srcImg) {
            return false;
        }

        $width = imagesx($srcImg);
        $height = imagesy($srcImg);

        // Load logo
        $srcLogo = @imagecreatefrompng($logoPath);
        if (!$srcLogo) {
            imagedestroy($srcImg);
            return false;
        }

        imagealphablending($srcLogo, false);
        imagesavealpha($srcLogo, true);

        // Enable alpha blending on target
        imagealphablending($srcImg, true);

        $minDim = min($width, $height);

        // 1. Primary Central Watermark (32% of min dimension)
        $centerSize = max(130, min(380, (int) round($minDim * 0.32)));
        $centerX = (int) round(($width - $centerSize) / 2);
        $centerY = (int) round(($height - $centerSize) / 2);

        $centerStamp = self::createLogoStamp($srcLogo, $centerSize, $centerSize, 0.34);
        $shadowStamp = self::createLogoStamp($srcLogo, $centerSize, $centerSize, 0.12);

        // Dual-tone offset contour (2px offset) to break single-color thresholding in AI removers
        imagecopy($srcImg, $shadowStamp, $centerX + 2, $centerY + 2, 0, 0, $centerSize, $centerSize);
        imagecopy($srcImg, $centerStamp, $centerX, $centerY, 0, 0, $centerSize, $centerSize);

        // 2. Secondary Staggered Lattice Grid (15% of min dimension, opacity 0.18)
        $gridSize = max(75, min(160, (int) round($minDim * 0.15)));
        $gridStamp = self::createLogoStamp($srcLogo, $gridSize, $gridSize, 0.18);

        $stepX = max(160, (int) round($width / 3.2));
        $stepY = max(160, (int) round($height / 3.5));

        for ($y = (int) round($stepY * 0.4); $y < $height; $y += $stepY) {
            $rowIdx = (int) round($y / $stepY);
            $offset = ($rowIdx % 2 === 1) ? (int) round($stepX * 0.5) : 0;
            for ($x = (int) round($stepX * 0.3) + $offset - $stepX; $x < $width; $x += $stepX) {
                // Skip if overlapping center primary logo
                $distFromCenter = sqrt(
                    pow(($x + $gridSize / 2) - ($centerX + $centerSize / 2), 2) +
                    pow(($y + $gridSize / 2) - ($centerY + $centerSize / 2), 2)
                );
                if ($distFromCenter < ($centerSize * 0.72)) {
                    continue;
                }

                if ($x >= -($gridSize / 2) && $x < $width && $y >= -($gridSize / 2) && $y < $height) {
                    imagecopy($srcImg, $gridStamp, $x, $y, 0, 0, $gridSize, $gridSize);
                }
            }
        }

        // Save output in appropriate format
        $ext = strtolower(pathinfo($outputPath, PATHINFO_EXTENSION));
        $success = false;

        if ($ext === 'jpg' || $ext === 'jpeg' || $mime === 'image/jpeg') {
            $success = imagejpeg($srcImg, $outputPath, 92);
        } elseif ($ext === 'webp' || $mime === 'image/webp') {
            if (function_exists('imagewebp')) {
                $success = imagewebp($srcImg, $outputPath, 92);
            }
        } elseif ($ext === 'png' || $mime === 'image/png') {
            imagesavealpha($srcImg, true);
            $success = imagepng($srcImg, $outputPath, 8);
        }

        // Cleanup GD resources
        imagedestroy($srcImg);
        imagedestroy($srcLogo);
        imagedestroy($centerStamp);
        imagedestroy($shadowStamp);
        imagedestroy($gridStamp);

        return $success;
    }

    /**
     * Apply watermark to a MediaAsset file stored in Laravel Storage.
     */
    public static function applyToMediaAsset(MediaAsset $media): bool
    {
        if ($media->media_type !== 'image') {
            return false;
        }

        $cacheKey = "ats_watermarked_asset_{$media->id}";
        if (Cache::has($cacheKey)) {
            return true;
        }

        $disk = Storage::disk($media->disk);
        if (!$disk->exists($media->file_path)) {
            return false;
        }

        $fullPath = $disk->path($media->file_path);
        $ok = self::applyWatermark($fullPath);

        if ($ok && file_exists($fullPath)) {
            clearstatcache(true, $fullPath);
            $info = @getimagesize($fullPath);
            $media->update([
                'file_size' => filesize($fullPath),
                'width' => $info ? $info[0] : $media->width,
                'height' => $info ? $info[1] : $media->height,
                'checksum' => hash_file('sha256', $fullPath),
            ]);
            Cache::forever($cacheKey, true);
            return true;
        }

        return false;
    }

    /**
     * Watermark all existing project images in the system:
     * - public/images/projects/*
     * - public/uploads/panel-projects/*
     * - MediaAsset records attached to Project models
     */
    public static function watermarkAllProjectImages(): array
    {
        $processed = [];
        $failed = [];

        // 1. Static project images in public/images/projects
        $staticProjDir = public_path('images/projects');
        if (is_dir($staticProjDir)) {
            foreach (scandir($staticProjDir) as $file) {
                if ($file === '.' || $file === '..') continue;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $path = $staticProjDir . DIRECTORY_SEPARATOR . $file;
                    if (self::applyWatermark($path)) {
                        $processed[] = "public/images/projects/{$file}";
                    } else {
                        $failed[] = "public/images/projects/{$file}";
                    }
                }
            }
        }

        // 2. Uploads in public/uploads/panel-projects
        $panelUploadDir = public_path('uploads/panel-projects');
        if (is_dir($panelUploadDir)) {
            foreach (scandir($panelUploadDir) as $file) {
                if ($file === '.' || $file === '..') continue;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $path = $panelUploadDir . DIRECTORY_SEPARATOR . $file;
                    if (self::applyWatermark($path)) {
                        $processed[] = "public/uploads/panel-projects/{$file}";
                    } else {
                        $failed[] = "public/uploads/panel-projects/{$file}";
                    }
                }
            }
        }

        // 3. MediaAssets attached to Project
        try {
            $projectCoverIds = Project::whereNotNull('cover_image_id')->pluck('cover_image_id')->all();
            $projectGalleryIds = MediaUsage::where('model_type', Project::class)->pluck('media_id')->all();
            $mediaIds = array_unique(array_merge($projectCoverIds, $projectGalleryIds));

            if (!empty($mediaIds)) {
                $assets = MediaAsset::whereIn('id', $mediaIds)->where('media_type', 'image')->get();
                foreach ($assets as $asset) {
                    if (self::applyToMediaAsset($asset)) {
                        $processed[] = "MediaAsset #{$asset->id} ({$asset->file_path})";
                    } else {
                        $failed[] = "MediaAsset #{$asset->id} ({$asset->file_path})";
                    }
                }
            }
        } catch (Exception $e) {
            Log::info("WatermarkService: MediaAsset scan note: " . $e->getMessage());
        }

        return [
            'success_count' => count($processed),
            'failed_count' => count($failed),
            'processed' => $processed,
            'failed' => $failed,
        ];
    }
}
