<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends DuskTestCase
{

    public function test_dashboar_page_with_welcome_email()
    {
        $user = User::factory()->create();
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login / Register')
                    ->waitForText('Welcome')
                    ->assertSee($user->email);
            $browser->assertSee('Share a movies')->deleteCookie('app_session_cookie');
        });

    }

    public function test_dashboar_page_share_button()
    {
        $this->browse(function ($browser) {
            $browser->visit('/dashboard')
                    ->waitForText('Welcome')
                    ->assertSee('Share a movies');
        });
    }

    public function test_share_button_click_to_share_youtube_video()
    {
        $this->browse(function ($browser) {
            $browser->visit('/dashboard')
                    ->waitForText('Welcome')
                    ->assertSee('Share a movies')
                    ->click('#share-movie-btn')
                    ->assertPathIs('/movies/create');
        });
    }

    public function test_share_youtube_video_success()
    {
        $this->browse(function ($browser) {
            $browser->visit('/dashboard')
                    ->waitForText('Welcome')
                    ->assertSee('Share a movies')
                    ->click('#share-movie-btn');

            $browser->waitForText('Share a Youtube movies')
                    ->type('url_link', 'https://www.youtube.com/watch?v=hjLi2Tr0pHQ')
                    ->press('Share')
                    ->assertSee('Movie success added!');
        });
    }


    public function test_share_youtube_video_wrong_url()
    {
        $this->browse(function ($browser) {
            $browser->visit('/dashboard')
                    ->waitForText('Welcome')
                    ->assertSee('Share a movies')
                    ->click('#share-movie-btn');

            $browser->waitForText('Share a Youtube movies')
                    ->type('url_link', 'https://www.youtube.com/wrongurl;123')
                    ->press('Share')
                    ->assertSee('Error: Youtube url is wrong format.');
        });
    }

    public function test_see_video_shared_on_dashboard_page()
    {
        $this->browse(function ($browser) {
            $browser->visit('/dashboard')
                    ->waitForText('Funny Movies');
            $browser->assertSee('Bosson - One In A Million');
        });
    }

    public function test_logout_page_and_see_login_button()
    {
        $this->browse(function ($browser) {
            $browser->click('#logoutBtn')
                    ->waitForText('Funny Movies')
                    ->assertSee('Login / Register');
        });
    }
}
