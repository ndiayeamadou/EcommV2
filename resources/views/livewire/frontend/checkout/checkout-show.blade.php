<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6">Checkout</h1>
            
            @if (session()->has('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Checkout Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h2 class="text-lg font-medium mb-4">Shipping Information</h2>
                        
                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                                    <input type="text" id="first_name" wire:model="first_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                                    <input type="text" id="last_name" wire:model="last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                    <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                                    <input type="tel" id="phone" wire:model="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="address_line_1" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address Line 1</label>
                                    <input type="text" id="address_line_1" wire:model="address_line_1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('address_line_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="address_line_2" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address Line 2 (Optional)</label>
                                    <input type="text" id="address_line_2" wire:model="address_line_2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                                    <input type="text" id="city" wire:model="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300">State / Province</label>
                                    <input type="text" id="state" wire:model="state" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ZIP / Postal Code</label>
                                    <input type="text" id="postal_code" wire:model="postal_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                                    <select id="country" wire:model="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                        <option value="United States">United States</option>
                                        <option value="Canada">Canada</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <!-- Add more countries as needed -->
                                    </select>
                                    @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            
                            <div class="mt-8">
                                <h2 class="text-lg font-medium mb-4">Payment Method</h2>
                                
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="stripe" type="radio" wire:model="payment_method" value="stripe" class="h-4 w-4 text-primary-600 focus:ring-primary-500">
                                        <label for="stripe" class="ml-3 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Credit Card (Stripe)
                                        </label>
                                    </div>
                                    
                                    @if ($payment_method === 'stripe')
                                        <div class="mt-3 p-4 border border-gray-300 rounded-md">
                                            <!-- Stripe Elements Placeholder -->
                                            <div id="card-element" class="py-3"></div>
                                            <div id="card-errors" class="text-red-500 text-sm mt-2"></div>
                                        </div>
                                    @endif
                                </div>
                                
                                @error('payment_method') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
                                @error('stripe_payment_method') <span class="text-red-500 text-sm block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                        <h2 class="text-lg font-medium mb-4">Order Summary</h2>
                        
                        <div class="space-y-4">
                            @forelse($cart as $id => $item)
                                <div class="flex items-center space-x-3">
                                    <div class="h-16 w-16 flex-shrink-0 bg-gray-200 dark:bg-gray-700 rounded-md overflow-hidden">
                                        <img src="{{ asset('storage/' . ($item['image'] ?? 'products/placeholder.jpg')) }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                </div>
                            @empty
                                <p class="text-center text-gray-500 dark:text-gray-400">Your cart is empty</p>
                            @endforelse
                            
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <div class="flex justify-between">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Subtotal</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($subtotal, 2) }}</p>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Tax</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($tax, 2) }}</p>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Shipping</p>
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($shipping, 2) }}</p>
                                </div>
                                <div class="flex justify-between mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <p class="text-base font-medium text-gray-900 dark:text-gray-100">Total</p>
                                    <p class="text-base font-medium text-primary-600">${{ number_format($total, 2) }}</p>
                                </div>
                            </div>
                            
                            <button type="button" wire:click="checkout" class="w-full mt-6 bg-primary-600 hover:bg-primary-700 text-white py-3 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 font-medium">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            const stripe = Stripe('{{ config('cashier.key') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            
            cardElement.mount('#card-element');
            
            cardElement.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
            
            const form = document.querySelector('form');
            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                
                if (@this.payment_method === 'stripe') {
                    const { paymentMethod, error } = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                        billing_details: {
                            name: @this.first_name + ' ' + @this.last_name,
                            email: @this.email
                        }
                    });
                    
                    if (error) {
                        document.getElementById('card-errors').textContent = error.message;
                    } else {
                        @this.set('stripe_payment_method', paymentMethod.id);
                        @this.checkout();
                    }
                } else {
                    @this.checkout();
                }
            });
        });
    </script>
    @endpush
</div>
