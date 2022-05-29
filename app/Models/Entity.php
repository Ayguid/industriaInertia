<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\user;
use App\Models\Post;
use App\Models\EntityCategory;
//use App\Models\UserBookmark;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;
//use App\Support\Collection;

class Entity extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by_user_id',
        'user_id',
        'name',
        'username',
        'email',
        'description',
        'cuit',
        'cuil',
        'founded_date',
        'employee_count',
        'country_id',
        'state_id',
        'city_id',
        'street',
        'street_number',
        'postal_code',
        'phone',
        'cellphone',
        'profile_path_url',
        'background_photo_path'
    ];

    //protected $appends = ['location'];
    protected $with = ['categories', 'user'];
    protected $appends = ['background_photo_path_full_url'];

    public function categories()
    {
        return $this->hasManyThrough(Category::class, EntityCategory::class, 'entity_id',  'id', 'id', 'category_id');
    }

    /*
    public function getEntityCategoriesAttribute()
    {
        return $this->categories()->get();
    }
    */

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name'); //'username'
    }

    public function entCats()
    {
        return $this->hasMany(EntityCategory::class);
    }

    public function bookmarks()
    {
        return $this->belongsToMany(User::class, 'user_bookmarks');
    }
    /*
    public function likes()
    {
        return $this->belongsToMany(User::class, 'liked_posts')->withTimestamps();
    }
    */
    // Buen ecperimento pero consumiria mucha memoria, mejor guardar el nombre y id de la localidad con la provincia
    /*
    public function getLocationAttribute()
    {
        $json = Storage::disk('local')->get('jsons/localidades.json');
        $collection = (new Collection(json_decode($json, true)['localidades']));
        return $collection->where("id", strval($this->location_id))->first();
    }
    */
    /*
    public function location()
    {
        return $this->hasOne(Location::class, "id", "location_id");
    }
    */

    public function country()
    {
        return  $this->belongsTo(Location::class, "country_id");
    }
    public function state()
    {
        return  $this->belongsTo(Location::class, "state_id");
    }
    public function city()
    {
        return  $this->belongsTo(Location::class, "city_id");
    }

    public function posts()
    {
        return $this->morphMany(Post::class, 'model');
    }


    public function getbackgroundPhotoPathFullUrlAttribute()
    {
        return url('storage/' . $this->background_photo_path);
    }
}
