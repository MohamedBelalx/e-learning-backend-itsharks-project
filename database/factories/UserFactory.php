<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'role' => $this->faker->randomElement(['admin', 'student', 'teacher']),
            'phone' => $this->faker->phoneNumber,
            'location' => $this->faker->address,
            'is_active' => $this->faker->boolean(90), // 90% chance of being true
            'email_verified_at' => $this->faker->randomElement([now(), null]),
            'password' => bcrypt('password'), // Default password for all users or use bcrypt($this->faker->password)
            // 'rememberToken' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
