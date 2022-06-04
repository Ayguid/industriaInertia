<?php

namespace App\Http\Controllers;
//
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Entity;

class LandingController extends Controller
{
    //
    public function index()
    {
        //
        $catIds = [];
        $locationsIds = [];
        $user_id = auth()->user()->id  ?? null;
        $paginate = 5;
        /////////////////////// settings BEFORE  query ///////////////
        // ex locations inRequest locations=[{id:1,name:"algo", parent:{id:1,name:"algoParent"}},{id:1,name:"algo"}] 
        if (request()->exists('locations')) {
            //armamos un array con los ids de el array de objetos que llego para locations
            $locationsIds = array_column(json_decode(request()->get('locations')), 'id');
        }
        // ex cats inRequest categories=[[1],null,[34, 60],null] 
        if (request()->exists('categories')) {
            $catIds = json_decode(request()->get('categories'));
            //sacamos los null values, para que no rompa el reduce
            $catIds = array_map(function ($v) {
                return (is_null($v)) ? [] : $v;
            }, $catIds);
            //aplanamos el array a una dimension
            $catIds = array_reduce($catIds, 'array_merge', array());
        }

        ///////////////////////////////////////////////////////////////
        /////////////// conditions of query ///////////////////////////////////////////////////////////////////////////
        if (count($catIds) == 0 && count($locationsIds) > 0) { //si hay locations y  no hay categories 
            $entities = Entity::where(function ($query) use ($locationsIds) {
                $query->whereIn('country_id', $locationsIds)
                    ->orWhereIn('state_id', $locationsIds)
                    ->orWhereIn('city_id', $locationsIds);
            });
        } else if (count($catIds) > 0 && count($locationsIds) == 0) { // si hay categorias en el filter, y no hay locations
            $entities = Entity::whereHas('categories',  function ($query) use ($catIds) {
                $query->whereIn('categories.id', $catIds)
                    ->orWhere('categories.parent_id', $catIds);
            });
            //->orWhere('categories.parent_id', $catIds)
            /*
                ->orWhereHas('parent', function ($query) use ($catIds) {
                    return $query->where('id', $catIds);
                });
                ->orWhereIn('parent_id', $catIds);
                ->orWhereHas('grandParent', function ($query) use ($catIds) {
                    return $query->whereIn('category_id', $catIds);
                });
                */
        } else if (count($catIds) > 0 && count($locationsIds) > 0) { //si hay categories y locations
            $entities = Entity::where(function ($query) use ($locationsIds) {
                $query->whereIn('country_id', $locationsIds)
                    ->orWhereIn('state_id', $locationsIds)
                    ->orWhereIn('city_id', $locationsIds);
            })->whereHas('categories',  function ($query) use ($catIds) {
                $query->whereIn('categories.id', $catIds)
                    ->orWhereIn('categories.parent_id', $catIds);
            });
        } else if (count($catIds) == 0 && count($locationsIds) == 0) { //hay nada de nada de nada
            $entities = new Entity(); //weird...
        }
        //appendeamos las relations/methods que queremos START-->
        $entities = $entities->with(['user', 'categories', 'country', 'state', 'city'])->withCount([
            'bookmarks',
            'bookmarks as bookmarked' => function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            }
        ])->withCasts(['bookmarked' => 'boolean'])->paginate($paginate)->appends(request()->query()); //el appends request query es para que nos vuelvan los parametros del filtro que fueron por get request
        //appendeamos las relations/methods que queremos END-->
        //las categorias para el filtro
        $parent_categories = Category::where('parent_id', null)->with('children')->get();
        // return final
        return Inertia::render('Landing', [
            'query_params' => request()->query(),
            'categories' => $parent_categories,
            'entities' => $entities,
        ]);
    }

    // transform nested result to simple array without nest hierarchie
    private function flatten($array)
    {
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
}
