<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Support\Collection;
use Storage;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Pais, Estado, ciudad,,,,,estado siendo provincia y cuidad siendo TODO el resto
        //$locationTypes = \App\Models\LocationType::factory(5)->create();

        $types = ["Country", "State", "City"];
        $previousId = null;
        $argentina = null;

        for ($i = 0; $i < count($types); $i++) { //creamos los types,,
            $locationType = \App\Models\LocationType::create([
                "name" => $types[$i],
                "parent_id" => $previousId
            ]);

            //
            if ($i == 0) { // es pais...
                $argentina = \App\Models\Location::create([
                    "name" => "Argentina",
                    "type_id" => $locationType->id,
                    "parent_id" => null
                ]);
            }

            if ($i == 1) { //insertamos las provincias 
                $json = Storage::disk('local')->get('jsons/provincias.json');
                $provincias = (new Collection(json_decode($json, true)));
                foreach ($provincias->all()["provincias"] as &$provincia) {
                    //var_dump($provincia);
                    //return;
                    $provResult = \App\Models\Location::create([
                        "name" => $provincia["nombre"],
                        "type_id" => $locationType->id,
                        "parent_id" => $argentina->id,
                        "lat" => $provincia["centroide"]["lat"],
                        "lon" => $provincia["centroide"]["lon"],
                    ]);
                    //insertamos las localidades 

                    $json2 = Storage::disk('local')->get('jsons/localidades.json');
                    $localidades = (new Collection(json_decode($json2, true)["localidades"]))->filter(function ($obj) use ($provincia) {
                        return $obj["provincia"]["id"] == $provincia["id"];
                    })->all();

                    //var_dump($localidades);
                    //return;
                    $nextTypeId = $provResult->type_id + 1;
                    foreach ($localidades as &$localidad) {
                        $localidad = \App\Models\Location::create([
                            "name" => $localidad["nombre"],
                            "type_id" => $nextTypeId,
                            "parent_id" => $provResult->id,
                            "lat" => $localidad["centroide"]["lat"],
                            "lon" => $localidad["centroide"]["lon"],
                        ]);
                    }

                    //localidades
                }
            }

            $previousId = $locationType->id;
        }
    }
}
