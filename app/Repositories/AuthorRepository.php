<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorRepository
{
    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        $authors = Author::query()->withCount('books')->withAggregate('books', 'year', 'max')->orderBy('second_name')->paginate($perPage);

        return $authors;
    }

    public function loadDetails(Author $author): Author
    {
        $result = $author->load('books');

        return $result;
    }
}
