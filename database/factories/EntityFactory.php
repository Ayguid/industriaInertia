<?php

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entity>
 */
class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Entity::class;

    public function definition()
    {
        return [
            'created_by_user_id' => null,
            'user_id' =>  null,
            'name' => $this->faker->company(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'website' => $this->faker->domainName(),
            'description' => $this->faker->paragraph(),
            'description_alt' => $this->faker->bs(),
            'cuil' => null,
            'cuit' => null,
            'founded_date' => $this->faker->dateTime(),
            'employee_count' => $this->faker->numberBetween(0, 100),
            'country_id' => null,
            'state_id' => null,
            'city_id' => null,
            'street' => $this->faker->streetName(),
            'street_number' => $this->faker->buildingNumber(),
            'apartment' => $this->faker->buildingNumber(),
            'apartment_number' => $this->faker->buildingNumber(),
            'postal_code' => $this->faker->postcode(),
            'phone' => $this->faker->phoneNumber(),
            'phone_alt' => $this->faker->e164PhoneNumber(),
            'international_activity_code' => $this->faker->e164PhoneNumber(),
        ];
    }
}
