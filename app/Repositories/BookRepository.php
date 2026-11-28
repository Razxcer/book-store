<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class BookRepository
{
    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return Book::query()->paginate($perPage);
    }

    public function loadDetails(Book $book): Book
    {
        return $book->load(['author', 'genres']);
    }
}
