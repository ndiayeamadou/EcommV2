<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl md:text-3xl font-bold mb-6">Your Shopping Cart</h1>

    @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="hidden md:flex border-b pb-4 mb-4 text-sm font-medium text-gray-500">
                        <div class="w-2/5">Product</div>
                        <div class="w-1/5 text-center">Price</div>
                        <div class="w-1/5 text-center">Quantity</div>
                        <div class="w-1/5 text-right">Total</div>
                    </div>

                    @foreach($cartItems as $item)
                        <div 
                            wire:key="cart-item-{{ $item->id }}" 
                            class="py-4 border-b last:border-0 flex flex-col md:flex-row items-center gap-4"
                        >
                            <!-- Product Info -->
                            <div class="w-full md:w-2/5 flex items-center">
                                <div class="w-20 h-20 bg-gray-100 rounded overflow-hidden mr-4 shrink-0">
                                    <img
                                        src="{{ $item->image }}"
                                        alt="{{ $item->name }}"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div>
                                    <h3 class="font-medium">{{ $item->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->category }}</p>
                                    <button 
                                        wire:click="removeFromCart({{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="removeFromCart({{ $item->id }})"
                                        class="text-red-500 text-sm flex items-center mt-1 hover:text-red-700"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Remove
                                    </button>
                                </div>
                            </div>

                            <!-- Price - Mobile -->
                            <div class="w-full md:hidden flex justify-between items-center">
                                <span class="text-sm text-gray-500">Price:</span>
                                <span>${{ number_format($item->price, 2) }}</span>
                            </div>

                            <!-- Price - Desktop -->
                            <div class="hidden md:block w-1/5 text-center">
                                ${{ number_format($item->price, 2) }}
                            </div>

                            <!-- Quantity -->
                            <div class="w-full md:w-1/5 flex justify-between md:justify-center items-center">
                                <span class="md:hidden text-sm text-gray-500">Quantity:</span>
                                <div class="flex items-center border rounded-md">
                                    <button
                                        wire:click="decreaseQuantity({{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="decreaseQuantity, updateQuantity"
                                        class="px-2 py-1 text-gray-600 hover:bg-gray-100"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <span class="px-3 py-1 text-center w-10">{{ $item->quantity }}</span>
                                    <button
                                        wire:click="increaseQuantity({{ $item->id }})"
                                        wire:loading.attr="disabled"
                                        wire:target="increaseQuantity, updateQuantity"
                                        class="px-2 py-1 text-gray-600 hover:bg-gray-100"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Total - Mobile -->
                            <div class="w-full md:hidden flex justify-between items-center">
                                <span class="text-sm text-gray-500">Total:</span>
                                <span class="font-semibold">${{ number_format($item->price * $item->quantity, 2) }}</span>
                            </div>

                            <!-- Total - Desktop -->
                            <div class="hidden md:block w-1/5 text-right font-semibold">
                                ${{ number_format($item->price * $item->quantity, 2) }}
                            </div>
                        </div>
                    @endforeach

                    <div class="flex justify-between items-center mt-6">
                        <a 
                            href="{{ route('products') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Continue Shopping
                        </a>
                        <button 
                            wire:click="clearCart"
                            wire:loading.attr="disabled"
                            wire:target="clearCart"
                            class="text-red-500 border-red-500 hover:bg-red-50 inline-flex items-center px-4 py-2 border rounded-md text-sm font-medium"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Clear Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-24">
                    <h2 class="text-xl font-bold mb-4">Order Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>${{ number_format($cartTotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            @if($shipping > 0)
                                <span>${{ number_format($shipping, 2) }}</span>
                            @else
                                <span class="text-green-500">Free</span>
                            @endif
                        </div>
                        
                        @if($promoDiscount > 0)
                            <div class="flex justify-between text-gray-600">
                                <span>Discount</span>
                                <span class="text-green-500">-${{ number_format($promoDiscount, 2) }}</span>
                            </div>
                        @endif
                        
                        <div class="border-t pt-3 mt-3">
                            <div class="flex justify-between font-semibold text-lg">
                                <span>Total</span>
                                <span>${{ number_format($cartTotal + $shipping - $promoDiscount, 2) }}</span>
                            </div>
                            <p class="text-gray-500 text-sm mt-1">Including VAT</p>
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="mb-6">
                        <label for="promo" class="block text-sm font-medium text-gray-700 mb-1">Promo Code</label>
                        <div class="flex space-x-2">
                            <input 
                                wire:model.lazy="promoCode" 
                                type="text" 
                                id="promo" 
                                class="flex-grow px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                                placeholder="Enter promo code"
                            >
                            <button 
                                wire:click="applyPromoCode"
                                wire:loading.attr="disabled"
                                wire:target="applyPromoCode"
                                class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md hover:bg-gray-300 transition-colors"
                            >
                                <span wire:loading.remove wire:target="applyPromoCode">Apply</span>
                                <span wire:loading wire:target="applyPromoCode">
                                    <svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>

                    <button 
                        wire:click="checkout"
                        wire:loading.attr="disabled"
                        wire:target="checkout"
                        class="w-full bg-purple-600 text-white font-medium py-3 px-4 rounded-md text-center hover:bg-purple-700 transition-colors flex items-center justify-center"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        
                        <span wire:loading.remove wire:target="checkout">
                            Proceed to Checkout
                        </span>
                        
                        <span wire:loading wire:target="checkout">
                            Processing...
                        </span>
                    </button>

                    <div class="text-center text-sm text-gray-500 mt-4">
                        <p class="mb-2">We accept:</p>
                        <div class="flex justify-center space-x-2">
                            <img src="{{ asset('images/payment/visa.svg') }}" alt="Visa" class="h-6">
                            <img src="{{ asset('images/payment/mastercard.svg') }}" alt="Mastercard" class="h-6">
                            <img src="{{ asset('images/payment/paypal.svg') }}" alt="PayPal" class="h-6">
                            <img src="{{ asset('images/payment/apple-pay.svg') }}" alt="Apple Pay" class="h-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-xl font-semibold mb-2">@lang('messages.empty_cart')</h2>
            <p class="text-gray-600 mb-6">Looks like you haven't added anything to your cart yet.</p>
            <a href="{{ route('products') }}" class="bg-purple-600 text-white font-medium py-2 px-6 rounded-md hover:bg-purple-700 transition-colors">
                @lang('messages.start_shopping')
            </a>
        </div>
    @endif
</div>
