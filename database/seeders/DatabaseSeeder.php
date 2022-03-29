<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Package;
use App\Models\Pickup;
use App\Models\User;
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
        Package::factory(15)->create();
        Pickup::factory(5)->create();
        User::factory(4)->create();

        for ($i = 0; $i < 5; $i++) {
            $company = Company::factory()->create();

            User::factory()->create([
                'company_id' => $company->id,
                'role' => 'company_account'
            ]);
        }

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
    }
}
