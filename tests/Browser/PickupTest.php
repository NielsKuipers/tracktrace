<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PickupTest extends DuskTestCase
{
    use DatabaseTransactions;

    public function testPickup()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))->visitRoute('packages.pickup')
                ->click('#time')
                ->click('.flatpickr-next-month > svg:nth-child(1)')
                ->click('span.flatpickr-day:nth-child(18)')
                ->type('zipcode', '1234AB')
                ->type('building_nr', 24)
                ->type('country', 'The Netherlands')
                ->check('tr.hover\:bg-gray-100:nth-child(1) > td:nth-child(7) > div:nth-child(1) > input:nth-child(1)')
                ->press('.bg-blue-500')
                ->assertPathIs('/packages/pickup')
                ->assertSee('Pickup successfully created');
        });
    }

    public function testSearchingTable()
    {
        $toSearch = 'woon';

        $this->browse(function ($browser) use ($toSearch) {

            $browser->visitRoute('packages.pickup')
                ->keys('#search', $toSearch, '{enter}')
                ->assertQueryStringHas('search', $toSearch);
        });
    }
}
