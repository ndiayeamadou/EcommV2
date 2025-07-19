<div>
    <div class="bg-gray-50 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-900">@lang('messages.all_products')</h1>
            <div class="flex items-center text-sm text-gray-500 mt-2">
                <a href="/" class="hover:text-primary">{{ __('messages.home') }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700">@lang('messages.products')</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Filters Sidebar -->
            <aside class="w-full lg:w-1/4 bg-white p-6 rounded-lg shadow-sm h-fit">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-medium text-lg">@lang('messages.filters')</h3>
                    <button wire:click="resetFilters" class="text-sm text-primary">
                        {{-- Clear all --}}
                        @lang('messages.clear_all')
                    </button>
                </div>

                <!-- Categories Filter -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-medium">{{ __('messages.categories') }}</h4>
                    </div>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input 
                                    type="checkbox" 
                                    id="category-{{ $category->id }}"
                                    value="{{ $category->id }}"
                                    wire:model="selectedCategories"
                                    class="rounded border-gray-300 text-primary focus:ring-primary mr-2"
                                />
                                <label for="category-{{ $category->id }}" class="text-gray-700">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-medium">Price Range</h4>
                    </div>
                    <div class="mt-4 px-2">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-500 text-sm">${{ $minPrice }}</span>
                            <span class="text-gray-500 text-sm">${{ $maxPrice }}</span>
                        </div>
                        <input 
                            type="range" 
                            min="0" 
                            max="1500" 
                            wire:model="priceRange"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary"
                        />
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="w-full lg:w-3/4">
                <!-- Sort Controls -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <p class="text-gray-500">
                            Showing <span class="font-medium">{{ $products->count() }}</span> products
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-500">Sort by:</span>
                        <select 
                            wire:model="sortBy"
                            class="border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-primary"
                        >
                            <option value="featured">Featured</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                            <option value="rating">Rating</option>
                        </select>
                    </div>
                </div>

                <!-- Products -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                            <a href="{{ route('product.show', $product) }}" class="block relative group">
                                {{-- <img
                                    src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-48 object-cover transition-transform group-hover:scale-105 duration-300"
                                /> --}}
                                @if ($product->primaryImage)
                                    <img
                                        src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover transition-transform group-hover:scale-105 duration-300"
                                    />
                                @elseif ($product->productImages->count() > 0)
                                    <img
                                        src="{{ asset('storage/' . $product->productImages[0]->image_path) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-48 object-cover transition-transform group-hover:scale-105 duration-300"
                                    />
                                @else
                                @endif
                                @if($product->is_featured)
                                    <span class="absolute top-2 left-2 bg-primary text-white text-xs px-2 py-1 rounded-full">
                                        Featured
                                    </span>
                                @endif
                                @if($product->quantity < 10)
                                    <span class="absolute top-2 right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">
                                        {{-- Limited Stock --}}
                                        Stock Limité
                                    </span>
                                @endif
                            </a>
                            <div class="p-4">
                                <div class="mb-2">
                                    <span class="text-xs text-gray-500 uppercase tracking-wider">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                                <a href="{{ route('product.show', $product) }}" class="block">
                                    <h3 class="font-medium text-gray-900 mb-1 hover:text-primary transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                </a>
                                <div class="flex justify-between items-center mt-2">
                                    {{-- <span class="text-lg font-semibold">${{ number_format($product->selling_price, 2) }}</span> --}}
                                    <span class="text-lg font-semibold">{{ number_format($product->selling_price, 2) }} FCFA</span>
                                    <div class="flex space-x-2">
                                        <button class="p-2 rounded-full hover:bg-primary-light hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                        {{-- <button wire:click="addToCart({{ $product->id }})" class="p-2 rounded-full hover:bg-primary-light hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                            </svg>
                                        </button> --}}
                                        <livewire:inc.addtocart :productId="$product->id" />
                                        {{-- @livewire('inc.addtocart', ['productId' => $product->id]) --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
