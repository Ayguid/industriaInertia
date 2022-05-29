<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LocationType>
 */
class LocationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   //$this->faker->country(),
        return [
            //
            'parent_id' => null,
            'name' => $this->faker->jobTitle()
        ];
    }
}
