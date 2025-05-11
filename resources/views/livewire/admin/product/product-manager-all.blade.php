<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ __('Manage Products') }}</h1>
                <button wire:click="create" class="bg-blue-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                    {{ __('Add New Product') }}
                </button>
            </div>
            
            @if (session()->has('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <!-- Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Search') }}</label>
                        <input 
                            wire:model.debounce.300ms="search" 
                            type="text" 
                            placeholder="{{ __('Search products...') }}" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"
                        >
                    </div>
                    
                    <div class="md:w-48">
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Category') }}</label>
                        <select 
                            wire:model="categoryFilter" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"
                        >
                            <option value="">{{ __('All Categories') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="md:w-48">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Status') }}</label>
                        <select 
                            wire:model="statusFilter" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"
                        >
                            <option value="">{{ __('All Statuses') }}</option>
                            <option value="active">{{ __('Active') }}</option>
                            <option value="inactive">{{ __('Inactive') }}</option>
                        </select>
                    </div>
                    
                    <div class="md:w-32">
                        <label for="perPage" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Per Page') }}</label>
                        <select 
                            wire:model="perPage" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"
                        >
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Products Table -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">
                                {{ __('Product') }}
                                @if ($sortField === 'name')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Category') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('price')">
                                {{ __('Price') }}
                                @if ($sortField === 'price')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider cursor-pointer" wire:click="sortBy('quantity')">
                                {{ __('Stock') }}
                                @if ($sortField === 'quantity')
                                    <span class="ml-1">
                                        @if ($sortDirection === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Status') }}
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($product->primaryImage)
                                                <img class="h-12 w-12 object-cover rounded" src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}">
                                            @else
                                                <div class="h-12 w-12 rounded bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">SKU: {{ $product->sku ?: 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $product->category->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</div>
                                    @if($product->compare_at_price)
                                        <div class="text-xs text-gray-500 dark:text-gray-400 line-through">${{ number_format($product->compare_at_price, 2) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->quantity > 20)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $product->quantity }} {{ __('in stock') }}
                                        </span>
                                    @elseif($product->quantity > 0)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            {{ $product->quantity }} {{ __('in stock') }}
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ __('Out of stock') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                    
                                    @if($product->is_featured)
                                        <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            {{ __('Featured') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="edit({{ $product->id }})" class="text-primary-600 hover:text-primary-900">
                                        {{ __('Edit') }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    {{ __('No products found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Product Edit/Create Modal -->
    @if ($showEditModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                {{ $editMode ? __('Edit Product') : __('Create New Product') }}
                            </h3>
                            
                            <!-- Tabs -->
                            <div class="border-b border-gray-200 dark:border-gray-700 mt-6">
                                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                    <button
                                        wire:click="setTab('details')"
                                        class="py-4 px-1 {{ $activeTab === 'details' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 font-medium text-sm"
                                    >
                                        {{ __('Product Details') }}
                                    </button>
                                    
                                    <button
                                        wire:click="setTab('images')"
                                        class="py-4 px-1 {{ $activeTab === 'images' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 font-medium text-sm"
                                        {{ !$editMode && !$product_id ? 'disabled' : '' }}
                                    >
                                        {{ __('Images') }}
                                    </button>
                                </nav>
                            </div>
                            
                            <div class="mt-6">
                                <!-- Product Details Tab -->
                                <div class="{{ $activeTab === 'details' ? 'block' : 'hidden' }}">
                                    <form>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                            <div class="md:col-span-2">
                                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
                                                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Slug') }}</label>
                                                <input type="text" id="slug" wire:model="slug" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Category') }}</label>
                                                <select id="category_id" wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                    <option value="">{{ __('Select Category') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Price') }}</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                                                    </div>
                                                    <input type="number" step="0.01" id="price" wire:model="price" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                                                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="compare_at_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Compare at Price') }}</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                                                    </div>
                                                    <input type="number" step="0.01" id="compare_at_price" wire:model="compare_at_price" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                                                @error('compare_at_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Quantity') }}</label>
                                                <input type="number" id="quantity" wire:model="quantity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                @error('quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="sku" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('SKU') }}</label>
                                                <input type="text" id="sku" wire:model="sku" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                @error('sku') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="barcode" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Barcode') }}</label>
                                                <input type="text" id="barcode" wire:model="barcode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                @error('barcode') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="md:col-span-2">
                                                <label for="short_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Short Description') }}</label>
                                                <textarea id="short_description" wire:model="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"></textarea>
                                                @error('short_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="md:col-span-2">
                                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                                                <textarea id="description" wire:model="description" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"></textarea>
                                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="md:col-span-2">
                                                <div class="flex items-center space-x-6">
                                                    <div class="flex items-center">
                                                        <input type="checkbox" id="is_active" wire:model="is_active" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                                        <label for="is_active" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Active') }}</label>
                                                    </div>
                                                    
                                                    <div class="flex items-center">
                                                        <input type="checkbox" id="is_featured" wire:model="is_featured" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                                        <label for="is_featured" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Featured') }}</label>
                                                    </div>
                                                    
                                                    <div class="flex items-center">
                                                        <input type="checkbox" id="is_digital" wire:model="is_digital" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                                        <label for="is_digital" class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Digital Product') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            @if($is_digital)
                                                <div class="md:col-span-2">
                                                    <label for="digital_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Digital Product URL') }}</label>
                                                    <input type="text" id="digital_url" wire:model="digital_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                    @error('digital_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                </div>
                                            @endif
                                            
                                            <div class="md:col-span-2">
                                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('SEO Information') }}</h4>
                                                
                                                <div class="space-y-4">
                                                    <div>
                                                        <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Meta Title') }}</label>
                                                        <input type="text" id="meta_title" wire:model="meta_title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                        @error('meta_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                    </div>
                                                    
                                                    <div>
                                                        <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Meta Description') }}</label>
                                                        <textarea id="meta_description" wire:model="meta_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"></textarea>
                                                        @error('meta_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                    </div>
                                                    
                                                    <div>
                                                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Meta Keywords') }}</label>
                                                        <input type="text" id="meta_keywords" wire:model="meta_keywords" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Separate keywords with commas') }}</p>
                                                        @error('meta_keywords') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Images Tab -->
                                <div class="{{ $activeTab === 'images' ? 'block' : 'hidden' }}">
                                    @if($editMode || $product_id)
                                        <div class="space-y-6">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">{{ __('Current Images') }}</label>
                                                
                                                @if($images->count() > 0)
                                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                                        @foreach($images as $image)
                                                            <div class="relative group rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $name }}" class="w-full h-40 object-cover">
                                                                
                                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center">
                                                                    <div class="hidden group-hover:flex space-x-2">
                                                                        @if(!$image->is_primary)
                                                                            <button 
                                                                                wire:click="setPrimaryImage({{ $image->id }})" 
                                                                                class="bg-blue-500 hover:bg-blue-600 text-white p-1 rounded"
                                                                                title="{{ __('Set as primary') }}"
                                                                            >
                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                                </svg>
                                                                            </button>
                                                                        @endif
                                                                        
                                                                        <button 
                                                                            wire:click="deleteImage({{ $image->id }})" 
                                                                            class="bg-red-500 hover:bg-red-600 text-white p-1 rounded"
                                                                            title="{{ __('Delete image') }}"
                                                                        >
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if($image->is_primary)
                                                                    <div class="absolute top-2 left-2">
                                                                        <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">{{ __('Primary') }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-gray-500 dark:text-gray-400">{{ __('No images uploaded yet.') }}</p>
                                                @endif
                                            </div>
                                            
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Upload New Images') }}</label>
                                                
                                                <div 
                                                    x-data="{ isUploading: false, progress: 0 }"
                                                    x-on:livewire-upload-start="isUploading = true"
                                                    x-on:livewire-upload-finish="isUploading = false"
                                                    x-on:livewire-upload-error="isUploading = false"
                                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                                    class="mt-2"
                                                >
                                                    <label 
                                                        for="file-upload"
                                                        class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none"
                                                    >
                                                        <div class="flex items-center justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                                                            <div class="space-y-1 text-center">
                                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4h-12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                                                    <input 
                                                                        id="file-upload"
                                                                        wire:model="uploadedImages"
                                                                        type="file"
                                                                        class="sr-only"
                                                                        multiple
                                                                        accept="image/*"
                                                                    >
                                                                    <p class="pl-1">{{ __('Click to upload or drag and drop') }}</p>
                                                                </div>
                                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('PNG, JPG, GIF up to 2MB') }}</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                    
                                                    <!-- Progress Bar -->
                                                    <div x-show="isUploading" class="mt-2">
                                                        <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                                                            <div class="h-2 bg-primary-500 rounded-full" x-bind:style="'width: ' + progress + '%'"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                @error('uploadedImages.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                                
                                                <!-- Preview uploaded images -->
                                                @if(count($tempImages) > 0)
                                                    <div class="mt-4">
                                                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Preview') }}</h4>
                                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                                            @foreach($tempImages as $index => $image)
                                                                <div class="relative group">
                                                                    <img src="{{ $image['tempUrl'] }}" alt="Preview" class="w-full h-40 object-cover rounded-lg">
                                                                    <div class="absolute top-2 right-2">
                                                                        <button wire:click="removeUploadedImage({{ $index }})" class="bg-red-500 hover:bg-red-600 text-white p-1 rounded-full">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                                            {{ __('Please save the product first to add images.') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="save" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-600 text-base font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Save Product') }}
                    </button>
                    <button wire:click="$set('showEditModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('Cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Initialize Alpine.js -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('modal', () => ({
                show: false,
                init() {
                    const component = this;
                    document.addEventListener('open-modal', () => {
                        component.show = true;
                    });
                    document.addEventListener('close-modal', () => {
                        component.show = false;
                    });
                }
            }));
        });
    </script>
</div>
