<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => \App\Models\User::factory() , // Assuming role is defined and you have students
            'course_id' => \App\Models\Course::factory(),
            'comments' => $this->faker->optional()->paragraph, // Comments are nullable
            'score' => $this->faker->numberBetween(1, 5), // Assuming score is from 1 to 5
        ];
    }
}
