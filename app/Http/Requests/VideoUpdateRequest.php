<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'like' => ['nullable', 'boolean'],

            'title'       => ['sometimes', 'string', 'max:255'],
            'domain'      => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'thumbnail'   => ['sometimes', 'url'],
            'hls_path'    => ['sometimes', 'url'],
            'category_id' => ['sometimes', 'exists:categories,id'],
            'site_id'     => ['sometimes', 'exists:sites,id'],
            'likes'       => ['sometimes', 'integer', 'min:0'],
            'views'       => ['sometimes', 'integer', 'min:0'],
        ];
    }
}
