<?php

namespace App\Repositories;

use App\Models\Video;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class VideoRepository
{
    /**
     * @param string|null $titleFilter
     * @param int|null $page
     * @param int|null $perPage
     * @return LengthAwarePaginator|Collection
     */
    public function search(?string $titleFilter, ?int $perPage): LengthAwarePaginator|Collection
    {
        $query = Video::query();

        if ($titleFilter) {
            $query->where('title', 'like', '%' . $titleFilter . '%');
        }

        return $perPage ? $query->paginate($perPage, ['*'], '_page') : $query->get() ;
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
