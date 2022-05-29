<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EntityCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntityCategory>
 */
class EntityCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = EntityCategory::class;

    public function definition()
    {
        return [
            //
            'entity_id' =>  null,
            'category_id' =>  null,
        ];
    }
}
