<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $genres = Genre::factory(10)->create();
        $authors = Author::factory(20)->create();

        Book::factory(100)
            ->recycle($authors)
            ->create()
            ->each(function (Book $book) use ($genres): void {
                $book->genres()->attach(
                    $genres->random(rand(1, 3))->pluck('id')
                );
            });
    }
}
