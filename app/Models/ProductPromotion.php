<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductPromotion extends Model
{
    public $table = 'product_promotion';
    

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
