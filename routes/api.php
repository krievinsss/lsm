<?php

use App\Http\Controllers\Api\GuideController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api.key', 'throttle:api-keys', 'api.log'])->group(function () {
    Route::get('/guide/{channel_nr}/{date}', [GuideController::class, 'index']);
    Route::get('/on-air/{channel_nr}', [GuideController::class, 'onAir']);
    Route::get('/upcoming/{channel_nr}', [GuideController::class, 'upcoming']);
    Route::post('/guide', [GuideController::class, 'store']);
});