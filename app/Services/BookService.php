<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookService
{
    public function getPaginated(int $perPage = 15): LengthAwarePaginator
    {
        $books = Book::query()->paginate($perPage);

        return $books;
    }

    public function showWithAuthorAndGenres(Book $book): Book
    {
        $result = $book->load(['author', 'genres']);

        return $result;
    }
}
