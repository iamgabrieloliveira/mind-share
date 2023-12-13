<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function unauthorized(string $message = 'Unauthorized!'): JsonResponse
    {
        return response()->json(['error' => compact('message')], Response::HTTP_UNAUTHORIZED);
    }

    protected function noContent(): JsonResponse
    {
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    protected function ok(array $data = []): JsonResponse
    {
        return response()->json($data, Response::HTTP_OK);
    }

    protected function created(string $id): JsonResponse
    {
        return response()->json(['id' => $id], Response::HTTP_CREATED);
    }

    protected function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return response()->json(['error' => compact('message')], Response::HTTP_FORBIDDEN);
    }
}
