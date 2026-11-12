<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\ClassFormat;
use App\Enums\ContentStatus;
use App\Models\InstructorProfile;
use App\Models\Programme;
use App\Models\ProgrammeCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoreDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Attach Instructor Profile to the Owner user
        $owner = User::whereHas('roles', fn ($query) => $query->where('slug', 'owner'))->first();

        if ($owner) {
            InstructorProfile::firstOrCreate(
                ['user_id' => $owner->id],
                [
                    'title' => 'Yogacharya',
                    'tagline' => 'Traditional Yoga & Holistic Wellness Guidance',
                    'short_bio' => 'Dedicated practitioner and teacher guiding students through authentic Hatha, Ashtanga, and Pranayama practices.',
                    'full_bio' => 'Yogacharya Deepashree Gaur brings a structured, mindful approach to traditional yoga and holistic well-being, supporting practitioners across all experience levels.',
                    'qualifications' => [
                        'Certified Yogacharya & Traditional Yoga Instructor',
                        'Pranayama & Breathwork Specialist',
                    ],
                    'specializations' => [
                        'Hatha Yoga',
                        'Ashtanga Vinyasa',
                        'Pranayama & Meditation',
                        'Therapeutic & Holistic Wellness',
                    ],
                    'years_of_experience' => 10,
                ]
            );
        }

        // 2. Seed Core Programme Categories
        $categories = [
            [
                'name' => 'Hatha Yoga',
                'description' => 'Classical foundational postures (asanas), alignment, and mindful breathing for strength and balance.',
            ],
            [
                'name' => 'Ashtanga',
                'description' => 'Dynamic, structured sequences synchronizing breath with progressive movement.',
            ],
            [
                'name' => 'Pranayama',
                'description' => 'Traditional yogic breath regulation techniques to calm the nervous system and build vitality.',
            ],
            [
                'name' => 'Specialised Wellness',
                'description' => 'Tailored holistic sessions supporting stress relief, mobility, and restorative wellness.',
            ],
        ];

        $seededCategories = [];

        foreach ($categories as $index => $categoryData) {
            $slug = Str::slug($categoryData['name']);

            $seededCategories[$slug] = ProgrammeCategory::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'sort_order' => $index + 1,
                    'status' => ContentStatus::Published,
                ]
            );
        }

        // 3. Seed Starter Programmes under the Categories
        $programmes = [
            [
                'category_slug' => 'hatha-yoga',
                'title' => 'Foundational Hatha Yoga',
                'short_description' => 'Build strength, flexibility, and body awareness through traditional asana practice.',
                'overview' => 'Designed for beginners and returning practitioners, this programme focuses on proper alignment, steady breathing, and mindful transitions.',
                'benefits' => [
                    'Improves posture, spinal mobility, and joint health',
                    'Builds steady physical endurance and balance',
                    'Encourages mental clarity and relaxation',
                ],
                'level' => 'All Levels',
                'duration_text' => '60 mins / session',
                'format' => ClassFormat::Either,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'ashtanga',
                'title' => 'Ashtanga Primary Series Foundations',
                'short_description' => 'A disciplined, breath-led flow cultivating focus, stamina, and internal heat.',
                'overview' => 'Step-by-step instruction through Sun Salutations, standing postures, and foundational seated sequences of the Ashtanga tradition.',
                'benefits' => [
                    'Enhances cardiovascular stamina and core strength',
                    'Develops deep concentration through Ujjayi breath',
                    'Creates a consistent self-practice framework',
                ],
                'level' => 'Beginner to Intermediate',
                'duration_text' => '75 mins / session',
                'format' => ClassFormat::Either,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'pranayama',
                'title' => 'Pranayama & Mindful Stillness',
                'short_description' => 'Guided breathwork and meditative stillness for nervous system balance.',
                'overview' => 'Learn classical pranayama practices including Nadi Shodhana, Bhramari, and diaphragmatic breathing to restore calm and focus.',
                'benefits' => [
                    'Reduces daily stress and mental fatigue',
                    'Improves lung capacity and breath awareness',
                    'Supports restful sleep and emotional equilibrium',
                ],
                'level' => 'All Levels',
                'duration_text' => '45 mins / session',
                'format' => ClassFormat::Online,
                'is_featured' => true,
            ],
            [
                'category_slug' => 'specialised-wellness',
                'title' => 'Holistic Stress & Mobility Support',
                'short_description' => 'Gentle, restorative yoga tailored for modern desk-bound lifestyles.',
                'overview' => 'A supportive, low-impact practice combining gentle joint mobilization, restorative postures, and guided relaxation.',
                'benefits' => [
                    'Relieves neck, shoulder, and lower-back tension',
                    'Promotes gentle recovery and sustainable energy',
                    'Adaptable to individual mobility needs',
                ],
                'level' => 'Beginner Friendly',
                'duration_text' => '60 mins / session',
                'format' => ClassFormat::Either,
                'is_featured' => false,
            ],
        ];

        foreach ($programmes as $index => $item) {
            $category = $seededCategories[$item['category_slug']] ?? null;

            if (! $category) {
                continue;
            }

            Programme::firstOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'programme_category_id' => $category->id,
                    'title' => $item['title'],
                    'short_description' => $item['short_description'],
                    'overview' => $item['overview'],
                    'benefits' => $item['benefits'],
                    'level' => $item['level'],
                    'duration_text' => $item['duration_text'],
                    'format' => $item['format'],
                    'is_featured' => $item['is_featured'],
                    'sort_order' => $index + 1,
                    'status' => ContentStatus::Published,
                ]
            );
        }
    }
}
