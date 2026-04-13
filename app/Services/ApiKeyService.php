<?php

namespace App\Services;

use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Support\Str;

class ApiKeyService
{
    public function create(User $user, string $name): array
    {
        $plainTextKey = 'tvg_' . Str::random(40);

        $apiKey = $user->apiKeys()->create([
            'name' => $name,
            'key_hash' => hash('sha256', $plainTextKey),
            'key_prefix' => Str::substr($plainTextKey, 0, 12),
        ]);

        return [
            'apiKey' => $apiKey,
            'plainTextKey' => $plainTextKey,
        ];
    }

    public function revoke(ApiKey $apiKey): void
    {
        $apiKey->update([
            'revoked_at' => now(),
        ]);
    }
}