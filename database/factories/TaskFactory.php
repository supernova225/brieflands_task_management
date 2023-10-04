<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIdDs = User::pluck('id');

        return [
            'assignee_id' => fake()->randomElement($userIdDs),
            'title' => fake()->word,
            'description' => fake()->paragraph,
            'deadline' => fake()->dateTimeBetween('-1 weeks', '+1 weeks'),
            'status' => fake()->randomElement(['todo', 'doing', 'done']),
        ];
    }
}
