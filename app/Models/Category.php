<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entity;
use App\Models\EntityCategory;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['parent_id', 'name'];

    //protected $appends = ['key'];

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }
    public function grandParent()
    {
        return $this->parent()->with('grandParent')->orderBy('name');
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function children()
    {
        return $this->childs()->with('children')->orderBy('name');
    }

    public function entities()
    {
        return $this->hasManyThrough(Entity::class, EntityCategory::class, 'category_id', 'id', 'id', 'entity_id');
    }


    //
    /*
    public static function boot()
    {
        parent::boot();

        // before delete() method call this
        static::deleting(function (Category $category) {
            $category->childs()->delete(); // esto hace un cascade de delete cuando se borra una categoria, borra a sus hijos
        });
    }
    */
}
