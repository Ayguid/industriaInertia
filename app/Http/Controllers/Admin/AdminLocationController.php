<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Location;

class AdminLocationController extends Controller
{
    //
    public function index(Location $location)
    {
        # code...
        //$paginate = 10;
        if ($location->id) {
            $locations = Location::where('id', $location->id);
        } else {
            $locations = Location::where('parent_id', null);
        }
        return Inertia::render('Admin/Locations', [
            'locations' => $locations->with('childs')->get()
        ]);
    }
}
