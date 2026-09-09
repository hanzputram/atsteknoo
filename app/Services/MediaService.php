<?php

namespace App\Services;

use App\Models\MediaAsset;
use App\Models\MediaUsage;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaService
{
    /**
     * Store an uploaded image or document safely into managed storage.
     */
    public static function storeUpload(UploadedFile $file, string $mediaType = 'image', ?int $userId = null): MediaAsset
    {
        $mime = $file->getMimeType();
        $size = $file->getSize();
        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());

        // Validate allowed MIME and extension
        if ($mediaType === 'image') {
            $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
            $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($mime, $allowedMimes, true) || !in_array($extension, $allowedExts, true)) {
                throw new Exception('Format gambar tidak didukung. Hanya JPG, PNG, dan WEBP yang diizinkan.');
            }

            if ($size > 10 * 1024 * 1024) {
                throw new Exception('Ukuran gambar melebihi batas maksimum 10 MiB.');
            }

            // Verify with GD
            $imageInfo = @getimagesize($file->getRealPath());
            if (!$imageInfo) {
                throw new Exception('File gambar rusak atau tidak dapat di-decode.');
            }

            $width = $imageInfo[0];
            $height = $imageInfo[1];
        } else {
            // PDF document
            if ($mime !== 'application/pdf' || $extension !== 'pdf') {
                throw new Exception('Format dokumen tidak valid. Hanya berkas PDF yang diizinkan.');
            }

            if ($size > 20 * 1024 * 1024) {
                throw new Exception('Ukuran PDF melebihi batas maksimum 20 MiB.');
            }

            $width = null;
            $height = null;
        }

        // Calculate SHA-256 checksum
        $checksum = hash_file('sha256', $file->getRealPath());

        // Check for existing deduplicated asset
        $existing = MediaAsset::where('checksum', $checksum)->first();
        if ($existing && Storage::disk($existing->disk)->exists($existing->file_path)) {
            return $existing;
        }

        // Store file with randomized name
        $subfolder = $mediaType === 'image' ? 'media/images' : 'media/docs';
        $randomName = Str::random(40) . '.' . $extension;
        $filePath = $file->storeAs($subfolder, $randomName, 'public');

        return MediaAsset::create([
            'disk' => 'public',
            'file_path' => $filePath,
            'original_name' => $originalName,
            'mime_type' => $mime,
            'file_size' => $size,
            'width' => $width,
            'height' => $height,
            'checksum' => $checksum,
            'media_type' => $mediaType,
            'uploaded_by' => $userId ?? auth()->id(),
        ]);
    }

    /**
     * Ingest a staged file (e.g. from Google Drive download) into media assets.
     */
    public static function storeStagedFile(string $stagedPath, string $originalName, ?int $userId = null): MediaAsset
    {
        if (!file_exists($stagedPath)) {
            throw new Exception("File staging tidak ditemukan: {$stagedPath}");
        }

        $checksum = hash_file('sha256', $stagedPath);

        // Deduplication check
        $existing = MediaAsset::where('checksum', $checksum)->first();
        if ($existing && Storage::disk($existing->disk)->exists($existing->file_path)) {
            @unlink($stagedPath);
            return $existing;
        }

        $imageInfo = @getimagesize($stagedPath);
        if (!$imageInfo) {
            @unlink($stagedPath);
            throw new Exception("File staging bukan gambar raster yang valid.");
        }

        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $mime = $imageInfo['mime'];
        $size = filesize($stagedPath);

        $extension = match ($mime) {
            'image/png' => 'png',
            'image/webp' => 'webp',
            default => 'jpg',
        };

        $randomName = Str::random(40) . '.' . $extension;
        $destinationRelative = 'media/images/' . $randomName;

        // Move into public storage
        Storage::disk('public')->put($destinationRelative, file_get_contents($stagedPath));
        @unlink($stagedPath);

        return MediaAsset::create([
            'disk' => 'public',
            'file_path' => $destinationRelative,
            'original_name' => $originalName,
            'mime_type' => $mime,
            'file_size' => $size,
            'width' => $width,
            'height' => $height,
            'checksum' => $checksum,
            'media_type' => 'image',
            'uploaded_by' => $userId ?? auth()->id(),
        ]);
    }

    /**
     * Attach a media asset to a model with collection and metadata.
     */
    public static function attach(
        int $mediaId,
        string $modelType,
        int $modelId,
        string $collection = 'gallery',
        int $sortOrder = 0,
        ?string $altText = null,
        ?string $caption = null
    ): MediaUsage {
        return MediaUsage::create([
            'media_id' => $mediaId,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'collection_name' => $collection,
            'sort_order' => $sortOrder,
            'alt_text' => $altText,
            'caption' => $caption,
        ]);
    }

    /**
     * Check if a media asset can be safely deleted.
     */
    public static function canDelete(MediaAsset $media): array
    {
        $usageCount = $media->usages()->count();
        if ($usageCount > 0) {
            return [
                'can_delete' => false,
                'reason' => "Media masih digunakan oleh {$usageCount} entitas lain.",
            ];
        }

        return ['can_delete' => true, 'reason' => ''];
    }

    /**
     * Safely delete a media asset.
     */
    public static function delete(MediaAsset $media): bool
    {
        $check = static::canDelete($media);
        if (!$check['can_delete']) {
            throw new Exception($check['reason']);
        }

        if (Storage::disk($media->disk)->exists($media->file_path)) {
            Storage::disk($media->disk)->delete($media->file_path);
        }

        return (bool) $media->forceDelete();
    }
}
