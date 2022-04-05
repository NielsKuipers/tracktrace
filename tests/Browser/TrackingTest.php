<?php

namespace Tests\Browser;

use App\enums\PackageStatus;
use App\Models\Package;
use App\Models\TrackingCode;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TrackingTest extends DuskTestCase
{
    public function testTrackPackage()
    {
        $package = Package::where('status', 'finished')->first();
        $code = TrackingCode::where('package_id', $package->id)->first();

        $this->browse(function ($browser) use ($code) {
            $browser->loginAs(User::find(3))->visitRoute('tracking.create')
                ->type('code', $code->tracking_code)
                ->click('#track')
                ->assertSee('Package status')
                ->assertSee($code->tracking_code);
        });
    }

    public function testReviewPackage()
    {
        $package = Package::where('status', 'finished')->first();

        $this->browse(function ($browser) use ($package) {
            $browser->visit('/tracked/package/' . $package->id)
                ->type('#rating', 4)
                ->type('#comment', 'This delivery has brought me great joy')
                ->click('#review')
                ->assertSee('Transaction reviewed successfully!');
        });
    }
}
