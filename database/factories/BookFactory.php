<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
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
            'book_name' => fake()->title(),
            'author' => fake()->name(),
            'genre' => fake()->word(),
            'description' => fake()->sentence(),
            'ISBN' => fake()->unique()->numberBetween(1111111111111, 9999999999999),
            'language' => 'polish',
            'image' => fake()->word(),
            'type' => 'ebook',
            'price' => 1.99
        ];
    }
}
