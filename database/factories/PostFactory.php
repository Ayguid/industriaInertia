<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'model_type' => null,
            'model_id' =>  null,
            'user_id' => null,
            'title' => $this->faker->userName(),
            'content' => $this->faker->bs(),
        ];
    }
}
