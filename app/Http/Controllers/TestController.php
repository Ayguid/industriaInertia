<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Category;
use App\Models\Entity;
use Storage;

class TestController extends Controller
{
    //
    public function index()
    {
        /*Test START*/
        //[169, 215, 216]
        $categories = json_decode(request()->get('categories'));
        //return $categories;
        $catsWithDescsFlat = [];
        //
        //sacamos los arrays vacios categories=[[1],[]] ..enrealidad viene stringified categories=%5B%5B%5D%2C%5B206%5D%5D
        foreach ($categories as $key => $category) {
            if (!empty($category)) {
                $categoryAndDescsFlat = $this->flatten(Category::whereIn('id', $category)->with('children')->get()->toArray());
                array_push($catsWithDescsFlat, array_column($categoryAndDescsFlat, 'id'));
            }
        }
        $entities = Entity::with('categories');
        foreach ($catsWithDescsFlat as $ids) {
            $entities->whereHas('categories', function ($q) use ($ids) {
                $q->whereIn('categories.id', $ids);
            });
        }
        //
        return $entities->with('categories')->get();
    }




    // transform nested result to simple array without nest hierarchie
    private function flatten($array)
    {
        //dd($array);
        $result = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $result[] = array_filter($item, function ($array) {
                    return !is_array($array);
                });
                $result = array_merge($result, $this->flatten($item));
            }
        }
        return array_filter($result);
    }







    public function createSuperAdmin()
    {
        /*
        $role = Role::create(['name' => 'super-admin']);
        $user = User::where('id', 1)->first();
        $user->assignRole($role);
        */
    }
}
