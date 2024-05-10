<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TboHotelCode extends Model
{
    use HasFactory;
    use softDeletes;

    protected $guarded = ['id'];

    public function city()
    {
      return $this->hasOne(TboCity::class,'CityName','CityName');
    }
}
