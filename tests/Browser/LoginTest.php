<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginFailed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email', 'asdasd@user.com')
                ->type('password', '123456')
                ->press('LoginPage')
                ->assertSee('LoginPage');
        });
    }

    public function testLoginSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->type('email', 'admin@user.com')
                ->type('password', 'secret')
                ->press('LoginPage')
                ->assertPathIs('/admin/dashboard');
        });
    }
}
