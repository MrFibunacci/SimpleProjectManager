<?php

namespace Tests\Feature\Models;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\ModelTestCase;
use Tests\TestCase;

class TaskTest extends ModelTestCase
{
    /**
     * A basic feature test example.
     */
    public function test_model_configuration(): void
    {
        $this->runConfigurationAssertions(new Task(), ['title', 'due_date', 'completed', 'description']);
    }
}
