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
        $gender = fake()->randomElement(['male', 'female']);

        return [
            'first_name' => fake('ru_RU')->firstName($gender),
            'second_name' => fake('ru_RU')->lastName($gender),
            'third_name' => fake('ru_RU')->optional()->middlename($gender),
            'birth_date' => fake('ru_RU')->date('Y-m-d'),
            'bio' => fake('ru_RU')->paragraph(5),
        ];
    }
}
