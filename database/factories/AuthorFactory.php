<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake('ru_RU')->firstName(),
            'second_name' => fake('ru_RU')->lastName(),
            'third_name' => fake('ru_RU')->optional()->word(),
            'birth_date' => fake('ru_RU')->date('Y-m-d'),
            'bio' => fake('ru_RU')->paragraph(5),
        ];
    }
}
