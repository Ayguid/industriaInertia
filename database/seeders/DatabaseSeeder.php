<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use \App\Models\Location;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //5 CATEGORIAS PADRE con 3 hijos directos y 2 nietos

        $categories = \App\Models\Category::factory(5)->create()->each(function ($cat) {
            $cats = \App\Models\Category::factory(3)->create()->each(function ($grandson) {
                $grandsons = \App\Models\Category::factory(2)->create();
                $grandson->childs()->saveMany($grandsons);
            });
            $cat->childs()->saveMany($cats);
        });


        $catsAll = Category::all();
        //USERS CON ENTITIES

        \App\Models\User::factory(10)->create()->each(function ($user) use ($catsAll) {

            $entities = \App\Models\Entity::factory(3)->create()
                ->each(function ($entity, $i) use ($catsAll, $user) {
                    $country = Location::where('type_id', 1)->first();
                    $state = $country->childs->random();
                    $city = $state->childs->random();
                    $entity->country_id = $country->id;
                    $entity->state_id = $state->id;
                    $entity->city_id = $city->id;
                    \App\Models\EntityCategory::factory(1)->create(['entity_id' => $entity->id, 'category_id' => $catsAll->random()->id]);
                    \App\Models\EntityCategory::factory(1)->create(['entity_id' => $entity->id, 'category_id' => $catsAll->random()->id]);
                    \App\Models\Post::factory(15)->create(
                        ['model_type' => \App\Models\Entity::class, 'model_id' => $entity->id, 'user_id' => $user->id]
                    );
                });

            $user->entities()->saveMany($entities);
        });

        //USERS SOLOS
        //\App\Models\User::factory(10)->create();

    }
}
