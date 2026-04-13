<?php

namespace App\Http\Middleware;

use App\Models\ApiRequestLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        $startedAt = microtime(true);
        $response = $next($request);
        $durationMs = (int) round((microtime(true) - $startedAt) * 1000);

        $apiKey = $request->attributes->get('apiKey');
        $user = $request->user();

        ApiRequestLog::create([
            'user_id' => $user?->id,
            'api_key_id' => $apiKey?->id,
            'requested_user_code' => $request->attributes->get('userCode'),
            'method' => $request->method(),
            'path' => $request->path(),
            'status_code' => $response->getStatusCode(),
            'duration_ms' => $durationMs,
            'ip_address' => $request->ip(),
        ]);

        return $response;
    }
}