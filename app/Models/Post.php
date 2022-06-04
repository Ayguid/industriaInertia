<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Entity;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'model_type',
        'model_id'
    ];

    protected $with = ['media'];

    public function model()
    {
        return $this->morphTo();
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    //
    public function entityAuthor()
    {
        return $this->belongsTo(Entity::class, 'model_id')->select('id', 'username');
    }
}
