<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\Category;
use App\Models\User;
//use App\Support\Collection; //herramienta para paginear jsons

class PublicApiController extends Controller
{
    //
    //buscamos paises con ese nombre
    public function fetchCountries(Request $request)
    {
        $locations = Location::where('parent_id', null)->get();
        return response($locations, 200);
    }
    public function fetchStates(Request $request)
    {
        $parent_id = $request['parent_id'];
        $locations = Location::where("parent_id", $parent_id)->get();
        return response($locations, 200);
    }
    public function fetchCities(Request $request)
    {
        $parent_id = $request['parent_id'];
        $locations = Location::where("parent_id", $parent_id)->get();
        return response($locations, 200);
    }

    public function locations(Request $request)
    {
        $queryParam = $request['query']; // el nombre que escribieron
        $locations = Location::where("name", 'like', '%' . $queryParam . '%')
            ->orWhereHas('parent',  function ($loc) use ($queryParam) {
                return $loc->where("name", 'like', '%' . $queryParam . '%');
            })->with('parent:id,name')->paginate(100);

        return response($locations, 200);
    }
    public function categories(Request $request)
    {
        $queryParam = $request['query']; // el nombre que escribieron
        $locations = Category::where("name", 'like', '%' . $queryParam . '%')->paginate(100);
        return response($locations, 200);
    }
    public function users(Request $request)
    {
        $queryParam = $request['query']; // el nombre que escribieron
        $users = User::where("email", 'like', '%' . $queryParam . '%')->paginate(100);
        return response($users, 200);
    }
}
