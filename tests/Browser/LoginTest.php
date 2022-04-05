<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseTransactions;

    public function test_can_login()
    {
        $this->browse(function ($browser) {
            $browser->visitRoute('login')
                ->type('email', 'frankAdmin@hotmail.com')
                ->type('password', 'mama123')
                ->press('login')
                ->assertPathIs('/');
        });
    }
}
