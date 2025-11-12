<?php

namespace Tests\Feature\View\Project;

use Feature\View\Project\ViewTest;

class TasksTest extends ViewTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestView('project.task', ['project' => $this->testProject]);
    }

    public function test_title_is_correct(): void
    {
        $this->runTitleAssertion("SimpleProjectManager - Project: ".$this->testProject->name." Tasks");
    }
}
