<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\users>
 */
class usersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'age' => fake()->numberBetween(0,120),
        'country' => fake()->country(),
        'skills' => implode(',', fake()->randomElements(['php', 'laravel','mysql'],rand(1, 3))),
        'gender' => fake()->randomElement(['male', 'female']),
        'color' => fake()->hexColor(),
        'salary' => fake()->numberBetween(10000,100000),
        'created_by' => 1,
        ];
    }
}
