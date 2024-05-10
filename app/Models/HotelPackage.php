<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelPackage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function interests()
    {
        return $this->hasMany(PackageInterest::class,'package_id', 'id');
    }

    public function images()
    {
         return $this->hasMany(PackageImage::class,'package_id', 'id');
    }

    public function category()
    {
         return $this->hasOne(Category::class,'id','category_id', );
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
