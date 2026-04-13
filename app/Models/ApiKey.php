<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApiKey extends Model { 
    
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'key_hash',
        'key_prefix',
        'last_used_at',
        'revoked_at',
    ];
    protected $casts = [
        'last_used_at' => 'datetime',
        'revoked_at' => 'datetime',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function requestLogs(): HasMany {
        return $this->hasMany(ApiRequestLog::class);
    }

    public function isRevoked(): bool {
        return $this->revoked_at !== null;
    }
}