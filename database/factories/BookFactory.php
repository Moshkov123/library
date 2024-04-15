<?php

namespace Database\Factories;

use App\Models\Author;
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
            'author_id' => 1,
            'title' => $this->faker->sentence,
            'age' => $this->faker->numberBetween(1, 100),
            'annotation' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
