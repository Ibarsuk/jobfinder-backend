<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CandidateReport>
 */
class CandidateReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reported_field' => Str::random(10),
            'user_message' => fake()->realText(100),
        ];
    }
}
