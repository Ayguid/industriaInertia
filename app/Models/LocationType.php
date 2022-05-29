<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationType extends Model
{
    use HasFactory;
    //protected $table = ["location_types"];
    protected $fillable = [
        'parent_id',
        'name'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    //protected $with = ['children'];

    public function child()
    {
        return $this->hasOne($this, 'parent_id');
    }
    /*
    public function children()
    {
        return $this->childs()->with('children')->orderBy('name');
    }
    */
}
