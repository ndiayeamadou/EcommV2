<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Checkout extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address_line_1;
    public $address_line_2;
    public $city;
    public $state;
    public $postal_code;
    public $country = 'United States';
    
    public $payment_method;
    public $card_holder;
    public $stripe_payment_method;
    
    public $cart = [];
    public $subtotal = 0;
    public $tax = 0;
    public $shipping = 0;
    public $total = 0;
    
    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required',
        'address_line_1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'postal_code' => 'required',
        'country' => 'required',
        'payment_method' => 'required',
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
            if ($user->addresses->count() > 0) {
                $address = $user->addresses->first();
                $this->address_line_1 = $address->address_line_1;
                $this->address_line_2 = $address->address_line_2;
                $this->city = $address->city;
                $this->state = $address->state;
                $this->postal_code = $address->postal_code;
                $this->country = $address->country;
            }
        }
        
        $this->cart = session()->get('cart', []);
        $this->calculateTotals();
    }
    
    public function calculateTotals()
    {
        $this->subtotal = 0;
        
        foreach ($this->cart as $item) {
            $this->subtotal += $item['price'] * $item['quantity'];
        }
        
        // Calculate tax (example: 8%)
        $this->tax = $this->subtotal * 0.08;
        
        // Calculate shipping (example: fixed rate of $5)
        $this->shipping = 5.00;
        
        $this->total = $this->subtotal + $this->tax + $this->shipping;
    }
    
    public function setPaymentMethod($value)
    {
        $this->payment_method = $value;
    }
    
    public function checkout()
    {
        $this->validate();
        
        // Process payment based on payment method
        if ($this->payment_method === 'stripe') {
            $this->validateOnly('stripe_payment_method', ['stripe_payment_method' => 'required']);
        }
        
        try {
            // Create order
            $order = new Order();
            $order->order_number = 'ORD-' . strtoupper(Str::random(10));
            $order->user_id = Auth::id();
            $order->subtotal = $this->subtotal;
            $order->tax = $this->tax;
            $order->shipping = $this->shipping;
            $order->total = $this->total;
            $order->first_name = $this->first_name;
            $order->last_name = $this->last_name;
            $order->email = $this->email;
            $order->phone = $this->phone;
            $order->address_line_1 = $this->address_line_1;
            $order->address_line_2 = $this->address_line_2;
            $order->city = $this->city;
            $order->state = $this->state;
            $order->postal_code = $this->postal_code;
            $order->country = $this->country;
            $order->payment_method = $this->payment_method;
            $order->payment_status = 'pending';
            $order->order_status = 'pending';
            $order->save();
            
            // Create order items
            foreach ($this->cart as $item_id => $item) {
                $product = Product::findOrFail($item_id);
                
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $product->id;
                $orderItem->product_name = $product->name;
                $orderItem->quantity = $item['quantity'];
                $orderItem->unit_price = $item['price'];
                $orderItem->total = $item['price'] * $item['quantity'];
                $orderItem->save();
                
                // Decrease product quantity
                $product->quantity -= $item['quantity'];
                $product->save();
            }
            
            // Process payment
            if ($this->payment_method === 'stripe') {
                $user = Auth::user();
                
                // Check if user has a Stripe customer ID, if not create one
                if (!$user->stripe_id) {
                    $user->createAsStripeCustomer();
                }
                
                // Process the payment with Stripe
                $payment = $user->charge(
                    $this->total * 100, // Amount in cents
                    $this->stripe_payment_method,
                    [
                        'description' => "Order {$order->order_number}",
                    ]
                );
                
                // Update order with payment info
                $order->payment_status = 'paid';
                $order->save();
            }
            
            // Clear cart
            session()->forget('cart');
            
            // Redirect to confirmation page
            return redirect()->route('order.confirmation', $order->order_number);
            
        } catch (\Exception $e) {
            session()->flash('error', 'Payment failed: ' . $e->getMessage());
        }
    }
    
    public function render()
    {
        return view('livewire.frontend.checkout.checkout-show');
    }
}

