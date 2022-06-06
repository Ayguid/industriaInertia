<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    public function index()
    {
        # code...
        $parent_categories = Category::where('parent_id', null)->with('children')->get(); //solo la primer generacion de hijos, no metemos todos los nietos
        return Inertia::render('Admin/Categories', [
            'categories' => $parent_categories
        ]);
    }

    //store category
    public function store(Request $request)
    {
        //
        Category::create([
            'parent_id' => $request['parent_id'],
            'name' => $request['name'],
        ]);
        //
        return redirect()->back();
    }

    public function update(Request $request, Category $category) //falta validar el REQUEST!!!
    {
        $category->name = $request['name'];
        $category->update();
        //
        return redirect()->back();
    }

    public function destroy(Category $category)
    {
        $category->delete();
        //
        return redirect()->back();
    }
}
