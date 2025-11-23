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

    public function test_table_head_is_correct(): void
    {
        $this->testView->assertSeeInOrder([
            'id',
            'Title',
            'Due date',
            'Status',
            'Actions',
        ]);
    }

    public function test_table_body_is_correct(): void
    {
        $task = $this->testProject->tasks()->first();

        $this->testView->assertSeeInOrder([
            $task->id,
            $task->title,
            $task->due_date,
            //$task->status,
            'href', route('task.edit', $task), 'class="bi bi-pencil-square"'
        ]);
    }
}
