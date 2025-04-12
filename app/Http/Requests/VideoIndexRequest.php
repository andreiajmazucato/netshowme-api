<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_contains' => ['nullable', 'string', 'max:255'],
            '_per_page'      => ['nullable', 'integer', 'min:1', 'max:100'],
            '_page'          => ['nullable', 'integer', 'min:1'],
        ];
    }
}