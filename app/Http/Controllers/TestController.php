<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
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
        $array = $fields = array();
        $i = 0;
        $handle = fopen(storage_path() . "/Aarvor  - entities.csv", "r");
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
        return $array;
    }
}
