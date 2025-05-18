<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumbs -->
    <div class="flex items-center text-sm text-gray-500 mb-8">
        <a href="{{ route('home') }}" class="hover:text-purple-600 transition-colors">{{ __('messages.home') }}</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products') }}" class="hover:text-purple-600 transition-colors">@lang('messages.products')</a>
        <span class="mx-2">/</span>
        <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-purple-600 transition-colors">
            {{ $product->category->name }}
        </a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">{{ $product->name }}</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Product Images -->
        {{-- @dump(count($product->productImages)) --}}
        {{-- <img
            src="{{ asset('storage/' . $product->productImages[0]->image_path) }}"
            alt="{{ $product->name }}}"
            class="w-full h-96 object-contain"
        /> --}}

        <div 
            x-data="{ 
                activeSlide: @entangle('selectedImageIndex'),
                totalImages: {{ count($product->productImages) }} 
            }"
            class="animate-fade-in"
        >
            <!-- Main Image -->
            <div class="mb-4 relative overflow-hidden rounded-lg bg-gray-100">
                @if(count($product->productImages) > 0)
                    @foreach($product->productImages as $index => $image)
                    {{-- @dump($image->image_path) --}}
                        <div
                            x-show="activeSlide === {{ $index }}"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                        >
                            {{-- <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                class="w-full h-96 object-contain"
                            /> --}}
                            <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                class="w-full h-96 object-contain"
                            />
                        </div>
                    @endforeach
                @else
                    {{-- <img
                        src="{{ asset('images/placeholder.jpg') }}"
                        alt="{{ $product->name }}"
                        class="w-full h-96 object-cover"
                    /> --}}
                    <div class="flex-shrink-0 h-96 w-96 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <span class="text-gray-500 dark:text-gray-400">{{ substr($product->name, 0, 1) }}</span>
                    </div>
                @endif
                
                <!-- Image Navigation Arrows (for multiple images) -->
                @if(count($product->productImages) > 1)
                    <button 
                        @click="activeSlide = (activeSlide - 1 + totalImages) % totalImages" 
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 p-2 rounded-full shadow-md hover:bg-purple-600 hover:text-white transition-colors z-10"
                        aria-label="Previous image"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                    <button 
                        @click="activeSlide = (activeSlide + 1) % totalImages" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 text-gray-800 p-2 rounded-full shadow-md hover:bg-purple-600 hover:text-white transition-colors z-10"
                        aria-label="Next image"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                @endif
            </div>
            
            <!-- Thumbnail Images -->
            @if(count($product->productImages) > 1)
                <div class="grid grid-cols-5 gap-2">
                    @foreach($product->productImages as $index => $image)
                        <button 
                            wire:click="$set('selectedImageIndex', {{ $index }})"
                            class="rounded-md overflow-hidden bg-gray-100 cursor-pointer border-2 transition-all"
                            :class="{'border-purple-600': activeSlide === {{ $index }}, 'border-transparent': activeSlide !== {{ $index }}}"
                        >
                            <img
                                src="{{ asset('storage/' . $image->image_path) }}"
                                alt="{{ $product->name }} - Thumbnail {{ $index + 1 }}"
                                class="w-full h-20 object-cover"
                            />
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="animate-slide-in-right" style="--delay: 0.2s">
            <div class="mb-2">
                <span class="text-sm text-gray-500 uppercase tracking-wider">
                    {{ $product->category->name }}
                </span>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
            
            <!-- Rating -->
            <div class="flex items-center mb-4">
                <div class="flex">
                    @for($i = 1; $i <= 5; $i++)
                        <svg 
                            class="h-5 w-5 {{ $i <= floor($product->average_rating) ? 'text-amber-400' : 'text-gray-300' }}"
                            fill="currentColor" 
                            viewBox="0 0 20 20"
                        >
                            <path d="M10 15.585l-7.077 3.817 1.352-8.044L.027 7.121l8.026-1.186L10 0l1.947 5.935 8.026 1.186-4.247 4.238 1.35 8.044z" />
                        </svg>
                    @endfor
                </div>
                <span class="ml-1 text-sm text-gray-500">({{ $product->reviews_count ?? 0 }} Reviews)</span>
                <span class="mx-2 text-gray-300">|</span>
                <span class="text-sm text-gray-500">
                    @if($product->quantity > 10)
                        <span class="text-green-600">{{ __('messages.in_stock') }}</span>
                    @elseif($product->quantity > 0)
                        <span class="text-amber-600">Low Stock: {{ $product->quantity }} left</span>
                    @else
                        <span class="text-red-600">{{ __('messages.out_of_stock') }}</span>
                    @endif
                </span>
            </div>

            <!-- Price Section -->
            @if($product->compare_at_price && $product->compare_at_price > $product->selling_price)
                <div class="mb-4 flex items-center">
                    <span class="text-2xl font-bold text-gray-900">${{ number_format($product->selling_price, 2) }}</span>
                    <span class="ml-2 text-lg text-gray-500 line-through">${{ number_format($product->compare_at_price, 2) }}</span>
                    <span class="ml-2 bg-red-100 text-red-700 px-2 py-1 rounded-md text-xs font-medium">
                        {{ round((1 - $product->selling_price / $product->compare_at_price) * 100) }}% OFF
                    </span>
                </div>
            @else
                <p class="text-2xl font-bold text-gray-900 mb-4">${{ number_format($product->selling_price, 2) }}</p>
            @endif
            
            <p class="text-gray-600 mb-6">{{ $product->short_description }}</p>

            <!-- Quantity Selector -->
            <div class="mb-6">
                <h3 class="font-medium text-gray-900 mb-2">Quantity</h3>
                <div class="flex items-center">
                    <button
                        wire:click="decreaseQuantity"
                        class="border border-gray-300 rounded-l-md p-2 focus:outline-none hover:bg-gray-100"
                        {{ $quantity <= 1 ? 'disabled' : '' }}
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </button>
                    <input
                        type="number"
                        wire:model.live="quantity"
                        min="1" 
                        max="{{ $product->quantity }}"
                        class="w-16 border-t border-b border-gray-300 p-2 text-center focus:outline-none focus:ring-2 focus:ring-purple-500"
                    />
                    <button
                        wire:click="increaseQuantity"
                        class="border border-gray-300 rounded-r-md p-2 focus:outline-none hover:bg-gray-100"
                        {{ $quantity >= $product->quantity ? 'disabled' : '' }}
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <button 
                    wire:click="addToCart"
                    wire:loading.attr="disabled"
                    wire:target="addToCart"
                    class="bg-purple-600 hover:bg-purple-700 text-white flex-1 flex items-center justify-center py-3 px-6 rounded-md font-medium transition-colors"
                    {{ $product->quantity <= 0 ? 'disabled' : '' }}
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
                    <span wire:loading wire:target="addToCart">Adding...</span>
                </button>
                
                <button 
                    wire:click="addToWishlist"
                    wire:loading.attr="disabled"
                    wire:target="addToWishlist"
                    class="border border-purple-600 text-purple-600 hover:bg-purple-50 flex items-center justify-center py-3 px-6 rounded-md font-medium transition-colors"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span wire:loading.remove wire:target="addToWishlist">Save to Wishlist</span>
                    <span wire:loading wire:target="addToWishlist">Saving...</span>
                </button>
                
                <button 
                    wire:click="shareToWhatsapp"
                    class="border border-purple-600 text-purple-600 hover:bg-purple-50 flex items-center justify-center py-3 px-6 rounded-md font-medium transition-colors md:flex-initial"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    Share
                </button>
            </div>

            <!-- Shipping & Delivery -->
            <div class="border-t border-b border-gray-200 py-4 mb-6">
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="font-medium">Free delivery</span>
                    <span class="ml-1 text-gray-500">for orders over $50</span>
                </div>
                <div class="flex items-center mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    <span class="font-medium">Secure payments</span>
                    <span class="ml-1 text-gray-500">via credit cards, PayPal</span>
                </div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                    </svg>
                    <span class="font-medium">Easy returns</span>
                    <span class="ml-1 text-gray-500">within 30 days</span>
                </div>
            </div>

            <!-- Product Meta Info -->
            <div class="text-sm text-gray-500 space-y-1">
                <div class="flex">
                    <span class="w-24">SKU:</span>
                    <span>{{ $product->sku }}</span>
                </div>
                
                @if($product->barcode)
                <div class="flex">
                    <span class="w-24">Barcode:</span>
                    <span>{{ $product->barcode }}</span>
                </div>
                @endif
                
                <div class="flex">
                    <span class="w-24">Category:</span>
                    <a href="{{ route('category.show', $product->category->slug) }}" class="text-purple-600 hover:underline">
                        {{ $product->category->name }}
                    </a>
                </div>
                
                @if($product->tags && count($product->tags) > 0)
                <div class="flex">
                    <span class="w-24">Tags:</span>
                    <div class="flex flex-wrap gap-1">
                        @foreach($product->tags as $tag)
                            <a href="{{ route('products', ['tag' => $tag->slug]) }}" class="text-purple-600 hover:underline">
                                #{{ $tag->name }}{{ !$loop->last ? ',' : '' }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="mt-16">
        <div class="border-b border-gray-200 mb-6">
            <div class="flex flex-wrap -mb-px">
                <button 
                    wire:click="selectTab('description')" 
                    class="py-4 px-6 font-medium transition-colors whitespace-nowrap"
                    :class="{'border-b-2 border-purple-600 text-purple-600': '{{ $reviewTab }}' === 'description', 'text-gray-500 hover:text-purple-600': '{{ $reviewTab }}' !== 'description'}"
                >
                    Description
                </button>
                <button 
                    wire:click="selectTab('specifications')" 
                    class="py-4 px-6 font-medium transition-colors whitespace-nowrap"
                    :class="{'border-b-2 border-purple-600 text-purple-600': '{{ $reviewTab }}' === 'specifications', 'text-gray-500 hover:text-purple-600': '{{ $reviewTab }}' !== 'specifications'}"
                >
                    Specifications
                </button>
                <button 
                    wire:click="selectTab('reviews')" 
                    class="py-4 px-6 font-medium transition-colors whitespace-nowrap"
                    :class="{'border-b-2 border-purple-600 text-purple-600': '{{ $reviewTab }}' === 'reviews', 'text-gray-500 hover:text-purple-600': '{{ $reviewTab }}' !== 'reviews'}"
                >
                    Reviews ({{ $product->reviews_count ?? 0 }})
                </button>
            </div>
        </div>
        
        <div>
            <!-- Description Tab -->
            <div x-show="'{{ $reviewTab }}' === 'description'" class="animate-fade-in">
                <div class="prose prose-purple max-w-none">
                    {!! $product->description !!}
                </div>
            </div>
            
            <!-- Specifications Tab -->
            <div x-show="'{{ $reviewTab }}' === 'specifications'" class="animate-fade-in">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y">
                        @if($product->specifications)
                            @foreach($product->specifications as $name => $value)
                                <tr>
                                    <th class="py-4 px-6 bg-gray-50 font-medium text-gray-900">{{ $name }}</th>
                                    <td class="py-4 px-6">{{ $value }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="py-4 px-6 text-center text-gray-500" colspan="2">
                                    No specifications available for this product.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <!-- Reviews Tab -->
            <div x-show="'{{ $reviewTab }}' === 'reviews'" class="animate-fade-in">
                <div>
                    <h3 class="text-lg font-medium mb-4">Customer Reviews</h3>
                    @if($product->reviews && count($product->reviews) > 0)
                        <div class="space-y-6">
                            @foreach($product->reviews as $review)
                                <div class="border-b border-gray-200 pb-6 last:border-0">
                                    <div class="flex items-center mb-2">
                                        <div class="flex">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg 
                                                    class="h-4 w-4 {{ $i <= $review->rating ? 'text-amber-400' : 'text-gray-300' }}"
                                                    fill="currentColor" 
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path d="M10 15.585l-7.077 3.817 1.352-8.044L.027 7.121l8.026-1.186L10 0l1.947 5.935 8.026 1.186-4.247 4.238 1.35 8.044z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="ml-2 font-medium">{{ $review->title }}</span>
                                    </div>
                                    
                                    <p class="text-gray-600 mb-2">{{ $review->content }}</p>
                                    
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span>{{ $review->user->name }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No reviews yet. Be the first to review this product.</p>
                    @endif
                    
                    <div class="mt-8">
                        @auth
                            <a href="{{ route('product.review.create', $product) }}" class="inline-flex items-center bg-purple-600 text-white py-2 px-4 rounded-md font-medium hover:bg-purple-700 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Write a Review
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-purple-600 hover:underline">
                                Login to write a review
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if(count($relatedProducts) > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-8">You May Also Like</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="product-card group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                        <!-- Product Image -->
                        <a href="{{ route('product.show', $relatedProduct->slug) }}" class="block relative overflow-hidden">
                            {{-- <img 
                                src="{{ $relatedProduct->primaryImage ? $relatedProduct->primaryImage->image_path : asset('images/placeholder.jpg') }}" 
                                alt="{{ $relatedProduct->name }}" 
                                class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                            /> --}}
                            @if ($relatedProduct->primaryImage)    
                            <img 
                                src="{{ asset('storage/' . $relatedProduct->primaryImage->image_path) }}" 
                                alt="{{ $relatedProduct->name }}" 
                                class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                            />
                            @elseif ($relatedProduct->productImages->count() > 0)
                            <img 
                                src="{{ asset('storage/' . $relatedProduct->productImages[0]->image_path) }}" 
                                alt="{{ $relatedProduct->name }}" 
                                class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
                            />
                            @else
                            <div class="w-full flex-shrink-0 h-48 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                <span class="text-gray-500 dark:text-gray-400">{{ substr($relatedProduct->name, 0, 10) }}...</span>
                            </div>
                            @endif
                            
                            @if($relatedProduct->is_featured)
                                <span class="absolute top-2 left-2 bg-purple-500 text-white text-xs px-2 py-1 rounded-full">
                                    Featured
                                </span>
                            @endif
                            
                            @if($relatedProduct->quantity < 20 && $relatedProduct->quantity > 0)
                                <span class="absolute top-2 right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">
                                    Limited Stock
                                </span>
                            @elseif($relatedProduct->quantity <= 0)
                                <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    Out of Stock
                                </span>
                            @endif
                            
                            <!-- Quick Action Overlay -->
                            <div 
                                class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                            >
                                {{-- <livewire:add-to-cart-button 
                                    :product="$relatedProduct" 
                                    :key="'related-'.$relatedProduct->id"
                                    button-style="icon" 
                                /> --}}
                                
                                <a 
                                    href="{{ route('product.show', $relatedProduct->slug) }}"
                                    class="bg-white text-gray-800 hover:bg-purple-600 hover:text-white p-2 rounded-full transition-colors"
                                    title="View Details"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </a>
                        
                        <!-- Product Info -->
                        <div class="p-4">
                            <div class="mb-2">
                                <span class="text-xs text-gray-500 uppercase tracking-wider">
                                    {{ $relatedProduct->category->name }}
                                </span>
                            </div>
                            <a href="{{ route('product.show', $relatedProduct->slug) }}" class="block">
                                <h3 class="font-medium text-gray-900 mb-1 hover:text-purple-600 transition-colors">
                                    {{ $relatedProduct->name }}
                                </h3>
                            </a>
                            <div class="flex justify-between items-center mt-2">
                                <span class="font-semibold">${{ number_format($relatedProduct->selling_price, 2) }}</span>
                                
                                <!-- Star Rating -->
                                <div class="flex items-center">
                                    <div class="flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg 
                                                class="h-4 w-4 {{ $i <= floor($relatedProduct->average_rating) ? 'text-amber-400' : 'text-gray-300' }}" 
                                                fill="currentColor" 
                                                viewBox="0 0 20 20"
                                            >
                                                <path d="M10 15.585l-7.077 3.817 1.352-8.044L.027 7.121l8.026-1.186L10 0l1.947 5.935 8.026 1.186-4.247 4.238 1.35 8.044z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-1 text-xs text-gray-500">({{ $relatedProduct->reviews_count ?? 0 }})</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    
    <!-- Back to Products -->
    <div class="mt-8">
        <a href="{{ route('products') }}" class="inline-flex items-center text-gray-600 hover:text-purple-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Products
        </a>
    </div>
</div>
