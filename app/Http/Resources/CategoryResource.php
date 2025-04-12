<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request)
    {
        /** @var Category */
        $category = $this->resource;

        return [
            'id' => $category->id,
            'title' => $category->title,
            'site_id' => $category->site_id,
            'site' => [
                'id' => $category->site?->id,
                'title' => $category->site?-id,
                'domain' => $category->site?->id,
            ],
        ];
    }
}
