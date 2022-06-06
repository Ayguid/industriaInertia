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
}
