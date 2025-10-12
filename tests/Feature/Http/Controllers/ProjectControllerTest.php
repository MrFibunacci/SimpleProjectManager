<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
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
}
