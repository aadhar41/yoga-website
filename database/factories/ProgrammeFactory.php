<?php

namespace Database\Factories;

use App\Enums\ClassFormat;
use App\Enums\ContentStatus;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Programme>
 */
class ProgrammeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->word().' '.fake()->word().' '.fake()->word();

        return [
            'programme_category_id' => ProgrammeCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'short_description' => fake()->sentence(),
            'overview' => fake()->paragraph(),
            'benefits' => [fake()->sentence()],
            'format' => ClassFormat::Either,
            'is_featured' => false,
            'sort_order' => 0,
            'status' => ContentStatus::Draft,
        ];
    }
}
