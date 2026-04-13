<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuideRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'title' => ['required', 'string', 'max:100'],
            'channel_nr' => ['required', 'integer', 'between:1,3'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
        ];
    }
}