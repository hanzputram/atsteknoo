<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('panel-process:sync', function () {
    \App\Services\PanelProcessService::resetToDefault();
    $this->info('Panel Building Process dataset successfully synced (8 machines & 33 steps).');
})->purpose('Synchronize panel manufacturing process dataset to 8 machines and 33 steps');
