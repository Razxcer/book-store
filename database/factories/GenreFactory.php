<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = [
            'Фантастика',
            'Фэнтези',
            'Детектив',
            'Триллер',
            'Роман',
            'Классика',
            'Приключения',
            'Исторический роман',
            'Научпоп',
            'Психология',
            'Биография',
            'Поэзия',
            'Ужасы',
            'Бизнес-литература',
        ];

        return [
            'name' => fake('ru_RU')->unique()->randomElement($genres),
        ];
    }
}
