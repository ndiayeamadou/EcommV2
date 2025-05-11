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

class ProductManagerAll extends Component
{
    use WithPagination, WithFileUploads;

    // Tabs
    public $activeTab = 'images';
    
    // Product details form
    public $product_id;
    public $name;
    public $slug;
    public $category_id;
    public $description;
    public $short_description;
    public $price;
    public $compare_at_price;
    public $quantity;
    public $sku;
    public $barcode;
    public $is_active = true;
    public $is_featured = false;
    public $is_digital = false;
    public $digital_url;
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
    
    // Modal control
    public $showEditModal = false;
    public $editMode = false;
    
    // Pagination
    public $perPage = 10;
    
    protected $rules = [
        'name' => 'required|min:3|max:255',
        'slug' => 'required|unique:products,slug',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable',
        'short_description' => 'nullable|max:255',
        'price' => 'required|numeric|min:0',
        'compare_at_price' => 'nullable|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'sku' => 'nullable|max:100',
        'barcode' => 'nullable|max:100',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_digital' => 'boolean',
        'digital_url' => 'nullable|url|max:255',
        'meta_title' => 'nullable|max:255',
        'meta_description' => 'nullable',
        'meta_keywords' => 'nullable|max:255',
        'uploadedImages.*' => 'image|max:2048', // 2MB max for each image
    ];
    
    public function mount()
    {
        $this->resetForm();
    }
    
    public function resetForm()
    {
        $this->product_id = null;
        $this->name = '';
        $this->slug = '';
        $this->category_id = '';
        $this->description = '';
        $this->short_description = '';
        $this->price = '';
        $this->compare_at_price = '';
        $this->quantity = 0;
        $this->sku = '';
        $this->barcode = '';
        $this->is_active = true;
        $this->is_featured = false;
        $this->is_digital = false;
        $this->digital_url = '';
        $this->meta_title = '';
        $this->meta_description = '';
        $this->meta_keywords = '';
        
        $this->images = [];
        $this->uploadedImages = [];
        $this->tempImages = [];
        
        $this->activeTab = 'details';
        $this->editMode = false;
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
    
    public function create()
    {
        $this->resetForm();
        $this->showEditModal = true;
        $this->editMode = false;
        //$this->dispatchBrowserEvent('open-modal'); // bug - correct° below
        $this->dispatch('open-modal');
    }
    
    public function edit(Product $product)
    {
        $this->resetForm();
        $this->showEditModal = true;
        $this->editMode = true;
        
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->category_id = $product->category_id;
        $this->description = $product->description;
        $this->short_description = $product->short_description;
        $this->price = $product->price;
        $this->compare_at_price = $product->compare_at_price;
        $this->quantity = $product->quantity;
        $this->sku = $product->sku;
        $this->barcode = $product->barcode;
        $this->is_active = $product->is_active;
        $this->is_featured = $product->is_featured;
        $this->is_digital = $product->is_digital;
        $this->digital_url = $product->digital_url;
        $this->meta_title = $product->meta_title;
        $this->meta_description = $product->meta_description;
        $this->meta_keywords = $product->meta_keywords;
        
        // Load existing images
        $this->images = $product->images()->orderBy('sort_order')->get();
        
        $this->dispatchBrowserEvent('open-modal');
    }
    
    public function save()
    {
        if ($this->editMode) {
            $this->rules['slug'] = 'required|unique:products,slug,' . $this->product_id;
        }
        
        $this->validate();
        
        try {
            if ($this->editMode) {
                $product = Product::find($this->product_id);
                $product->update([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'category_id' => $this->category_id,
                    'description' => $this->description,
                    'short_description' => $this->short_description,
                    'price' => $this->price,
                    'compare_at_price' => $this->compare_at_price,
                    'quantity' => $this->quantity,
                    'sku' => $this->sku,
                    'barcode' => $this->barcode,
                    'is_active' => $this->is_active,
                    'is_featured' => $this->is_featured,
                    'is_digital' => $this->is_digital,
                    'digital_url' => $this->digital_url,
                    'meta_title' => $this->meta_title,
                    'meta_description' => $this->meta_description,
                    'meta_keywords' => $this->meta_keywords,
                ]);
                
                $message = 'Product updated successfully.';
            } else {
                $product = Product::create([
                    'name' => $this->name,
                    'slug' => $this->slug,
                    'category_id' => $this->category_id,
                    'description' => $this->description,
                    'short_description' => $this->short_description,
                    'price' => $this->price,
                    'compare_at_price' => $this->compare_at_price,
                    'quantity' => $this->quantity,
                    'sku' => $this->sku,
                    'barcode' => $this->barcode,
                    'is_active' => $this->is_active,
                    'is_featured' => $this->is_featured,
                    'is_digital' => $this->is_digital,
                    'digital_url' => $this->digital_url,
                    'meta_title' => $this->meta_title,
                    'meta_description' => $this->meta_description,
                    'meta_keywords' => $this->meta_keywords,
                ]);
                
                $message = 'Product created successfully.';
            }
            
            // Process uploaded images
            if (count($this->uploadedImages)) {
                $imageService = new ProductImageService();
                
                foreach ($this->uploadedImages as $index => $image) {
                    $isPrimary = ($index === 0 && !$this->editMode) || false;
                    $imageService->uploadImage($product, $image, $isPrimary, $index);
                }
            }
            
            session()->flash('success', $message);
            $this->showEditModal = false;
            $this->resetForm();
            
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred: ' . $e->getMessage());
        }
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
        $query = Product::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('sku', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                return $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter !== '', function ($query) {
                return $query->where('is_active', $this->statusFilter == 'active');
            })
            ->orderBy($this->sortField, $this->sortDirection);
        
        $products = $query->paginate($this->perPage);
        
        $categories = Category::orderBy('name')->get();
        
        return view('livewire.admin.product.product-manager-all', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}

