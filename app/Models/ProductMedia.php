<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    /*
    Get thumb
     */
    public function getThumb()
    {
        return 1;//sc_image_get_path_thumb($this->image);
    }

    /*
    Get image
     */
    public function getImage()
    {
        return 1;//sc_image_get_path($this->image);
    }
}
