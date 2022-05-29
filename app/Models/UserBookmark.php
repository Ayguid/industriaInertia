<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBookmark extends Model
{
    use HasFactory;
    protected $fillable = [
        'entity_id',
        'user_id',
    ];
}
