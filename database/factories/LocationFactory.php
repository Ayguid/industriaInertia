<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type_id' => null,
            'parent_id' =>  null,
            'name' => $this->faker->state(),
            'code' => $this->faker->stateAbbr(),
            'lat' => $this->faker->latitude(-90, 90),
            'lon' => $this->faker->longitude(-180, 180),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
