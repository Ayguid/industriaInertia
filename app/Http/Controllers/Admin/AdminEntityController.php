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
            'entity' => $entity->with(['user', 'country', 'state', 'city'])->first()
        ]);
    }
}
