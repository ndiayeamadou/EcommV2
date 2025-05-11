<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /* protected $fillable = [
        'product_id',
        'image'
    ]; */

    protected $fillable = [
        'product_id',
        'image_path',
        'is_primary',
        'sort_order'
    ];
    
    /**
     * Get the product that owns the image.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
