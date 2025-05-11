<?php

namespace App\Livewire\Admin\Pos;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Posales extends Component
{
    use WithPagination;
    
    // List filters and sorting
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $categoryFilter = '';
    public $statusFilter = '';
    public $perPage = 10;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'categoryFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    /* l'autre code */
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
  /* l'autre code */
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }
    
    public function updatingStatusFilter() 
    {
        $this->resetPage();
    }
    
    public function updatingPerPage()
    {
        $this->resetPage();
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
                return $query->where('is_active', $this->statusFilter == true);
            })
            ->orderBy($this->sortField, $this->sortDirection);
        
        $products = $query->where('is_active', true)->paginate($this->perPage);
        
        $categories = Category::orderBy('name')->get();
        
        /* l'autre code */
        $this->cartCount = $this->checkCartCount(); /* for cart count */
        $this->cart  = Cart::where('user_id', auth()->user()->id)->get();
        /* if(!empty($this->search)) {
            $products = Product::where('name', 'LIKE', '%'.$this->search.'%')->orderBy('id', 'DESC')->paginate(5);
        } else {
            $products = Product::orderBy('id', 'DESC')->paginate(5);
        } */
        /* l'autre code */
        return view('livewire.admin.pos.posales', [
            'products' => $products,
            'categories' => $categories,
            /* l'autre code */
            'cart' => $this->cart,
            'cartCount' => $this->cartCount,
        ]);
    }

    
    public function addToCart(int $productId)
    {
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
                'status' => 401
            ]);
        }
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
                    $this->dispatch('message', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatch('message', [
                        'text' => 'Il ne reste que '.number_format($productColor->quantity).' article(s)',
                        'type' => 'warning',
                        'status' => ''
                    ]);
                }
            } else {
                if($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    $this->dispatch('message', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                } else {
                    $this->dispatch('message', [
                        'text' => 'Il ne reste que '.number_format($cartData->product->quantity).' article(s)',
                        'type' => 'warning',
                        'status' => ''
                    ]);
                }
            }
        } else {
            $this->dispatch('message', [
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
                    $this->dispatch('message', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
            } else {
                if($cartData->quantity > 1) {
                    $cartData->decrement('quantity');
                    $this->dispatch('message', [
                        'text' => 'Produit mis à jour',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }/*  else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'La quantité ne peut être inférieure à 1.',
                        'type' => 'error',
                        'status' => ''
                    ]);
                } */
            }
        } else {
            $this->dispatch('message', [
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
            //$this->emit('CartAddedUpdated'); // error emit
            $this->dispatch('message', [
                'text' => 'Ce produit est bien supprimé de votre panier',
                'type' => 'success',
                'status' => 200
            ]);
        } else {
            $this->dispatch('message', [
                'text' => 'Echec de la tentative de suppression. Veuillez rééssayer.',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }

}
