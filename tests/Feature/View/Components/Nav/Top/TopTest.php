<?php

namespace Tests\Feature\View\Components\Nav\Top;

use Tests\TestCase;
use App\Models\User;

class TopTest extends TestCase
{
    public function test_links():void
    {
        $this->actingAs(User::factory()->create());

        $this->blade('<x-nav.top/>')
            ->assertSeeInOrder(['href="'.route('welcome').'"', config('app.name', 'Laravel')])
            ->assertSeeInOrder(['href="'.route('projects').'"', 'projects']);
//            ->assertSeeInOrder(['href="'.route('tasks').'"', 'tasks'])
//            ->assertSeeInOrder(['href="'.route('settings').'"', 'settings'])
    }
}
