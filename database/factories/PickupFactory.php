<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pickup>
 */
class PickupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'package_id' => Package::factory(),
            'zipcode' => $this->faker->postcode,
            'building_nr' => $this->faker->buildingNumber,
            'country' => $this->faker->country,
            'time' => $this->faker->dateTime,
        ];
    }
}
