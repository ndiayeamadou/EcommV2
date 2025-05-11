<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'category_id',
        'name',
        'reference',
        'slug',
        'brand',
        'barcode',
        'short_description',
        'description',
        'original_price',
        'selling_price',
        'promotional_price',
        'quantity',
        'is_active',
        'is_trending',
        'is_featured',
        //'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    /**
     * Boot the model.
     */
    /* protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = $product->slug ?? Str::slug($product->name);
        });
    } */

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }


    /**
     * Get the primary image for the product.
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
