<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LocationType;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'parent_id',
        'name',
        'code',
        'lat',
        'lon',
        'postal_code'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    //protected $with = ['type']; //, 'children' , 'parent'

    public function type()
    {
        return $this->belongsTo(LocationType::class, "type_id");
    }


    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function children()
    {
        return $this->childs()->with('children')->orderBy('name');
    }
    public function parent()
    {
        return $this->hasOne($this, 'id', 'parent_id')->select('id', 'name');
    }
}
