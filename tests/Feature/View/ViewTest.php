<?php

namespace Tests\Feature\View;

use App\Models\Project;
use App\Models\User;
use Illuminate\Testing\TestView;
use Tests\TestCase;

abstract class ViewTest extends TestCase
{
    protected Project $testProject;
    protected TestView $testView;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());

        $this->testProject = Project::factory()->create([
            'name' => 'Test Project',
            'description' => 'This is a test project.',
            'due_date' => now()->addDay()->format('Y-m-d'),
        ]);
    }

    protected function setUpTestView(string $viewName, array $data): void
    {
        $this->testView = $this->view($viewName, $data);
    }

    public function runTitleAssertion(string $title): void
    {
        $this->testView->assertSeeInOrder(["<title>", $title, "</title>"]);
    }
}
