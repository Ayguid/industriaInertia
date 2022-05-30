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
        $user_id = auth()->user()->id  ?? null;
        $paginate = 5;
        //
        if (request()->exists('categories')) {
            $catIds = json_decode(request()->get('categories'));
            $catIds = array_map(function ($v) { //sacamos los null values, para que no rompa el reduce
                return (is_null($v)) ? [] : $v;
            }, $catIds);
            $catIds = array_reduce($catIds, 'array_merge', array()); //aplanamos el array a una dimension
        }
        if (count($catIds) > 0) { // si hay categorias en el filter
            $entities = Entity::whereHas('categories',  function ($query) use ($catIds) {
                return $query->whereIn('category_id', $catIds)->orWhereIn('parent_id', $catIds);
            })->with(['user', 'categories']);
        } else { //sino hay nada
            $entities = Entity::with(['user', 'categories']);
        }
        //las categorias para el filtro
        $parent_categories = Category::where('parent_id', null)->with('children')->get();
        //appendeamos las relations/methods que queremos -->
        $entities = $entities->withCount([
            'bookmarks',
            'bookmarks as bookmarked' => function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            }
        ])->withCasts(['bookmarked' => 'boolean'])->paginate($paginate)->appends(request()->query()); //el appends request query es para que nos vuelvan los parametros del filtro que fueron por get request
        // return final
        return Inertia::render('Landing', [
            'query_params' => request()->query(),
            'categories' => $parent_categories,
            'entities' => $entities,
        ]);
    }
}
