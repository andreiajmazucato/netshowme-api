<?php

namespace App\Services;

use App\Models\Video;
use App\Repositories\VideoRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VideoService
{
    /**
     * @var VideoRepository
     */
    protected $videoRepository;

    public function __construct(VideoRepository $videoRepository) {
        $this->videoRepository = $videoRepository;
    }

    /**
     * @param string|null $titleFilter
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(?string $titleFilter, int $perPage): LengthAwarePaginator
    {
        return $this->videoRepository->search($titleFilter, $perPage);
    }

    /**
     * @param int $id
     * @return Video
     */
    public function getAndIncrementViews(int $id): Video
    {
        $video = $this->videoRepository->findOrFail($id);
        $video->update(['views' => $video->views + 1]);

        return $video;
    }

    /**
     * @param int $id
     * @return Video
     */
    public function incrementLikes(int $id): Video
    {
        $video = $this->videoRepository->findOrFail($id);
        $video->update(['likes' => $video->likes + 1]);

        return $video;
    }
}
