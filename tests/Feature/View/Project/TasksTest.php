<?php

namespace Tests\Feature\View\Project;

use App\Models\Task;
use Tests\Feature\View\ViewTest;

class TasksTest extends ViewTest
{

    private static string $viewName = 'project.tasks';

    protected function setUp(): void
    {
        parent::setUp();

        $this->testProject->tasks()->save(Task::factory()->make());

        $this->setUpTestView(self::$viewName, ['project' => $this->testProject, 'tasks' => $this->testProject->tasks]);
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
            $task->due_date->diffForHumans(),
            $task->status->name,
            'href', route('task.edit', $task), 'class="bi bi-pencil-square"'
        ]);
    }

    public function test_table_row_is_yellow_if_task_is_due_tomorrow(): void
    {
        $task = $this->testProject->tasks()->first();
        $task->due_date = now()->addDay();

        $this->view(self::$viewName, ['project' => $this->testProject, 'tasks' => [$task]])->assertSeeInOrder([
            'class="table-warning"',
            $task->id,
        ]);
    }

    public function test_table_row_is_red_if_task_was_due_in_past(): void
    {
        $task = $this->testProject->tasks()->first();
        $task->due_date = now()->subDays(3);

        $this->view(self::$viewName, ['project' => $this->testProject, 'tasks' => [$task]])->assertSeeInOrder([
            'class="table-danger"',
            $task->id,
        ]);
    }
}
