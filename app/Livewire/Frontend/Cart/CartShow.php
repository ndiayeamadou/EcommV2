<?php

namespace App\Livewire\Frontend\Cart;

use App\Services\CartService;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Shopping Cart')]
#[Layout('components.layouts.app-front')]
class CartShow extends Component
{
    public $cartItems = [];
    public $cartTotal = 0;
    public $shipping = 0;
    public $promoCode = '';
    public $promoDiscount = 0;
    
    protected $cartService;
    
    /* public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    } */
    
    public function mount()
    {
        $this->refreshCart();
    }
    
    public function removeFromCart($productId)
    {
        $this->cartService->remove($productId);
        $this->refreshCart();
        
        $this->dispatch('notify', [
            'title' => 'Item removed',
            'message' => 'Product removed from your cart',
            'type' => 'info'
        ]);
        
        $this->dispatch('cartUpdated', count: $this->cartService->count());
    }
    
    public function updateQuantity($productId, $quantity)
    {
        if ($quantity <= 0) {
            $this->removeFromCart($productId);
            return;
        }
        
        // Get product to check stock
        $product = $this->cartItems->firstWhere('id', $productId);
        
        if ($product && $quantity > $product->stock) {
            $this->dispatch('notify', [
                'title' => 'Stock limit reached',
                'message' => "Only {$product->stock} items available",
                'type' => 'warning'
            ]);
            
            $quantity = $product->stock;
        }
        
        $this->cartService->updateQuantity($productId, $quantity);
        $this->refreshCart();
        $this->dispatch('cartUpdated', count: $this->cartService->count());
    }
    
    public function increaseQuantity($productId)
    {
        $item = $this->cartItems->firstWhere('id', $productId);
        if ($item) {
            $this->updateQuantity($productId, $item->quantity + 1);
        }
    }
    
    public function decreaseQuantity($productId)
    {
        $item = $this->cartItems->firstWhere('id', $productId);
        if ($item && $item->quantity > 1) {
            $this->updateQuantity($productId, $item->quantity - 1);
        }
    }
    
    public function clearCart()
    {
        $this->cartService->clear();
        $this->refreshCart();
        
        $this->dispatch('notify', [
            'title' => 'Cart cleared',
            'message' => 'All items have been removed from your cart',
            'type' => 'info'
        ]);
        
        $this->dispatch('cartUpdated', count: 0);
    }
    
    public function applyPromoCode()
    {
        // Example promo code implementation
        if (strtoupper($this->promoCode) === 'WELCOME10') {
            $this->promoDiscount = $this->cartTotal * 0.1;
            
            $this->dispatch('notify', [
                'title' => 'Promo code applied',
                'message' => '10% discount has been applied to your order',
                'type' => 'success'
            ]);
        } else {
            $this->promoDiscount = 0;
            
            $this->dispatch('notify', [
                'title' => 'Invalid promo code',
                'message' => 'The promo code you entered is invalid or expired',
                'type' => 'error'
            ]);
        }
    }
    
    protected function refreshCart()
    {
        //$this->cartItems = $this->cartService->content();
        //$this->cartTotal = $this->cartService->total();
        
        // Calculate shipping (free over $50)
        //$this->shipping = $this->cartTotal >= 50 ? 0 : 5.99;
    }
    
    public function checkout()
    {
        return redirect()->route('checkout');
    }
    
    public function render()
    {
        return view('livewire.frontend.cart.cart-show');
    }
}

