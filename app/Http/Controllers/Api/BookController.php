<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BookResource;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Services\BookService;
use Dedoc\Scramble\Attributes\PathParameter;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        private readonly BookService $bookService,
        private readonly BookRepository $bookRepository
    ) {
    }

    /**
     * Получить список книг
     *
     * Выводит список книг
     *
     * @unauthenticated
     */
    public function index()
    {
        $books = $this->bookRepository->getPaginated(15);

        return BookResource::collection($books);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Получить всю инфу про книгу
     *
     * Выводит полную информацию про книгу, её автора и список её жанров
     *
     * @unauthenticated
     */
    #[PathParameter('book', example: 1)]
    public function show(Book $book)
    {
        $book = $this->bookRepository->loadDetails($book);

        return BookResource::make($book);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
