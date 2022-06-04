<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\User;
use App\Models\Entity;
use App\Models\Location;

class AdminController extends Controller
{
    //
    public function index()
    {
        # code...        
        return Inertia::render('Admin/Dashboard', [
            'entity' => null
        ]);
    }

    public function categories()
    {
        # code...
        $parent_categories = Category::where('parent_id', null)->with('children')->get(); //solo la primer generacion de hijos, no metemos todos los nietos
        return Inertia::render('Admin/Categories', [
            'categories' => $parent_categories
        ]);
    }
    public function users()
    {
        # code...
        $users = User::paginate(5);
        return Inertia::render('Admin/Users', [
            'users' => $users
        ]);
    }
    public function entities()
    {
        # code...
        $paginate = 10;
        $entities = Entity::with(['country', 'state', 'city', 'user'])->paginate($paginate);
        return Inertia::render('Admin/Entities', [
            'entities' => $entities
        ]);
    }
    public function locations(Location $location)
    {
        # code...
        $paginate = 10;
        if ($location->id) {
            $locations = Location::where('id', $location->id);
        } else {
            $locations = Location::where('parent_id', null);
        }
        return Inertia::render('Admin/Locations', [
            'locations' => $locations->with('childs')->get()
        ]);
    }

    //store

    public function storeCategory(Request $request)
    {
        //
        Category::create([
            'parent_id' => $request['parent_id'],
            'name' => $request['name'],
        ]);
        //
        return redirect()->back();
    }

    public function updateCategory(Request $request) //falta validar el REQUEST!!!
    {
        //dd($request['id']);
        $category = Category::find($request['id']);
        $category->name = $request['name'];
        $category->update();
        //
        return redirect()->back();
    }
}
