<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];

    public function scopePaymentStatusfromOrderId($query,$orderID){
        $query->select(['id','unique_id','encrypted_string','status','response_data'])->where('unique_id',$orderID);
    }
}
