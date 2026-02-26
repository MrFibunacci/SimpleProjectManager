<?php

namespace Database\Factories;

use App\Models\Action;
use App\Models\Activity;
use App\Models\Attribute;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ActivityFactory extends Factory
{
//    protected $model = Activity::class;

    public function definition(): array
    {
        return [
            'oldVal' => $this->faker->word(),
            'newVal' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'task_id' => Task::factory(),
            'attribute_id' => Attribute::factory(),
            'action_id' => Action::factory(),
            'user_id' => User::factory(),
        ];
    }
}
