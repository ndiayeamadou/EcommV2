<?php

namespace App\Livewire\Inc;

use App\Helpers\FlashMessage;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Addtocart extends Component
{
    public $product;
    public $productId;
    //public function addToCart(int $productId)
    //public function addToCart($product, int $productId)

    public function mount() {
        //$this->productId = $id;
        //dd($this->productId);
        //$this->addToCart($this->productId);
    }

    public function addToCart(int $productId)
    {
        //$productId = $this->productId;
        //$this->product = $product;
        if(Auth::check()) {
            /* check if product £ */
            $this->product = Product::where('id', $productId)->where('is_active', '1')->first();
            if($this->product->where('id',$productId)->where('is_active','1')->exists()) {
                /* check product color qty and add to cart */
                if($this->product->productColors()->count() > 1) {
                    //dd('prod color');
                    if($this->productColorSelectedQty != NULL) {
                        /* check if d product already exists in cart */
                        if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->where('product_color_id',$this->productColorId)->exists()) {
                            $this->dispatch('notify', [
                                'text' => 'Ce produit figure déjà dans le panier.',
                                'type' => 'warning',
                                'status' => ''
                            ]);
                        } else {
                            $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                            if($productColor->quantity > 0) {
                                /* if prod qty is greater than qty asked */
                                if($productColor->quantity >= $this->qtyCount) {
                                    /* then add product to cart */
                                    Cart::create([
                                        /* 'user_id' => auth()->user()->id, */
                                        'user_id' => Auth::user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->qtyCount,
                                        //'back' => 0
                                    ]);
                                    /* refresh the cart counter using emit & listen it to cart-comps */
                                    $this->emit('CartAddedUpdated');
                                    $this->dispatch('notify', [
                                        'text' => 'Produit bien ajouté au panier',
                                        'type' => 'success',
                                        'status' => '200'
                                    ]);
                                } else {
                                    $this->dispatch('notify', [
                                        /* 'text' => 'La quantité demandée est supérieure à celle restante', */
                                        'text' => 'La quantité disponible est de '.$productColor->quantity,
                                        'type' => 'warning',
                                        'status' => ''
                                    ]);
                                }

                            } else {
                                $this->dispatch('notify', [
                                    'text' => 'Ce produit est en rupture de stock',
                                    'type' => 'warning',
                                    'status' => ''
                                ]);
                            }
                        }
                    } else {
                        $this->dispatch('notify', [
                            'text' => 'Veuillez sélectionner une couleur du produit.',
                            'type' => 'info',
                            'status' => ''
                        ]);
                    }
                } else { /* means product has no color.s */
                    /* check if d product already exist in cart */
                    if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()) {
                        $this->dispatch('notify', [
                            'title' => 'Attention',
                            'message' => 'Ce produit figure déjà dans le panier.',
                            'type' => 'success'
                        ]);
                    } else {
                        if($this->product->quantity > 0) {
                            /* if prod qty is greater than qty asked */
                            if($this->product->quantity >= $this->qtyCount) {
                                /* then add product to cart */
                                Cart::create([
                                    /* 'user_id' => auth()->user()->id, */
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->qtyCount,
                                    //'back' => 0
                                ]);
                                /* refresh the cart counter using emit & listen it to cart-comps */
                                //$this->emit('CartAddedUpdated');  // error emit
                                $this->dispatch('notify', [
                                    'title' => 'success',
                                    'message' => 'Produit bien ajouté au panier',
                                    'type' => 'info'
                                ]);
                            } else {
                                $this->dispatch('notify', [
                                    /* 'text' => 'La quantité demandée est supérieure à celle restante', */
                                    'text' => 'La quantité disponible est de '.$this->product->quantity,
                                    'type' => 'warning',
                                    'status' => ''
                                ]);
                            }

                        } else {
                            $this->dispatch('notify', [
                                'message' => 'Ce produit est en rupture de stock',
                                'type' => 'warning',
                                'title' => 'Rupture de stock'
                            ]);
                        }
                    }
                }
            } else {    /* if product doesn't £ */
                $this->dispatch('notify', [
                    'text' => 'Ce produit n\'existe pas.',
                    'type' => 'error',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatch('notify', [
                'text' => 'Connectez-vous pour pouvoir ajouter au panier',
                'type' => 'error',
                'position' => ''
            ]);
        }
    }

    public function render()
    {
        return view('livewire.inc.addtocart');
    }
}
