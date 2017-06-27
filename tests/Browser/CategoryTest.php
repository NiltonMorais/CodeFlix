<?php

namespace Tests\Browser;

use CodeFlix\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::where('email','=','admin@user.com')->first();

        $this->browse(function (Browser $browser) use($user){
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de categorias')
                ->clickLink('Nova categoria')
                ->assertSee('Nova categoria')
                ->type('name','categoria teste')
                ->click('button[type=submit]')
                ->assertSee('Listagem de categorias')
                ->assertSee('categoria teste');
        });
    }
}
