<?php

namespace App\Http\Resources;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request): array
    {
        /** @var Video */
        $video = $this->resource;

        return [
            'id' => $video->id,
            'title' => $video->title,
            'hls_path' => $video->hls_path,
            'description' => $video->description,
            'thumbnail' => $video->thumbnail,
            'views' => $video->views,
            'likes' => $video->likes,
            'site_id' => $video->site_id,
            'category_id' => $video->category_id,
            'site' => [
                'id' => $video->site?->id,
                'title' => $video->site?->title,
                'domain' => $video->site?->domain,
            ],
            'category' => [
                'id' => $video->category?->id,
                'title' => $video->category?->title,
                'site_id' => $video->category?->site_id,
            ],
            'created_at' => $video->created_at,
            'updated_at' => $video->updated_at,
        ];
    }
}
