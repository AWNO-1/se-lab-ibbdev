<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'username' => str_replace('.', '_', fake()->unique()->userName()),
            'avatar_path' => fake()->optional()->imageUrl(),
            'reputation_points' => fake()->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Create a user with the specified details.
     */
    public function createSaherUser(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'saherqaid',
                'email' => 'saherqaid2020@gmail.com',
                'username' => 'saherqaid',
                'password' => Hash::make('password123'),
            ];
        });
    }
}
