<?php

namespace Tests\Feature\View\Task;

use App\Models\Task;
use Tests\TestCase;

class EditTest extends TestCase
{
    /**
     * A basic view test example.
     */
    public function test_it_can_render(): void
    {
        $task = Task::factory()->make();

        $contents = $this->view('task.edit', [
            'task' => $task,
        ]);

        $contents->assertViewHas('task', $task)
            ->assertViewHas('project', $task->project)
            ->assertSeeText('title')
            ->assertSeeText('description')
            ->assertSeeText('status')
            ->assertSeeText('due date')
            ->assertSeeText('project')
            ->assertSeeInOrder(["<title>", '', "</title>"]);
    }
}
