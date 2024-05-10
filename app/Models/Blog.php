<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

       protected $guarded = ['id'];

       public function scopeOneBlog($query,$slug){
        $query->select(['id','slug','title','description','banner_image','thumbnail_image'])->where('slug',$slug);
       }
}
