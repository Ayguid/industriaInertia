<?php

namespace Database\Seeders;

use App\Models\Category;
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
        /*
        \App\Models\User::factory(10)->create()->each(function ($user) {
            $entities = \App\Models\Entity::factory(3)->create();
            $user->entities()->saveMany($entities);
        });
        */
        \App\Models\User::factory(10)->create()->each(function ($user) use ($catsAll) {
            $entities = \App\Models\Entity::factory(3)->create()

                ->each(function ($entity, $i) use ($catsAll) {
                    \App\Models\EntityCategory::factory(1)->create(['entity_id' => $entity->id, 'category_id' => $catsAll->random()->id]);
                    \App\Models\EntityCategory::factory(1)->create(['entity_id' => $entity->id, 'category_id' => $catsAll->random()->id]);
                });

            $user->entities()->saveMany($entities);
        });

        //USERS SOLOS
        //\App\Models\User::factory(10)->create();

    }
}
