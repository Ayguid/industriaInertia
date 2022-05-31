<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

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
