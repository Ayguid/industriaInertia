<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class TestController extends Controller
{
    //
    public function index()
    {
        /*
        $role = Role::create(['name' => 'super-admin']);
        $user = User::where('id', 1)->first();
        $user->assignRole($role);
        */
        return;
    }
}
