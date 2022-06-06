<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        # code...
        $paginate = 5;
        //dd(isset(request()->query('query')['email']));
        if (isset(request()->query('query')['email'])) {
            $users = User::where('email', 'like', '%' . request()->query('query')['email'] . '%')
                ->paginate($paginate)
                ->appends(request()->query());
        } else {
            $users = User::paginate($paginate);
        }
        return Inertia::render('Admin/Users', [
            'users' => $users,
            'query' => request()->query('query'),
        ]);
    }


    public function show(User $user)
    {
        //return Entity::where("id", "4")->with(['posts'])->get();
        return Inertia::render('Admin/UserProfile', [
            'user' => $user
        ]);
    }
}
