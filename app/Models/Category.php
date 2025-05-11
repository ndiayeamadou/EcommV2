<?php

namespace App\Models;

//use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory/* , Sluggable */;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        /*  */
        'parent_id'
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class);
        //return $this->hasMany(Product::class, 'category_id', 'id');
    }
    
    public function relatedProducts()
    {
        return $this->hasMany(Product::class, 'category_id', 'id')->latest()->take(16);
    }
    public function brands()
    {
        //return $this->hasMany(Brand::class, 'category_id', 'id');
        return $this->hasMany(Brand::class, 'category_id', 'id')->where('status', '0');
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

    /* test new */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
