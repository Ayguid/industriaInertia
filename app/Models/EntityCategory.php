<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Entity;

class EntityCategory extends Model
{
    use HasFactory;

    protected $fillable = ['entity_id', 'category_id'];



    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
