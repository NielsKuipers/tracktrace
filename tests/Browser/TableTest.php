<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TableTest extends DuskTestCase
{
    public function testPackageHeaderSorting()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))->visitRoute('packages.index')
                ->click('#id_header')
                ->assertQueryStringHas('sort', 'id')
                ->assertQueryStringHas('order', 'asc')
                ->click('#id_header')
                ->assertQueryStringHas('sort', 'id')
                ->assertQueryStringHas('order', 'desc')
                ->click('#first_name_header')
                ->assertQueryStringHas('sort', 'first_name')
                ->assertQueryStringHas('order', 'asc')
                ->click('#last_name_header')
                ->assertQueryStringHas('sort', 'last_name')
                ->assertQueryStringHas('order', 'desc')
                ->click('#street_header')
                ->assertQueryStringHas('sort', 'street')
                ->assertQueryStringHas('order', 'asc')
                ->click('#zipcode_header')
                ->assertQueryStringHas('sort', 'zipcode')
                ->assertQueryStringHas('order', 'desc')
                ->click('#country_header')
                ->assertQueryStringHas('sort', 'country')
                ->assertQueryStringHas('order', 'asc');
        });
    }

    public function testCustomerHeaderSorting()
    {
        $this->browse(function ($browser) {
            $browser->visitRoute('customers.index')
                ->click('#id_header')
                ->assertQueryStringHas('sort', 'id')
                ->assertQueryStringHas('order', 'asc')
                ->click('#id_header')
                ->assertQueryStringHas('sort', 'id')
                ->assertQueryStringHas('order', 'desc')
                ->click('#email_header')
                ->assertQueryStringHas('sort', 'email')
                ->assertQueryStringHas('order', 'asc')
                ->click('#first_name_header')
                ->assertQueryStringHas('sort', 'first_name')
                ->assertQueryStringHas('order', 'desc')
                ->click('#last_name_header')
                ->assertQueryStringHas('sort', 'last_name')
                ->assertQueryStringHas('order', 'asc');
        });
    }

    public function testPagination()
    {
        $this->browse(function ($browser){
            $browser->visitRoute('customers.index')
                ->clickAtXPath('/html/body/main/div/div/div[2]/nav/div[1]/a[1]')
                ->assertQueryStringHas('page', 2);
        });
    }

    public function testSearchingTable()
    {
        $toSearch = 'woon';
        $this->browse(function ($browser) use ($toSearch) {
            $browser->visitRoute('customers.index')
                ->keys('#search', $toSearch, '{enter}')
                ->assertQueryStringHas('search', $toSearch);
        });
    }
}
