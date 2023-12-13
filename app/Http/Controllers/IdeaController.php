<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateIdeaRequest;
use App\Http\Resources\IdeaListResource;
use App\Http\Resources\PaginationResource;
use App\Models\Idea;
use App\Services\IdeaService;
use Illuminate\Http\JsonResponse;

class IdeaController extends Controller
{
    public function __construct(
        private readonly IdeaService $ideaService,
    ) {
    }

    public function create(CreateIdeaRequest $request): JsonResponse
    {
        $dto = $request->toDto();

        $post = $this->ideaService->create($dto);

        return $this->created($post->id);
    }

    public function get(Idea $idea): JsonResponse
    {
        return $this->ok([
            'idea' => $idea->loadMissing([
                'author',
                'comments.user',
            ]),
        ]);
    }

    public function list(): JsonResponse
    {
        $listing = $this->ideaService->listIdeas();

        return $this->ok([
            'pagination' => PaginationResource::make($listing),
            'ideas' => IdeaListResource::collection($listing->items()),
        ]);
    }
}
