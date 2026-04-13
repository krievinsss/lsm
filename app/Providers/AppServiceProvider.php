<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        RateLimiter::for('api-keys', function (Request $request) {
            $perMinute = (int) env('API_RATE_LIMIT_PER_MINUTE', 60);

            return Limit::perMinute($perMinute)->by(
                optional($request->attributes->get('apiKey'))->id ?: $request->ip()
            );
        });
    }
}