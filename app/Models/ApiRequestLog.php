<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiRequestLog extends Model {

    use HasFactory;

    protected $fillable = [
        'user_id',
        'api_key_id',
        'method',
        'path',
        'status_code',
        'duration_ms',
        'ip_address',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    
    public function apiKey(): BelongsTo {
        return $this->belongsTo(ApiKey::class);
    }
}