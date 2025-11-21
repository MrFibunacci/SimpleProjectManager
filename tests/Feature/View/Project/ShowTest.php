<?php

namespace Tests\Feature\View\Project;

use App\Models\Task;
use Tests\Feature\View\ViewTest;

class ShowTest extends ViewTest
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpTestView('project.show', ['project' => $this->testProject]);
    }

    public function test_title_is_correct(): void
    {
        $this->runTitleAssertion("SimpleProjectManager - Project: ".$this->testProject->name);
    }
}
