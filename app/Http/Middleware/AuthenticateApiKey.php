<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $userCode = $request->header('X-User-Code');

        if (! $token || ! $userCode) {
            return new JsonResponse([
                'message' => 'Unauthorized.',
            ], 401);
        }

        $apiKey = ApiKey::query()
            ->where('key_hash', hash('sha256', $token))
            ->whereNull('revoked_at')
            ->with('user')
            ->first();

        if (! $apiKey || ! $apiKey->user) {
            return new JsonResponse([
                'message' => 'Unauthorized.',
            ], 401);
        }

        if ($apiKey->user->user_code !== $userCode) {
            return new JsonResponse([
                'message' => 'Forbidden.',
            ], 403);
        }

        $apiKey->forceFill([
            'last_used_at' => now(),
        ])->save();

        $request->attributes->set('apiKey', $apiKey);
        $request->attributes->set('userCode', $userCode);
        $request->setUserResolver(fn () => $apiKey->user);

        return $next($request);
    }
}