<?php

use Illuminate\Support\Facades\Route;

// Dedicated Standalone Page (Unlisted from main navbar, used for Email Campaign & Process Showcase)
Route::view('/panel-building-process', 'panel-building-process')
    ->name('panel-building-process');

Route::view('/jasa-pembuatan-panel', 'panel-building-process')
    ->name('services.panel.process');

Route::view('/panel-process', 'panel-building-process');
Route::view('/proses-pembuatan-panel', 'panel-building-process');
