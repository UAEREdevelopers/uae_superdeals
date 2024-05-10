<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageInterest extends Model
{
    use HasFactory;
     use SoftDeletes;
    protected $guarded = ['id'];

    public function package()
    {
        return $this->belongsTo(HotelPackage::class, 'package_id');
    }
}
