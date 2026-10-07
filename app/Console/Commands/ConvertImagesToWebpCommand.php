<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class ConvertImagesToWebpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:convert-webp
                            {--path= : Target directory relative to project root (defaults to public and storage/app/public)}
                            {--quality=82 : WebP output quality from 1 to 100 (default: 82)}
                            {--force : Re-convert even if the .webp file already exists}
                            {--delete-original : Delete original JPG/PNG files after successful conversion}
                            {--dry-run : Scan and display files without converting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Batch convert all JPG and PNG images across public and storage directories to WebP';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        @ini_set('memory_limit', '512M');
        @set_time_limit(600);

        $hasGdWebp = function_exists('imagewebp');
        $hasImagick = extension_loaded('imagick') && in_array('WEBP', \Imagick::queryFormats());

        if (!$hasGdWebp && !$hasImagick) {
            $this->error('Neither PHP GD (with WebP support) nor Imagick (with WEBP format) is available in this PHP runtime.');
            return self::FAILURE;
        }

        $engine = $hasGdWebp ? 'PHP GD (imagewebp)' : 'ImageMagick';
        $this->info("WebP Conversion Engine: <fg=cyan>{$engine}</>");

        $quality = (int) $this->option('quality');
        if ($quality < 1 || $quality > 100) {
            $quality = 82;
        }

        $force = (bool) $this->option('force');
        $deleteOriginal = (bool) $this->option('delete-original');
        $dryRun = (bool) $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY RUN MODE: No files will be modified or deleted.');
        }

        if ($deleteOriginal && !$dryRun) {
            if (!$this->confirm('WARNING: --delete-original is enabled. Original JPG and PNG files will be permanently deleted after conversion. Are you sure you want to proceed?', false)) {
                $this->info('Aborted by user.');
                return self::SUCCESS;
            }
        }

        // Determine directories to scan
        $customPath = $this->option('path');
        $directories = [];

        if ($customPath) {
            $absCustom = base_path($customPath);
            if (is_dir($absCustom)) {
                $directories[] = $absCustom;
            } else {
                $this->error("Specified directory not found: {$customPath}");
                return self::FAILURE;
            }
        } else {
            if (is_dir(public_path())) {
                $directories[] = public_path();
            }
            $storagePublic = storage_path('app/public');
            if (is_dir($storagePublic)) {
                $directories[] = $storagePublic;
            }
        }

        // Scan images using Symfony Finder
        $finder = new Finder();
        $finder->files()
            ->in($directories)
            ->exclude(['vendor', 'node_modules', '.git', 'build', 'cache'])
            ->name('/\.(jpe?g|png)$/i');

        $files = iterator_to_array($finder, false);
        $totalFiles = count($files);

        if ($totalFiles === 0) {
            $this->info('No JPG or PNG images found in the target directories.');
            return self::SUCCESS;
        }

        $this->info("Found <fg=yellow>{$totalFiles}</> candidate images. Quality: <fg=yellow>{$quality}</>");

        $convertedCount = 0;
        $skippedCount = 0;
        $failedCount = 0;
        $totalOriginalBytes = 0;
        $totalWebpBytes = 0;

        $bar = $this->output->createProgressBar($totalFiles);
        $bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% -- %message%');
        $bar->setMessage('Starting...');
        $bar->start();

        foreach ($files as $file) {
            $sourcePath = $file->getRealPath();
            $relPath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $sourcePath);
            $ext = strtolower($file->getExtension());
            $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $sourcePath);

            $origSize = filesize($sourcePath);

            // Skip if .webp already exists and not forcing
            if (!$force && file_exists($webpPath) && filesize($webpPath) > 0) {
                $skippedCount++;
                $bar->setMessage("Skipping (already exists): {$file->getFilename()}");
                $bar->advance();
                continue;
            }

            if ($dryRun) {
                $convertedCount++;
                $bar->setMessage("Dry run: {$file->getFilename()}");
                $bar->advance();
                continue;
            }

            $success = false;

            try {
                if ($hasGdWebp) {
                    $success = $this->convertWithGd($sourcePath, $webpPath, $ext, $quality);
                } elseif ($hasImagick) {
                    $success = $this->convertWithImagick($sourcePath, $webpPath, $quality);
                }
            } catch (\Throwable $e) {
                $success = false;
            }

            if ($success && file_exists($webpPath) && filesize($webpPath) > 0) {
                $convertedCount++;
                $webpSize = filesize($webpPath);
                $totalOriginalBytes += $origSize;
                $totalWebpBytes += $webpSize;

                if ($deleteOriginal && $sourcePath !== $webpPath) {
                    @unlink($sourcePath);
                }

                $bar->setMessage("Converted: {$file->getFilename()}");
            } else {
                $failedCount++;
                $bar->setMessage("<fg=red>Failed:</> {$file->getFilename()}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Summary report
        $this->info('====================================================');
        $this->info('           WebP Conversion Summary                  ');
        $this->info('====================================================');
        $this->line("  Total Candidates : {$totalFiles}");
        $this->line("  Converted        : <fg=green>{$convertedCount}</>");
        $this->line("  Skipped          : <fg=yellow>{$skippedCount}</>");
        if ($failedCount > 0) {
            $this->line("  Failed           : <fg=red>{$failedCount}</>");
        }

        if ($convertedCount > 0 && !$dryRun) {
            $savedBytes = max(0, $totalOriginalBytes - $totalWebpBytes);
            $pctSaved = $totalOriginalBytes > 0 ? round(($savedBytes / $totalOriginalBytes) * 100, 1) : 0;

            $origMb = round($totalOriginalBytes / 1048576, 2);
            $webpMb = round($totalWebpBytes / 1048576, 2);
            $savedMb = round($savedBytes / 1048576, 2);

            $this->newLine();
            $this->line("  Original Size    : {$origMb} MB");
            $this->line("  WebP Size        : {$webpMb} MB");
            $this->line("  Space Saved      : <fg=green>{$savedMb} MB ({$pctSaved}% reduction)</>");
        }

        $this->newLine();
        return self::SUCCESS;
    }

    /**
     * Convert an image using PHP GD.
     */
    protected function convertWithGd(string $source, string $target, string $ext, int $quality): bool
    {
        $image = null;

        if ($ext === 'jpg' || $ext === 'jpeg') {
            $image = @imagecreatefromjpeg($source);
        } elseif ($ext === 'png') {
            $image = @imagecreatefrompng($source);
            if ($image) {
                // Ensure proper alpha transparency preservation
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
            }
        }

        if (!$image) {
            return false;
        }

        $result = @imagewebp($image, $target, $quality);
        imagedestroy($image);

        return $result;
    }

    /**
     * Convert an image using ImageMagick extension.
     */
    protected function convertWithImagick(string $source, string $target, int $quality): bool
    {
        $imagick = new \Imagick($source);
        $imagick->setImageFormat('webp');
        $imagick->setImageCompressionQuality($quality);
        $imagick->setOption('webp:method', '6');
        $result = $imagick->writeImage($target);
        $imagick->clear();
        $imagick->destroy();

        return $result;
    }
}
