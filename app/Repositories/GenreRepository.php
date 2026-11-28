<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

final readonly class GenreRepository
{
    public function getAllWithBooksCount(): Collection
    {
        return Genre::query()->withCount('books')->orderBy('name')->get();
    }
}
