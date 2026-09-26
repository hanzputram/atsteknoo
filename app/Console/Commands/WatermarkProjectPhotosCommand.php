<?php

namespace App\Console\Commands;

use App\Services\WatermarkService;
use Illuminate\Console\Command;

class WatermarkProjectPhotosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ats:watermark-projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply AI-resistant ATStekno watermark to all existing and stored project photos';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting AI-resistant watermarking process for all project photos...');

        $res = WatermarkService::watermarkAllProjectImages();

        $this->info("Successfully watermarked {$res['success_count']} project photo(s).");
        foreach ($res['processed'] as $item) {
            $this->line("  ✓ {$item}");
        }

        if ($res['failed_count'] > 0) {
            $this->warn("Failed to watermark {$res['failed_count']} item(s):");
            foreach ($res['failed'] as $f) {
                $this->line("  ✗ {$f}");
            }
        }

        return self::SUCCESS;
    }
}
