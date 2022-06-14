<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Entity;
use App\Models\EntityCategory;
use DB;

class AdminEntityController extends Controller
{
    public function index()
    {
        # code...
        $paginate = 5;
        if (isset(request()->query('query')['email'])) {
            $entities = Entity::where('email', 'like', '%' . request()->query('query')['email'] . '%');
        } else {
            $entities = new Entity();
        }
        return Inertia::render('Admin/Entities', [
            'entities' => $entities->with(['country', 'state', 'city', 'user'])->paginate($paginate)->appends(request()->query()),
            'query' => request()->query('query'),
        ]);
    }

    public function show(Entity $entity)
    {
        return Inertia::render('Admin/EntityProfile', [
            'entity' => $entity->with(['categories', 'country', 'state', 'city'])->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //pasamos el modelo para que se arme el form solo con los fillables
        $model = new Entity();
        return Inertia::render('Admin/EntityCreate', [
            'entity_model' =>  $model->getFillable(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        return DB::transaction(function () use ($request) {
            //validamos la data obligatoria////////////
            $validatedData = $request->validate([
                'username' => 'required|string|min:4|unique:entities',
                'name' => 'required|string|min:4',
                'description' => 'required|string|min:8',
            ]);
            //Creacion de entidad//////////////
            //si el usuario no creo la entidad dejamos el user id en false/0
            //guardamos por otro lado quien creo la entidad en, created_by 
            $newEntity = Entity::create(
                [
                    'user_id' => $request['user_id'] ?? null,
                    'created_by_user_id' => $request['created_by_user_id'] ?? null,
                    'name' => $validatedData['name'],
                    'email' => $request['email'],
                    'username' => $request['username'],
                    'description' => $validatedData['description'],
                    'website' => $request['website'],
                    'employee_count' => $request['employee_count'],
                    'founded_date' => $request['founded_date'],
                    'phone' => $request['phone'],
                    'phone_alt' => $request['phone_alt'],
                    'cuil' => $request['cuil'],
                    'cuit' => $request['cuit'],
                    'country_id' => $request['country_id'] ?? null,
                    'state_id' => $request['state_id'] ?? null,
                    'city_id' => $request['city_id'] ?? null,
                    'street' => $request['street'],
                    'street_number' => $request['street_number'],
                    'apartment' => $request['apartment'],
                    'apartment_number' => $request['apartment_number'],
                    'postal_code' => $request['postal_code'],
                ]
            );
            // si llego un array con ids de categorias en $request['catIds'], creamos las entityCategories
            if (count($request['categories']) > 0) {
                $entCats = [];
                for ($i = 0; $i < count($request['categories']); $i++) {
                    $entityCategory = new EntityCategory(
                        [
                            'category_id' => $request['categories'][$i],
                        ]
                    );
                    array_push($entCats,  $entityCategory);
                }
                //salvamos todas las categories para ese entity
                $newEntity->entCats()->saveMany($entCats);
            }
            //devolvemos 
            return redirect()->back()->with('success', 'Entity created successfully');
        });
    }
}
