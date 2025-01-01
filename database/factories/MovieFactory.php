<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    protected $model = Movie::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'title' => $this->faker->sentence(),
            'synopsis' => $this->faker->paragraph(),
            'poster' => $this->faker->imageUrl(),
            'year' => $this->faker->year(),
            'available' => $this->faker->boolean(),
            'genre_id' => Genre::factory(),
        ];
    }
}
