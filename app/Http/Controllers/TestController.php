<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Category;
use Storage;

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
    }

    public function seedCategories()
    {
        $array = $fields = array();
        $i = 0;
        //$handle = fopen(storage_path() . "/Aarvor  - entities.csv", "r");
        $handle = fopen(storage_path() . "/Aarvor  - Categories.csv", "r");
        if ($handle) {
            while (($row = fgetcsv($handle, 4096)) !== false) {
                if (empty($fields)) {
                    $fields = $row;
                    continue;
                }
                foreach ($row as $k => $value) {
                    $array[$i][$fields[$k]] = $value;
                }
                $i++;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }
        //return $array;
        foreach ($array as $k => $category) {
            //dd($category['parent_id']);
            $cat = Category::create([
                'id'          => $category['id'],
                'parent_id'   => ($category['parent_id'] != 'null') ? $category['parent_id'] : null,
                'name'        => $category['name'],
            ]);
        }
    }
}
