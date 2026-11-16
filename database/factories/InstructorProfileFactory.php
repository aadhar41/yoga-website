<?php

namespace Database\Factories;

use App\Models\InstructorProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InstructorProfile>
 */
class InstructorProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => 'Yogacharya',
            'tagline' => fake()->sentence(),
            'short_bio' => fake()->paragraph(),
            'full_bio' => fake()->paragraphs(2, true),
            'qualifications' => [fake()->sentence()],
            'specializations' => [fake()->word()],
            'years_of_experience' => fake()->numberBetween(1, 30),
        ];
    }
}
