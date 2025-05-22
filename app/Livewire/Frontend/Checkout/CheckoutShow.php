<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app-front')]
class CheckoutShow extends Component
{
    public $first_name, $last_name, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;
    public $address_line_1;
    public $carts;
    public $address_line_2;
    public $city;
    public $state;
    public $postal_code;
    //public $country = 'United States';
    public $country = 'Senegal';
    
    public $payment_method;
    public $card_holder;
    public $stripe_payment_method;
    
    public $cart = [];
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 0;
    public $totalPrice = 0;
    
    protected $rules = [
        'first_name' => 'required|string|min:2|max:121',
        'last_name' => 'required|string|min:2|max:121',
        'email' => 'required|email|max:121',
        'phone' => 'required',
        'address_line_1' => 'required|string|max:500',
        //'city' => 'required',
        //'state' => 'required',
        'postal_code' => 'nullable',
        //'country' => 'required',
        //'payment_method' => 'required',
    ];
    
    public function mount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->first_name = $user->customer->first_name ?? '';
            $this->last_name = $user->customer->last_name ?? '';
            $this->email = $user->email;
            $this->phone = $user->customer->phone ?? '';
            
            // If user has a default address, populate it
            /* if ($user->addresses->count() > 0) {
                $address = $user->addresses->first();
                $this->address_line_1 = $address->address_line_1;
                $this->address_line_2 = $address->address_line_2;
                $this->city = $address->city;
                $this->state = $address->state;
                $this->postal_code = $address->postal_code;
                $this->country = $address->country;
            } */
        }
        
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
    }

    
    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'wks-'.Str::random(10),
            //'fullname' => $this->fullname,
            'fullname' => $this->first_name .' '.$this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'pincode' => $this->postal_code,
            'address' => $this->address_line_1,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->carts as $cartItem)
        {
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_color_id' => $cartItem->product_color_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->selling_price
            ]);

            if($cartItem->product_color_id != NULL) {
                $cartItem->productColor()->where('id', $cartItem->product_color_id)->decrement('quantity', $cartItem->quantity);
            } else {
                $cartItem->product()->where('id', $cartItem->product_id)->decrement('quantity', $cartItem->quantity);
            }
        }
        /* return sth otherwise it throws an error - bcz this func is called on another */
        return $order;
    }

    public function cashOnDeliveryOrder()
    {
        $this->payment_mode = 'Cash on Delivery';
        $cOnDelivOrder = $this->placeOrder();
        if($cOnDelivOrder) {
            /* CLEAR THE CART - delete now d user cart records when order already placed */
            Cart::where('user_id',auth()->user()->id)->delete();

            session()->flash('message', 'Votre commande a bien été prise en compte.');
            $this->dispatch('notify', [
                'text' => 'La commande a bien été enregistrée.',
                'type' => 'success',
                'status' => 200
            ]);
            //return redirect()->to('remerciements');
            return redirect()->to('products');
        } else {
            $this->dispatch('notify', [
                'text' => 'Echec. Rééssayer.',
                'type' => 'error',
                'status' => 500
            ]);
        }
    }


    public function render()
    {
        return view('livewire.frontend.checkout.checkout-show');
    }
}

