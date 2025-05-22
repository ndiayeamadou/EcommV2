<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Shopping Cart')]
#[Layout('components.layouts.app-front')]
class CartShow extends Component
{
   public $cart, $totalPrice = 0;
   public $product, $category, $productColorSelectedQty, $productColorId, $qtyCount = 1, $colorName;
   /* for cart */
   public $cartCount;
   protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];
   //public $search;

   public function checkCartCount()
   {
       if(Auth::check()) {
           return $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
       } else {
           return $this->cartCount = 0;
       }
   }
   
    public function mount()
    {
        $this->refreshCart();
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
    
    //public function increaseQty($id)
    public function incrementQty($id)
    {
        $cartData = Cart::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if($cartData) {
            /* si le produit a une couleur */
            if($cartData->productColor()->where('id',$cartData->product_color_id)->exists())
            {
                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();

                if($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatch('notify', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatch('notify', [
                        'text' => 'Il ne reste que '.number_format($productColor->quantity).' article(s)',
                        'type' => 'warning',
                        'status' => ''
                    ]);
                }
            } else {
                if($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatch('notify', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatch('notify', [
                        'text' => 'Il ne reste que '.number_format($cartData->product->quantity).' article(s)',
                        'type' => 'warning',
                        'status' => ''
                    ]);
                }
            }
        } else {
            $this->dispatch('notify', [
                'text' => 'Echec de la mise à jour. Veuillez rééssayer.',
                'type' => 'error',
                'status' => '404'
            ]);
        }
    }
    //public function decreaseQty($id)
    public function decrementQty($id)
    {
        $cartData = Cart::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if($cartData) {
            /* si le produit a une couleur */
            if($cartData->productColor()->where('id',$cartData->product_color_id)->exists())
            {
                $productColor = $cartData->productColor()->where('id',$cartData->product_color_id)->first();

                if($productColor->quantity > 1) {
                    $cartData->decrement('quantity');
                    $this->dispatch('notify', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if($cartData->quantity > 1) {
                    $cartData->decrement('quantity');
                    $this->dispatch('notify', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }/*  else {
                    $this->dispatchBrowserEvent('notify', [
                        'text' => 'La quantité ne peut être inférieure à 1.',
                        'type' => 'error',
                        'status' => ''
                    ]);
                } */
            }
        } else {
            $this->dispatch('notify', [
                'text' => 'Echec de la mise à jour. Veuillez rééssayer.',
                'type' => 'error',
                'status' => '404'
            ]);
        }
    }

    public function removeFromCart($cartId)
    {
        //dd($cartId);
        $cart = Cart::where('id',$cartId)->where('user_id', auth()->user()->id)->first();
        if($cart) {
            $cart->delete();
            /* refresh the cart counter & create it to CartCount comp */
            $this->dispatch('CartAddedUpdated');
            $this->dispatch('notify', [
                'text' => 'Ce produit est bien supprimé de votre panier',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            $this->dispatch('notify', [
                'text' => 'Echec de la tentative de suppression. Veuillez rééssayer.',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

    
    public function render()
    {
        $this->cartCount = $this->checkCartCount(); /* for cart count */
        $this->cart  = Cart::where('user_id', auth()->user()->id)->get();

        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart,
            'cartCount' => $this->cartCount,
        ]);
    }
}

