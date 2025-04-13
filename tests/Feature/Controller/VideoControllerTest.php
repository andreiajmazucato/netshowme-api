<?php

namespace Tests\Feature;

use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoControllerTest extends TestCase
{
    use RefreshDatabase;

    // simula se o retorno da lista de videos retorna um json especificado
    public function test_can_list_videos()
    {
        Video::factory()->count(3)->create();

        $response = $this->getJson('/api/videos');

        $response->assertStatus(200)
                ->assertJsonStructure([
                '*' => [ // cada item do array deve ter esses campos
                    'id',
                    'title',
                    'hls_path',
                    'description',
                    'thumbnail',
                    'views',
                    'likes',
                    'site_id',
                    'category_id',
                    'site' => [
                        'id',
                        'title',
                        'domain',
                    ],
                    'category' => [
                        'id',
                        'title',
                        'site_id',
                    ],
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    // simula se a API consegue filtrar corretamente os vídeos com base em parte do título fornecido via query string.
    public function test_can_filter_videos_by_title()
    {
        Video::factory()->create(['title' => 'Laravel Tips']);
        Video::factory()->create(['title' => 'React Tricks']);

        $response = $this->getJson('/api/videos?title_contains=Laravel');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json());
        $this->assertEquals('Laravel Tips', $response->json()[0]['title']);
    }

    // simula criar um video, busca ele, e atualiza a view
    public function test_can_show_video_and_increment_views()
    {
        $video = Video::factory()->create(['views' => 10]);

        $response = $this->getJson("/api/video/{$video->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $video->id]);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'views' => 11
        ]);
    }

    // simula se está cadastrando likes e alterando o video corretamente
    public function test_can_increment_likes_on_update()
    {
        $video = Video::factory()->create(['likes' => 5]);

        $response = $this->patchJson("/api/video/{$video->id}", [
            'like' => true,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'likes' => 6,
        ]);
    }
}
