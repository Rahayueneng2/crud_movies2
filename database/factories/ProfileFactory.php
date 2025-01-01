<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(), 
            'biodata' => $this->faker->text,
            'age' => $this->faker->numberBetween(18, 99),
            'address' => $this->faker->address, 
            'avatar' => $this->faker->imageUrl(), 
            'user_id' => User::factory(), 
        ];
    }
}
