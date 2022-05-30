<?php

namespace App\Http\Controllers;

use App\Models\Entity;
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
        $userEntities = Entity::where('user_id', $user->id)->orWhere('created_by_user_id', $user->id)->where('user_id', false)->with('country', 'state', 'city')->paginate($paginate); //las que somos dueños
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
        return Inertia::render('EntityCreate', [
            'edit' => false
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
        $user_id = auth()->user()->id ?? null;
        //  
        $ent = $entity::where('id', $entity->id)->withCount([
            'bookmarks',
            'bookmarks as bookmarked' => function ($q) use ($user_id) {
                $q->where('user_id', $user_id);
            }
        ])->withCasts(['bookmarks' => 'boolean']);
        return Inertia::render('EntityProfile', [
            'entity' => $ent->first()
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
