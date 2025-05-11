<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;
use Livewire\Attributes\Title;

class ProductDetail extends Component
{
    public Product $product;
    public $quantity = 1;
    public $selectedImageIndex = 0;
    public $reviewTab = 'description'; // 'description', 'specifications', 'reviews'
    
    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->with(['category', 'images', 'reviews'])
            ->firstOrFail();
    }
    
    public function increaseQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        } else {
            $this->dispatch('notify', [
                'title' => 'Maximum stock reached',
                'message' => "Only {$this->product->stock} items available",
                'type' => 'warning'
            ]);
        }
    }
    
    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    
    public function addToCart(CartService $cartService)
    {
        $cartService->add($this->product, $this->quantity);
        
        $this->dispatch('notify', [
            'title' => 'Added to cart',
            'message' => "{$this->quantity} × {$this->product->name} added to your cart",
            'type' => 'success'
        ]);
        
        $this->dispatch('cartUpdated', count: $cartService->count());
    }
    
    public function addToWishlist()
    {
        // Implement wishlist logic or redirect to login if needed
        $this->dispatch('notify', [
            'title' => 'Added to wishlist',
            'message' => "Product has been added to your wishlist",
            'type' => 'success'
        ]);
    }
    
    public function shareToWhatsapp()
    {
        // Construct the WhatsApp share URL
        $text = "Check out this product: {$this->product->name} on our store!";
        $url = route('product.show', $this->product);
        $shareUrl = "https://wa.me/?text=" . urlencode("{$text} {$url}");
        
        // Use JavaScript to open a new window
        $this->js("window.open('$shareUrl', '_blank')");
    }
    
    public function selectTab($tab)
    {
        $this->reviewTab = $tab;
    }
    
    #[Title('Product - :name')]
    public function render()
    {
        $this->title = $this->product->name;
        
        $relatedProducts = Product::where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->take(4)
            ->get();
            
        return view('livewire.frontend.product.product-detail', [
            'relatedProducts' => $relatedProducts
        ]);
    }
}
