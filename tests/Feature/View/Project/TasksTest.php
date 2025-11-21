<?php

namespace Tests\Feature\View\Project;

use App\Models\Task;
use Tests\Feature\View\ViewTest;

class TasksTest extends ViewTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->testProject->tasks()->save(Task::factory()->make());

        $this->setUpTestView('project.tasks', ['project' => $this->testProject, 'tasks' => $this->testProject->tasks]);
    }

    public function test_title_is_correct(): void
    {
        $this->runTitleAssertion("SimpleProjectManager - Project: ".$this->testProject->name." - Tasks");
    }
}
