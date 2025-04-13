<?php

namespace Tests\Unit\Services;

use App\Models\Video;
use App\Repositories\VideoRepository;
use App\Services\VideoService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery;
use Tests\TestCase;

class VideoServiceTest extends TestCase
{
    protected VideoRepository $repo;
    protected VideoService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repo = Mockery::mock(VideoRepository::class);
        $this->service = new VideoService($this->repo);
    }

    //  Cenário que garante que a service chama o metodo search do repository corretamente
    public function test_search_delegates_to_repository()
    {
        $paginator = Mockery::mock(LengthAwarePaginator::class);
        $this->repo
            ->shouldReceive('search')
            ->once()
            ->with('Laravel', 10)
            ->andReturn($paginator);

        $result = $this->service->search('Laravel', 10);

        $this->assertSame($paginator, $result);
    }


    //  Cenário que garante que a busca funcione quando nada é encontrado, testando search com resultado vazio
    public function test_search_returns_empty_paginator()
    {
        $paginator = new LengthAwarePaginator([], 0, 10);
        $this->repo
            ->shouldReceive('search')
            ->once()
            ->with('', 10)
            ->andReturn($paginator);

        $result = $this->service->search('', 10);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertCount(0, $result);
    }

    // Cenário que garante que o serviço está tratando corretamente o incremento de visualizações e persistindo a nova contagem.
    public function test_get_and_increment_views_calls_increment()
    {
        $video = Mockery::mock(Video::class)->makePartial();;
        $video->views = 5;

        $video->shouldReceive('update')
            ->once()
            ->with(['views' => 6])
            ->andReturn(true);

        $this->repo
            ->shouldReceive('findOrFail')
            ->once()
            ->with(1)
            ->andReturn($video);

        $result = $this->service->getAndIncrementViews(1);

        $this->assertSame($video, $result);
    }

    // Cenário que garante que o serviço está lidando corretamente com a lógica de curtir vídeos e salvando isso no banco.
    public function test_increment_likes_calls_increment()
    {
        $video = Mockery::mock(Video::class)->makePartial();;
        $video->likes = 3;

        $video->shouldReceive('update')
            ->once()
            ->with(['likes' => 4])
            ->andReturn(true);

        $this->repo
            ->shouldReceive('findOrFail')
            ->once()
            ->with(2)
            ->andReturn($video);

        $result = $this->service->incrementLikes(2);

        $this->assertSame($video, $result);
    }

    // cenário quando um video não é encontrado
    public function test_get_and_increment_views_throws_exception_when_video_not_found()
    {
        $this->expectException(ModelNotFoundException::class);

        $this->repo
            ->shouldReceive('findOrFail')
            ->once()
            ->with(99)
            ->andThrow(ModelNotFoundException::class);

        $this->service->getAndIncrementViews(99);
    }

    // Testar com numero alto, para garantir que o incremento é consistente.
    public function test_get_and_increment_views_with_high_number()
    {
        $video = Mockery::mock(Video::class)->makePartial();
        $video->views = 9999;

        $video->shouldReceive('update')
            ->once()
            ->with(['views' => 10000])
            ->andReturn(true);

        $this->repo
            ->shouldReceive('findOrFail')
            ->once()
            ->with(10)
            ->andReturn($video);

        $result = $this->service->getAndIncrementViews(10);

        $this->assertSame($video, $result);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
