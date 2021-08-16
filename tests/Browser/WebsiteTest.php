<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WebsiteTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_can_see_logo()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Funny Movies');
        });
    }

    public function test_can_see_login_register_button()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login / Register');
        });
    }

    public function test_login_with_user_to_dashboard_page()
    {
        $user = User::factory()->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login / Register')
                    ->assertPathIs('/dashboard');
        });

    }
}
