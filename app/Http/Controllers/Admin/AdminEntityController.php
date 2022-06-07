<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Entity;

class AdminEntityController extends Controller
{
    public function index()
    {
        # code...
        $paginate = 5;
        if (isset(request()->query('query')['email'])) {
            $entities = Entity::where('email', 'like', '%' . request()->query('query')['email'] . '%');
        } else {
            $entities = new Entity();
        }
        return Inertia::render('Admin/Entities', [
            'entities' => $entities->with(['country', 'state', 'city', 'user'])->paginate($paginate)->appends(request()->query()),
            'query' => request()->query('query'),
        ]);
    }

    public function show(Entity $entity)
    {
        return Inertia::render('Admin/EntityProfile', [
            'entity' => $entity->with(['country', 'state', 'city'])->first()
        ]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pasamos el modelo para que se arme el form solo con los fillables
        $model = new Entity();
        return Inertia::render('Admin/EntityCreate', [
            'entity_model' =>  $model->getFillable(),
        ]);
    }
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            //'title' => 'required|string|min:4',
            'description' => 'required|string|min:4',
            'username' => 'required|string|min:4|unique:entities',
        ]);
        //pasamos el modelo para que se arme el form solo con los fillables
        Entity::create($request->all());
        return redirect()->back();
    }
}
