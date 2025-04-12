<?php
namespace App\Services;

use App\Models\Video;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VideoService
{
    /**
     * @param string|null $titleFilter
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function search(?string $titleFilter, int $perPage): LengthAwarePaginator
    {
        $query = Video::query();

        if ($titleFilter) {
            $query->where('title', 'like', '%' . $titleFilter . '%');
        }

        return $query->paginate($perPage, ['*'], '_page');
    }

    /**
     * @param int $id
     * @return Video
     */
    public function getAndIncrementViews(int $id): Video
    {
        $video = Video::findOrFail($id);
        $video->increment('views');

        return $video;
    }

    /**
     * @param int $id
     * @return Video
     */
    public function incrementLikes(int $id): Video
    {
        $video = Video::findOrFail($id);
        $video->increment('likes');

        return $video;
    }
}
