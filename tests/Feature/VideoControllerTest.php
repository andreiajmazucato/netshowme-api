<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_videos()
    {
        Video::factory()->count(3)->create();

        $response = $this->getJson('/api/videos');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta']);
    }

    public function test_can_filter_videos_by_title()
    {
        Video::factory()->create(['title' => 'Laravel Tips']);
        Video::factory()->create(['title' => 'React Tricks']);

        $response = $this->getJson('/api/videos?title_contains=Laravel');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data'));
        $this->assertEquals('Laravel Tips', $response->json('data')[0]['title']);
    }

    public function test_can_show_video_and_increment_views()
    {
        $video = Video::factory()->create(['views' => 10]);

        $response = $this->getJson("/api/videos/{$video->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $video->id]);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'views' => 11
        ]);
    }

    public function test_can_increment_likes_on_update()
    {
        $video = Video::factory()->create(['likes' => 5]);

        $response = $this->patchJson("/api/videos/{$video->id}", [
            'like' => true,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'likes' => 6,
        ]);
    }
}
