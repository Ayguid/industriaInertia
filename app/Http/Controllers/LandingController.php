<?php

namespace App\Http\Controllers;
//
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Entity;
use App\Traits\FlattenTrait;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    use FlattenTrait; // $this->flatten() o self::flatten();
    //
    public function index()
    {
        $user_id = auth()->user()->id  ?? null;
        $categoriesInReq = (request()->exists('categories')) ? json_decode(request()->get('categories')) : [];
        $locationsIds = (request()->exists('locations')) ? array_column(json_decode(request()->get('locations')), 'id') : [];
        $entities = [];
        $paginate = 10;
        ///////////////////////////////////////////////////////////////
        /////////////// conditions of query ///////////////////////////
        // si hay categorias en el filter ,,,categoriesInReq = categories=[[1],null,[34, 60],null] 
        if (count($categoriesInReq) > 0) {
            $catsWithDescsFlat = []; // termina siendo asi [[...],[...]]
            $entities = Entity::with('categories');
            //
            foreach ($categoriesInReq as $key => $categoryArray) {
                //salteamos los arrays vacios categories=[[1],[]] ..enrealidad viene stringified categories=%5B%5B%5D%2C%5B206%5D%5D
                if (!empty($categoryArray)) { //aplanamos los childs de las categorias
                    // cambiando el whereIn ....
                    $categoryAndDescsFlat = $this->flatten(Category::whereIn('id', $categoryArray)->with('children')->get()->toArray()); //[123,213,222]
                    $categoriesIds = array_column($categoryAndDescsFlat, 'id'); //[123,213,222]
                    //
                    array_push($catsWithDescsFlat,  $categoriesIds); // [[123,213,222],[56,345]]
                }
            }
            //
            foreach ($catsWithDescsFlat as $ids) { // [[123,213,222],[56,345]]
                $entities->whereHas('categories', function ($q) use ($ids) {
                    $q->whereIn('categories.id', $ids);
                });
            }
            //
        }
        //hay nada de nada de nada
        else if (count($categoriesInReq) == 0 && count($locationsIds) == 0) {
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
        //
        //las categorias para el filtro
        $parent_categories = Cache::remember('parent_categories', 60, function () {
            return Category::where('parent_id', null)->with('children')->get();
        });
        // return final
        return Inertia::render('Landing', [
            'query_params' => request()->query(),
            'categories' => $parent_categories,
            'entities' => $entities,
        ]);
    }
}
