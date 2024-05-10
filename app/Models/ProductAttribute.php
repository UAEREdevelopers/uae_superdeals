<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public $timestamps = false;
    public $table = 'product_attribute';
    protected $guarded = [];
    
    
}
