<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AuthorResource;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use App\Services\AuthorService;
use Dedoc\Scramble\Attributes\PathParameter;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct(
        private readonly AuthorService $authorService,
        private readonly AuthorRepository $authorRepository
    ) {
    }

    /**
     * Получить авторов
     *
     * Выводит всех авторов с количеством книг и годом издания последней книги <br/>
     * Пагинация 15 человек
     *
     * @unauthenticated
     */
    public function index()
    {
        $authors = $this->authorRepository->getPaginated(15);

        return AuthorResource::collection($authors);
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
     * Получить конкретного автора
     *
     * Выводит конкретного автора с его книгами
     *
     * @unauthenticated
     */
    #[PathParameter('author', example: 1)]
    public function show(Author $author)
    {
        $author = $this->authorRepository->loadDetails($author);

        return AuthorResource::make($author);
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
