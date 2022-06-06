<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
//use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    //
    public function index()
    {
        //devolvemos los posts de los entities que el user tiene bookmarked
        $paginate = 15;
        $posts = Post::whereIn('model_id', auth()->user()->bookmarks()->get()->pluck("id"))
            ->with(['entityAuthor'])
            ->latest()
            //->orderBy('')
            ->paginate($paginate);
        // return final

        if (request()->wantsJson()) {
            return $posts;
        }

        return Inertia::render('Dashboard', [
            'posts' => $posts
        ]);
    }
}
