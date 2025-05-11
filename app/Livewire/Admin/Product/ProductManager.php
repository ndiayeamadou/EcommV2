<?php

namespace App\Livewire\Admin\Product;


use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Services\ProductImageService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithPagination, WithFileUploads;

    // Tabs
    public $activeTab = 'details';
    
    // Product details form
    public $product_id;
    public $name;
    public $slug;
    public $brand;
    public $reference;
    public $category_id;
    public $description;
    public $short_description;
    public $selling_price;
    //public $compare_at_price;
    public $quantity;
    //public $sku;
    public $barcode;
    public $is_active = true;
    public $is_featured = false;
    public $is_digital = false;
    //public $digital_url;
    
    // Product SEO
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    
    // Product images
    public $images = [];
    public $uploadedImages = [];
    public $tempImages = [];
    
    // List filters and sorting
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $categoryFilter = '';
    public $statusFilter = '';
    
    // Edit mode
    public $editMode = false;
    
    // Pagination
    public $perPage = 10;
    
    protected $rules = [
        'name' => 'required|min:3|max:255',
        'slug' => 'required|unique:products,slug',
        'reference' => 'nullable|min:2|max:255',
        'brand' => 'nullable|min:2|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable',
        'short_description' => 'nullable|max:255',
        'selling_price' => 'required|numeric|min:0',
        //'compare_at_price' => 'nullable|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        //'sku' => 'nullable|max:100',
        'barcode' => 'nullable|max:100',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_digital' => 'boolean',
        //'digital_url' => 'nullable|url|max:255',
        'meta_title' => 'nullable|max:255',
        'meta_description' => 'nullable',
        'meta_keywords' => 'nullable|max:255',
        'uploadedImages.*' => 'image|max:2048', // 2MB max for each image
    ];
    
    public function mount($productId = null)
    {
        if ($productId) {
            $this->loadProduct($productId);
            $this->editMode = true;
        } else {
            $this->resetForm();
            $this->editMode = false;
        }
    }
    
    public function loadProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->reference = $product->reference;
        $this->brand = $product->brand;
        $this->category_id = $product->category_id;
        $this->description = $product->description;
        $this->short_description = $product->short_description;
        $this->selling_price = $product->selling_price;
        //$this->compare_at_price = $product->compare_at_price;
        //$this->quantity = $product->quantity;
        $this->quantity = number_format($product->quantity);
        //$this->sku = $product->sku;
        $this->barcode = $product->barcode;
        $this->is_active = $product->is_active;
        $this->is_featured = $product->is_featured;
        $this->is_digital = $product->is_digital;
        //$this->digital_url = $product->digital_url;
        $this->meta_title = $product->meta_title;
        $this->meta_description = $product->meta_description;
        $this->meta_keywords = $product->meta_keywords;
        
        // Load existing images
        //$this->images = $product->images()->orderBy('sort_order')->get();
        $this->images = $product->productImages()->orderBy('sort_order')->get();
    }
    
    public function resetForm()
    {
        $this->product_id = null;
        $this->name = '';
        $this->slug = '';
        $this->reference = '';
        $this->brand = '';
        $this->category_id = '';
        $this->description = '';
        $this->short_description = '';
        $this->selling_price = '';
        //$this->compare_at_price = '';
        $this->quantity = 0;
        //$this->sku = '';
        $this->barcode = '';
        $this->is_active = true;
        $this->is_featured = false;
        $this->is_digital = false;
        //$this->digital_url = '';
        $this->meta_title = '';
        $this->meta_description = '';
        $this->meta_keywords = '';
        
        $this->images = [];
        $this->uploadedImages = [];
        $this->tempImages = [];
        
        $this->activeTab = 'details';
    }
    
    public function updatedName()
    {
        if (!$this->editMode || empty($this->slug)) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function createNew()
    {
        $this->resetForm();
        $this->editMode = false;
        return redirect()->route('admin.products.create');
    }
    
    public function save()
    {
        if ($this->editMode) {
            $this->rules['slug'] = 'required|unique:products,slug,' . $this->product_id;
        }
        
        //$this->validate();
        
        try {
            if ($this->editMode) {
                $product = Product::find($this->product_id);
                $product->update([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'reference' => $this->reference,
                    'brand' => $this->brand,
                    'category_id' => $this->category_id,
                    'description' => $this->description,
                    'short_description' => $this->short_description,
                    'selling_price' => $this->selling_price,
                    //'compare_at_price' => $this->compare_at_price,
                    'quantity' => $this->quantity,
                    //'sku' => $this->sku,
                    'barcode' => $this->barcode,
                    'is_active' => $this->is_active,
                    'is_featured' => $this->is_featured,
                    //'is_digital' => $this->is_digital,
                    //'digital_url' => $this->digital_url,
                    'meta_title' => $this->meta_title,
                    'meta_description' => $this->meta_description,
                    'meta_keywords' => $this->meta_keywords,
                ]);
                
                $message = 'Product updated successfully.';
            } else {
                $product = Product::create([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'reference' => $this->reference,
                    'brand' => $this->brand,
                    'category_id' => $this->category_id,
                    'description' => $this->description,
                    'short_description' => $this->short_description,
                    'selling_price' => $this->selling_price,
                    //'compare_at_price' => $this->compare_at_price,
                    'quantity' => $this->quantity,
                    //'sku' => $this->sku,
                    'barcode' => $this->barcode,
                    'is_active' => $this->is_active,
                    'is_featured' => $this->is_featured,
                    'is_digital' => $this->is_digital,
                    //'digital_url' => $this->digital_url,
                    'meta_title' => $this->meta_title,
                    'meta_description' => $this->meta_description,
                    'meta_keywords' => $this->meta_keywords,
                ]);
                
                $message = 'Product created successfully.';
                $this->product_id = $product->id;
                $this->editMode = true;
            }
            
            // Process uploaded images
            if (count($this->uploadedImages)) {
                $imageService = new ProductImageService();
                
                foreach ($this->uploadedImages as $index => $image) {
                    $isPrimary = ($index === 0 && !$this->editMode) || false;
                    $imageService->uploadImage($product, $image, $isPrimary, $index);
                }
                
                // Refresh images
                //$this->images = $product->images()->orderBy('sort_order')->get();
                $this->images = $product->productImages()->orderBy('sort_order')->get();
                $this->uploadedImages = [];
                $this->tempImages = [];
            }
            
            session()->flash('success', $message);
            
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
        
        return redirect()->route('admin.products.edit', $this->product_id);
    }
    
    public function deleteImage($imageId)
    {
        $image = ProductImage::find($imageId);
        if ($image) {
            $imageService = new ProductImageService();
            $imageService->deleteImage($image);
            $this->images = $this->images->filter(function($img) use ($imageId) {
                return $img->id != $imageId;
            });
        }
    }
    
    public function setPrimaryImage($imageId)
    {
        $image = ProductImage::find($imageId);
        if ($image) {
            $imageService = new ProductImageService();
            $imageService->setPrimaryImage($image);
            // Refresh images
            $this->images = ProductImage::where('product_id', $image->product_id)
                ->orderBy('sort_order')
                ->get();
        }
    }
    
    public function updatedUploadedImages()
    {
        $this->validate([
            'uploadedImages.*' => 'image|max:2048',
        ]);
        
        $this->tempImages = [];
        
        foreach ($this->uploadedImages as $image) {
            $this->tempImages[] = [
                'tempUrl' => $image->temporaryUrl()
            ];
        }
    }
    
    public function removeUploadedImage($index)
    {
        // Remove from the temporary images array
        array_splice($this->tempImages, $index, 1);
        
        // Remove from the uploaded images array
        $files = $this->uploadedImages;
        array_splice($files, $index, 1);
        $this->uploadedImages = $files;
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function render()
    {
        $categories = Category::orderBy('name')->get();
        
        return view('livewire.admin.product.product-manager', [
            'categories' => $categories
        ]);
    }
}

