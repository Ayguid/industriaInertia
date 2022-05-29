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
            'description' => $this->faker->bs(),
            //'country' => $this->faker->country(),
            //'state' => $this->faker->state(),
            //'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'stree_number' => $this->faker->buildingNumber(),
            'postal_code' => $this->faker->postcode(),
            'phone' => $this->faker->phoneNumber(),
            'cellphone' => $this->faker->e164PhoneNumber(),
        ];
    }
}
