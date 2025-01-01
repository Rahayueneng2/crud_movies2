<?php

namespace Database\Factories;

use App\Models\Cast;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cast>
 */
class CastFactory extends Factory
{
    protected $model = Cast::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(18, 80),
            'biodata' => $this->faker->paragraph(),
            'avatar' => $this->faker->imageUrl(),
        ];
    }
}
