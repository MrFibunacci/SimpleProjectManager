<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('tasks'));
        $response->assertStatus(200);
        $response->assertViewIs('task.index');
    }

    public function test_create_page_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('task.create'));
        $response->assertStatus(200);
        $response->assertViewIs('task.create');
    }

    public function test_task_can_be_created()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $project = Project::factory()->create();

        $user->projects()->attach($project, ['role_id'=>Role::factory()->create()->id]);

        $task = [
            'title' => 'test',
            'description' => 'test_description',
            'project_id' => $project->id,
            'status_id' => Status::factory()->create()->id,
            'due_date' => now()->format('Y-m-d'),
        ];

        $response = $this->post(route('task.store'), $task);

        $response->assertRedirect(route('project.tasks', $project));
        $this->assertDatabaseHas('tasks', $task);
    }

    public function test_task_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->create();

        $response = $this->get(route('task.show', ['task' => $task]));
        $response->assertStatus(200)
            ->assertViewIs('task.show')
            ->assertViewHas('task', $task);
    }

    public function test_task_update_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $task = Task::factory()->create();

        $response = $this->get(route('task.edit', ['task' => $task]));
        $response->assertStatus(200)
            ->assertViewIs('task.edit')
            ->assertViewHas('task', $task);
    }

    public function test_task_can_be_updated()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create();

        $user->projects()->attach($task->project, ['role_id'=>Role::factory()->create()->id]);

        $this->actingAs($user);

        $task->title = 'updated title';
        $task->description = 'updated description';

        $response = $this->post(route('task.update', [
            'task' => $task,
            'title' => $task->title,
            'description' => $task->description,
            'status_id' => $task->status_id,
        ]));
        $response->assertRedirect(route('task.show', ['task' => $task]));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
        ]);
    }
}
