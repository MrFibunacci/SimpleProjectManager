<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
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
        return [
            'title' => $this->faker->text(64),
            'description' => $this->faker->text(255),
            'due_date' => $this->faker->date(),
            'completed' => rand(0, 1) ? null : $this->faker->date(),
            'project_id' => Project::factory(),
            'status_id' => Status::factory(),
        ];
    }
}
