<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LabelTest extends DuskTestCase
{
    use DatabaseTransactions;

    public function testCreatingLable()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))->visitRoute('packages.labels.print')
                ->check('tr.hover\:bg-gray-100:nth-child(1) > td:nth-child(4) > div:nth-child(1) > input:nth-child(1)')
                ->click('#print')
                ->assertSee('Label(s) successfully created');
        });
    }

    public function testLabelToPdf()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))->visitRoute('packages.labels')
                ->check('tr.hover\:bg-gray-100:nth-child(1) > td:nth-child(7) > div:nth-child(1) > input:nth-child(1)')
                ->check('tr.hover\:bg-gray-100:nth-child(2) > td:nth-child(7) > div:nth-child(1) > input:nth-child(1)')
                ->click('#toPdf')
                ->assertDontSee('#toPdf');
        });
    }

    public function testSearchingTable()
    {
        $toSearch = 'woon';

        $this->browse(function ($browser) use ($toSearch) {
            $browser->visitRoute('packages.labels')
                ->keys('#search', $toSearch, '{enter}')
                ->assertQueryStringHas('search', $toSearch);
        });
    }
}
