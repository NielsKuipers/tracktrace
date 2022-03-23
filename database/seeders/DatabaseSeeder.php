<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Pickup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
