<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('projects'));
        $response->assertStatus(200);
        $response->assertViewIs('project.index');
    }

    public function test_create_page_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());
        $response = $this->get(route('project.create'));
        $response->assertStatus(200);
        $response->assertViewIs('project.create');
    }

    public function test_new_project_can_be_created()
    {
        $this->seed();
        $user = User::factory()->create();
        $this->actingAs($user);

        $testProject = new Project([
            'name' => 'Test Project',
            'description' => 'Test Description',
            'due_date' => now()->addDays(30)->format('Y-m-d'),
        ]);

        $testProject->status()->associate(Status::factory()->create());

        $response = $this->post(route('project.store'), [
            'name' => $testProject->name,
            'description' => $testProject->description,
            'due_date' => $testProject->due_date,
            'status' => $testProject->status_id,
        ]);

        $response->assertRedirect(route('projects'));
        $this->assertDatabaseHas('projects', [
            'name' => $testProject->name,
            'description' => $testProject->description,
            'due_date' => $testProject->due_date,
            'status_id' => $testProject->status_id,
        ]);

        $project = Project::where('name', 'Test Project')->where('description', 'Test Description')->first();
        $this->assertDatabaseHas('project_user', [
            'user_id' => $user->id,
            'project_id' => $project->id,
            'role_id' => Role::where('name', 'Owner')->first()->id,
        ]);
    }

    public function test_project_can_be_viewed()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $project = Project::factory()->create();
        $user->projects()->attach($project, ['role_id' => Role::factory()->create()->id]);

        $response = $this->get(route('project.show', ['project' => $project]));
        $response->assertStatus(200);
        $response->assertViewIs('project.show');
    }
}
