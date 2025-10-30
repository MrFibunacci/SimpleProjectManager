<?php

namespace Feature\Http\Controllers;

use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_index_page_can_be_viewed(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('status'));
        $response->assertOk();
        $response->assertViewIs('status.index');
    }

    public function test_create_page_can_be_viewed()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get(route('status.create'));
        $response->assertOk();
        $response->assertViewIs('status.create');
    }

    public function test_status_can_be_created()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('status.store'), [
            'name' => 'Test Status',
        ]);

        $response->assertRedirect(route('status'));
        $this->assertDatabaseHas('statuses', ['name' => 'Test Status']);
    }

    public function test_status_can_be_deleted()
    {
        $this->actingAs(User::factory()->create());

        $status = Status::factory()->create();

        $response = $this->delete(route('status.destroy', $status));
        $response->assertRedirect(route('status'));
        $this->assertDatabaseMissing('statuses', ['name' => $status->name]);
    }
}
