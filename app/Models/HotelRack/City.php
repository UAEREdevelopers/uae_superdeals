<?php

namespace App\Models\HotelRack;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;
     use SoftDeletes;
    protected $guarded = ['id'];
}
