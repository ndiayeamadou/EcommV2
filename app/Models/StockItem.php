<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    protected $fillable = [
        'stock_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price'
    ];

    public function stock() {
        return $this->belongsTo(Stock::class);
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id', 'id');
    }

}
