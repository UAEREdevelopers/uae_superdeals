<?php

namespace App\Models\HotelRack;

use App\Models\HotelImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelInfo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function images()
    {
        return $this->hasMany(HotelImage::class,'hotel_infos_id');
    }
}
