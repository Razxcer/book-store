<?php

namespace App\Services;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

class GenreService
{
    public function getAllWithBooksCount(): Collection
    {
        return Genre::query()->withCount('books')->orderBy('name')->get();
    }
}
