<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Site;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'category_id' => Category::factory()->create()->id,
            'hls_path' => $this->faker->url,
            'description' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl(),
            'site_id' => Site::factory()->create()->id,
            'views' => 0,
            'likes' => 0,
        ];
    }
}
