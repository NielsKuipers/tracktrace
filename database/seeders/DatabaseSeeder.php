<?php

namespace Database\Seeders;

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
        User::factory(9)->create();

        User::factory()->create([
            'email' => 'frankAdmin@hotmail.com',
            'first_name' => 'Frank',
            'role' => 'admin'
        ]);
    }
}
