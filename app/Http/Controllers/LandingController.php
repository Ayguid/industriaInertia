<?php

namespace App\Http\Controllers;
//
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Category;

class LandingController extends Controller
{
    //
    public function index()
    {
        $parent_categories = Category::where('parent_id', null)->with('children')->get();
        return Inertia::render('Landing', [
            'categories' => $parent_categories
        ]);
    }
}
