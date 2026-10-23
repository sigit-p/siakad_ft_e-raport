<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ActivityLogController;

Route::middleware(['auth', 'role:admin', 'fakultas.scope'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/activity-log', [ActivityLogController::class, 'index'])
            ->name('activity-log.index');
    });
