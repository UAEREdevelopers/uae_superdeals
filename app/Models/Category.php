<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
     use SoftDeletes;

       protected $guarded = ['id'];

    
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id','id');
    }


    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function packages()
    {
        return $this->hasMany(HotelPackage::class,'category_id','id');
    }

    public function setSlugAttribute($value) 
    {

        if (static::whereSlug($slug = Str::slug($value))->exists()) {

            $slug = $this->incrementSlug($slug);
        }

        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {

    $original = $slug;

    $count = 2;

    while (static::whereSlug($slug)->exists()) {

        $slug = "{$original}-" . $count++;
    }

    return $slug;

}

}
