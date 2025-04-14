<?php

namespace App\Http\Controllers;

use App\Services\VideoService;
use App\Http\Requests\VideoIndexRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Resources\VideoResource;
use Illuminate\Http\JsonResponse;


class VideoController extends Controller
{

    /**
     * @var VideoService
     */
    private $videoService;

    public function __construct(VideoService $videoService) {

        $this->videoService = $videoService;
    }

    /**
     * @param VideoIndexRequest $request
     * @return JsonResponse
     */
    public function index(VideoIndexRequest $request): JsonResponse
    {
        try {
            $videos = $this->videoService->search(
                $request->input('title_contains'),
                $request->input('_per_page')
            );

            return response()->json(VideoResource::collection($videos));
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao buscar vídeos.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $video = $this->videoService->getAndIncrementViews($id);

            return response()->json(new VideoResource($video));
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Vídeo não encontrado.',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * @param VideoUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(VideoUpdateRequest $request, int $id): JsonResponse
    {
        try {
            $video = $request->boolean('like')
                ? $this->videoService->incrementLikes($id)
                : $this->videoService->getAndIncrementViews($id);

            return response()->json(new VideoResource($video));
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Erro ao atualizar vídeo.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}