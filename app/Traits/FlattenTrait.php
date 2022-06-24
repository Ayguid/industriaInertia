<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait FlattenTrait
{

    /**
     * @param Request $request
     * @return $this|false|string
     */
    //
    // transform nested result to simple array without nest hierarchie
    static function flatten($array)
    {
        //dd($array);
        $result = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $result[] = array_filter($item, function ($array) {
                    return !is_array($array);
                });
                $result = array_merge($result, self::flatten($item));
            }
        }
        return array_filter($result);
    }
}
