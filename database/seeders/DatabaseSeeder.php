<?php

namespace Database\Seeders;

use App\enums\PackageStatus;
use App\Models\Company;
use App\Models\Label;
use App\Models\Package;
use App\Models\Pickup;
use App\Models\TrackingCode;
use App\Models\User;
use App\Models\UserTrackingCode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()->create();

        //create admin account
        User::factory()->create([
            'email' => 'frankAdmin@hotmail.com',
            'first_name' => 'Frank',
            'role' => 'admin',
            'password' => 'mama123'
        ]);

        //create company account
        User::factory()->create([
            'email' => 'frankCompany@hotmail.com',
            'first_name' => 'Frank',
            'role' => 'company_account',
            'company_id' => 1,
            'password' => 'mama123'
        ]);

        //create customer account
        User::factory()->create([
            'email' => 'frankCustomer@hotmail.com',
            'first_name' => 'Frank',
            'role' => 'customer',
            'company_id' => 1,
            'password' => 'mama123'
        ]);

        for ($i = 0; $i < 5; $i++) {
            $company = Company::factory()->create();

            User::factory()->create([
                'company_id' => $company->id,
                'role' => 'company_account'
            ]);
        }

        for ($i = 0; $i < 25; $i++) {

            switch ($i) {
                case $i == 1:
                    $status = PackageStatus::PRINTED;
                    break;
                case $i == 5:
                    $status = PackageStatus::DELIVERED;
                    break;
                case $i == 10:
                    $status = PackageStatus::SORTING;
                    break;
                case $i == 15:
                    $status = PackageStatus::SENT;
                    break;
                case $i == 20:
                    $status = PackageStatus::FINISHED;
                    break;
            }

            $package = Package::factory()->create([
                'status' => $status->toString()
            ]);

            TrackingCode::factory()->create([
                'package_id' => $package->id
            ]);

            UserTrackingCode::factory()->create([
                'package_id' => $package->id
            ]);

            Label::factory()->create([
                'package_id' => $package->id
            ]);

            Pickup::factory()->create([
                'package_id' => $package->id
            ]);
        }

        Package::factory(10)->create([
            'status' => PackageStatus::LOGGED->toString()
        ]);

        User::factory(25)->create([
            'role' => 'customer'
        ]);
    }
}
