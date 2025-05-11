<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductImageService
{
    protected ImageManager $manager;
    
    public function __construct()
    {
        // Create a new ImageManager instance with GD driver
        $this->manager = new ImageManager(new Driver());
    }
    
    /**
     * Upload and store a product image.
     *
     * @param Product $product
     * @param mixed $image
     * @param bool $isPrimary
     * @param int $sortOrder
     * @return ProductImage
     */
    public function uploadImage(Product $product, $image, bool $isPrimary = false, int $sortOrder = 0)
    {
        // Generate a unique filename
        $filename = Str::slug($product->name) . '-' . time() . '-' . Str::random(5) . '.' . $image->getClientOriginalExtension();
        
        // Create path
        $path = 'products/' . $product->id;
        
        // Create directory if it doesn't exist
        if (!Storage::exists('public/' . $path)) {
            Storage::makeDirectory('public/' . $path);
        }
        
        // Process the image with Intervention Image v3
        $img = $this->manager->read($image->getRealPath());
        
        // Resize if needed (optional)
        // $img = $img->resize(800, null, function ($constraint) {
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        
        // Save the image
        $encodedImage = $img->encode();
        //Storage::put('public/' . $path . '/' . $filename, $encodedImage);
        Storage::disk('public')->put($path . '/' . $filename, $encodedImage);

        // Mark as not primary if setting a new primary image
        if ($isPrimary) {
            //$product->images()->where('is_primary', true)->update(['is_primary' => false]);
            $product->productImages()->where('is_primary', true)->update(['is_primary' => false]);
        }
        
        // Create a new product image record
        //return $product->images()->create([
        return $product->productImages()->create([
            'image_path' => $path . '/' . $filename,
            'is_primary' => $isPrimary,
            'sort_order' => $sortOrder,
        ]);
    }
    
    /**
     * Delete a product image.
     *
     * @param ProductImage $image
     * @return bool
     */
    public function deleteImage(ProductImage $image)
    {
        // Delete the file from storage
        if (Storage::exists('public/' . $image->image_path)) {
            Storage::delete('public/' . $image->image_path);
        }
        
        // If this was the primary image, set another image as primary
        if ($image->is_primary) {
            //$nextImage = $image->product->images()->where('id', '!=', $image->id)->first();
            $nextImage = $image->product->productImages()->where('id', '!=', $image->id)->first();
            if ($nextImage) {
                $nextImage->update(['is_primary' => true]);
            }
        }
        
        // Delete the record
        return $image->delete();
    }
    
    /**
     * Set an image as the primary image.
     *
     * @param ProductImage $image
     * @return bool
     */
    public function setPrimaryImage(ProductImage $image)
    {
        // Mark all other images as not primary
        //$image->product->images()->where('id', '!=', $image->id)->update(['is_primary' => false]);
        $image->product->productImages()->where('id', '!=', $image->id)->update(['is_primary' => false]);
        
        // Set this image as primary
        return $image->update(['is_primary' => true]);
    }
    
    /**
     * Update the sort order of images.
     *
     * @param array $imageIds
     * @return bool
     */
    public function updateSortOrder(array $imageIds)
    {
        foreach ($imageIds as $index => $id) {
            ProductImage::where('id', $id)->update(['sort_order' => $index]);
        }
        
        return true;
    }
}
