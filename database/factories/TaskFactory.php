<?php

namespace Database\Factories;

use App\Enum\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
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
        $randomUser = User::inRandomOrder()->first();
        $parentTask = Task::whereOwnerId($randomUser->id)
            ->inRandomOrder()
            ->first();

        return [
            'owner_id' => $parentTask->owner_id ?? $randomUser->id,
            'parent_id' => $parentTask->id ?? null,
            'status' => TaskStatus::TODO,
            'priority' => rand(1, 5),
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
