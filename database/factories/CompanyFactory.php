<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    const MAX_EXPERIENCE = 12;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'min_experience' => rand(0, $this::MAX_EXPERIENCE),
            'position' => fake()->jobTitle(),
            'text' => fake()->realText(1000),
            'photo' => fake()->optional(0.7)->lexify(),
            'active' => rand(0, 1),
            'relevant_at' => now(),
            'city' => fake()->optional(0.8)->city(),
            'website' => fake()->url(),
        ];
    }
}
