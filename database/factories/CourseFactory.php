<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'duration' => $this->faker->numberBetween(1, 52), // Duration in weeks, for example
            'is_approved' => $this->faker->boolean,
            'price' => $this->faker->numberBetween(100, 1000),
            'lang' => $this->faker->randomElement(['arabic', 'english']),
            'teacher_id' => \App\Models\User::factory(),
            'category_id' => \App\Models\Category::factory()
        ];
    }
}


