<?php

namespace App\Services;

use App\Models\Author;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AuthorService
{
    public function getAllWithBooksAndLastBook(int $perPage = 15): LengthAwarePaginator
    {
        $authors = Author::query()->withCount('books')->withAggregate('books', 'year', 'max')->orderBy('second_name')->paginate($perPage);

        return $authors;
    }

    public function showWithBooks(Author $author): Author
    {
        $result = $author->load('books');

        return $result;
    }
}
