<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => $this->collection,
        ];
    }
    public function paginationInformation(): array
    {
        $default = [
            'meta' => [
                'total' => $this->total(),
                // 'current_page' => $this->currentPage(),
                // 'last_page' => $this->lastPage(),
                // 'per_page' => $this->perPage(),
                // 'from' => $this->firstItem(),
                // 'to' => $this->lastItem(),
                // 'links' => [
                //     'next' => $this->nextPageUrl(),
                //     'previous' => $this->previousPageUrl(),
                // ],
            ],
            
        ];
        return $default;
    }
}
