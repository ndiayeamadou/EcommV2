<?php

namespace App\Livewire\Frontend\Product;

use Livewire\Attributes\Layout;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app-front')]
class ProductList extends Component
{
    use WithPagination;
    
    public $selectedCategories = [];
    public $priceRange = 1500;
    public $minPrice = 0;
    public $maxPrice = 1500;
    public $sortBy = 'featured';
    
    public function updatedSelectedCategories()
    {
        $this->resetPage();
    }
    
    public function updatedPriceRange()
    {
        $this->resetPage();
    }
    
    public function updatedSortBy()
    {
        $this->resetPage();
    }
    
    public function resetFilters()
    {
        $this->reset(['selectedCategories', 'priceRange', 'sortBy']);
        $this->priceRange = 1500;
    }
    
    public function addToCart($productId)
    {
        $product = Product::find($productId);
        
        if (!$product) {
            session()->flash('error', 'Product not found');
            return;
        }
        
        $cart = session()->get('cart', []);
        
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'quantity' => 1,
                'selling_price' => $product->selling_price,
                'image' => $product->productImages->image_path[0]
            ];
        }
        
        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
        
        session()->flash('success', 'Product added to cart successfully!');
    }
    
    public function render()
    {
        $productsQuery = Product::query();
        
        if (!empty($this->selectedCategories)) {
            $productsQuery->whereIn('category_id', $this->selectedCategories);
        }
        
        $productsQuery->where('selling_price', '<=', $this->priceRange);
        
        switch ($this->sortBy) {
            case 'price-low':
                $productsQuery->orderBy('selling_price', 'asc');
                break;
            case 'price-high':
                $productsQuery->orderBy('selling_price', 'desc');
                break;
            /* case 'rating':
                $productsQuery->orderBy('rating', 'desc');
                break; */
            default:
                //$productsQuery->orderBy('featured', 'desc');
                break;
        }
        
        //$products = $productsQuery->paginate(12);
        $products = Product::whereIsActive(true)->paginate(12);
        $categories = Category::all();
        
        return view('livewire.frontend.product.product-list', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}

