<?php

namespace Tests\Feature\View\Components\Nav\Top;

use Tests\TestCase;

class ItemTest extends TestCase
{
    /**
     * @var string example component
     */
    private string $component = '<x-nav.top.item route="welcome">Home</x-nav.top.item>';

    public function test_slot(): void
    {
        $this->blade($this->component)
            ->assertSee('Home');
    }

    public function test_route(): void
    {
        $this->blade($this->component)
            ->assertSeeInOrder(['href', route('welcome')]);
    }

    public function test_active_class_get_set(): void
    {
        $this->get(route('welcome'));

        $this->blade($this->component)
            ->assertSee('active');
    }

    public function test_active_class_is_not_set(): void
    {
        $this->get('test');

        $this->blade($this->component)
            ->assertDontSee('active');
    }

    public function test_active_class_is_only_set_on_correct_component(): void
    {
        $this->get(route('welcome'));

        $this->blade($this->component.str_replace('welcome', 'dashboard', $this->component))
            ->assertSeeInOrder(['nav-link', 'active', 'href', route('welcome'), 'nav-link', 'href', 'dashboard']);
    }
}
