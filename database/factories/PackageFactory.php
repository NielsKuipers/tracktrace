<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company' => Company::factory(),
            'name' => $this->faker->name,
            'zipcode' => $this->faker->postcode,
            'building_number' => $this->faker->buildingNumber,
            'street' => $this->faker->streetName,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'weight' => $this->faker->numberBetween(50, 10000),
            'tracking_code' => $this->faker->bothify('#?????#########'),
            'status' => $this->faker->randomElement(['recorded', 'printed', 'received', 'sent', 'delivered'])
        ];
    }
}
