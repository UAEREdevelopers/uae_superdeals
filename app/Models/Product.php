<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(category::class, 'category_id','id');
    }
    public function media_gallery()
    {
        return $this->hasMany(ProductMedia::class, 'product_id', 'id')->where('block_position','gallery');
    }
    public function media_content()
    {
        return $this->hasMany(ProductMedia::class, 'product_id', 'id')->where('block_position','content');
    }
    /* public function promotionPrice()
    {
        return $this->hasOne(ProductPromotion::class, 'product_id', 'id');
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    } */
}
