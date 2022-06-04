<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 4;
        //
        $user = auth()->user() ?? $request->user();
        $userEntities = Entity::where('user_id', $user->id)->orWhere('created_by_user_id', $user->id)->where('user_id', false)->withCount([
            'bookmarks',
            'bookmarks as bookmarked' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }
        ])->withCasts(['bookmarked' => 'boolean'])->with(['country', 'state', 'city', 'categories'])->paginate($paginate); //las que somos dueños
        return Inertia::render('UserEntities', [
            'user_entities' => $userEntities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_categories = Category::where('parent_id', null)->with('children')->get();
        return Inertia::render('EntityCreate', [
            'edit' => false,
            'categories' => $parent_categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function show(Entity $entity)
    {
        //return Entity::where("id", "4")->with(['posts'])->get();
        $user_id = auth()->user()->id ?? null;
        $paginate = 10;
        //  
        $entity = $entity::where('id', $entity->id)->withCount([
            'bookmarks',
            'bookmarks as bookmarked' => function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            }
        ])->withCasts(['bookmarked' => 'boolean'])->with(['country', 'state', 'city',]);
        //
        $entity = $entity->with(['categories'])->first();
        $posts = $entity->posts()->paginate($paginate);

        if (request()->wantsJson()) {
            return $posts;
        }

        return Inertia::render('EntityProfile', [
            'entity' => $entity,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entity  $entity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entity $entity)
    {
        //
    }
}
