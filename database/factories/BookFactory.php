<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake('ru_RU')->sentence(3),
            'description' => fake('ru_RU')->paragraph(3),
            'year' => fake('ru_RU')->year(),
            'price' => fake('ru_RU')->randomFloat(2, 300, 7000),
            'discount' => fake('ru_RU')->numberBetween(5, 55),
            'author_id' => Author::factory(),
        ];
    }
}
