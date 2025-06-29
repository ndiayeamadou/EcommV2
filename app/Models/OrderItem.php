<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }

}
