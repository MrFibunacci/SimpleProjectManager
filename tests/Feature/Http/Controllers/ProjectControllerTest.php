<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_viewed()
    {
        $response = $this->get(route('projects'));
        $response->assertStatus(200);
        $response->assertViewIs('project.index');
    }

    public function test_create_page_can_be_viewed()
    {
        $response = $this->get(route('projects.create'));
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

        $response = $this->post(route('projects.store'), [
            'name' => $testProject->name,
            'description' => $testProject->description,
            'due_date' => $testProject->due_date,
        ]);

        $response->assertRedirect(route('projects'));
        $this->assertDatabaseHas('projects', [
            'name' => $testProject->name,
            'description' => $testProject->description,
            'due_date' => $testProject->due_date,
        ]);

        $project = Project::where('name', 'Test Project')->where('description', 'Test Description')->first();
        $this->assertDatabaseHas('project_user', [
            'user_id' => $user->id,
            'project_id' => $project->id,
            'role_id' => Role::where('name', 'Owner')->first()->id,
        ]);
    }
}
