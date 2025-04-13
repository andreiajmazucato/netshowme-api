<?php

namespace App\Repositories;

use App\Models\Video;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VideoRepository
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
    public function findOrFail(int $id): Video
    {
        return Video::findOrFail($id);
    }
}
