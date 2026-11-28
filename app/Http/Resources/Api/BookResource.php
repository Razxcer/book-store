<?php

namespace App\Http\Resources\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Book
 */
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'year' => $this->year,
            'price' => $this->price,
            'discount' => $this->discount,
            'author' => AuthorResource::make($this->whenLoaded('author')),
            'genres' => GenreResource::collection($this->whenLoaded('genres')),
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
