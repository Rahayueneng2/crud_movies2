<?php

namespace Database\Factories;

use App\Models\Cast;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CastMovie;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CastMovie>
 */
class CastMovieFactory extends Factory
{
    protected $model = CastMovie::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'movie_id' => Movie::factory(),
            'cast_id' => Cast::factory(),
        ];
    }
}
