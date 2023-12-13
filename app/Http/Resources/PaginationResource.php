<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

/** @mixin LengthAwarePaginator */
class PaginationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'total' => $this->total(),
            'next_url' => $this->nextPageUrl(),
            'page' => $this->currentPage(),
            'has_more_pages' => $this->hasMorePages(),
        ];
    }
}
