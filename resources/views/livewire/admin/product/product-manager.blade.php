<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    {{ $editMode ? __('messages.edit_product') : __('messages.create_new_product') }}
                </h1>
                
                @if($editMode)
                <button wire:click="createNew" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    {{-- {{ __('messages.add_new_product') }} --}}
                    @lang('messages.add_new_product')
                </button>
                @endif
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
            
            <!-- Tabs -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8 px-6 pt-4" aria-label="Tabs">
                        <button
                            wire:click="setTab('details')"
                            class="py-4 px-1 {{ $activeTab === 'details' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 font-medium text-sm"
                        >
                            {{ __('messages.product_details') }}
                        </button>
                        
                        <button
                            wire:click="setTab('images')"
                            class="py-4 px-1 {{ $activeTab === 'images' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 font-medium text-sm"
                        >
                            {{ __('Images') }}
                        </button>
                        
                        <button
                            wire:click="setTab('seo')"
                            class="py-4 px-1 {{ $activeTab === 'seo' ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} border-b-2 font-medium text-sm"
                        >
                            {{ __('SEO') }}
                        </button>
                    </nav>
                </div>
                
                <form wire:submit.prevent="save">
                    <div class="p-6">
                        <!-- Product Details Tab -->
                        <div class="{{ $activeTab === 'details' ? 'block' : 'hidden' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                                <div class="md:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.Name') }}</label>
                                    <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Slug') }}</label>
                                    <input type="text" id="slug" wire:model="slug" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.Category') }}</label>
                                    <select id="category_id" wire:model="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                        <option value="">{{ __('Select Category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="selling_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.price') }}</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" step="0.01" id="selling_price" wire:model="selling_price" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                    @error('selling_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('messages.quantity') }}</label>
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
                            </div>
                        </div>
                        
                        <!-- Images Tab -->
                        <div class="{{ $activeTab === 'images' ? 'block' : 'hidden' }}">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4">{{ __('Current Images') }}</label>
                                    
                                    @if(count($images) > 0)
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
                                                                    type="button"
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
                                                                type="button"
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
                                                            <button type="button" wire:click="removeUploadedImage({{ $index }})" class="bg-red-500 hover:bg-red-600 text-white p-1 rounded-full">
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
                        </div>
                        
                        <!-- SEO Tab -->
                        <div class="{{ $activeTab === 'seo' ? 'block' : 'hidden' }}">
                            <div class="space-y-4">
                                <div>
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Meta Title') }}</label>
                                    <input type="text" id="meta_title" wire:model="meta_title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Recommended: 50-60 characters') }}</p>
                                    @error('meta_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Meta Description') }}</label>
                                    <textarea id="meta_description" wire:model="meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600"></textarea>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Recommended: 150-160 characters') }}</p>
                                    @error('meta_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Meta Keywords') }}</label>
                                    <input type="text" id="meta_keywords" wire:model="meta_keywords" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-gray-700 dark:border-gray-600">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ __('Separate keywords with commas') }}</p>
                                    @error('meta_keywords') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md mt-4">
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('SEO Preview') }}</h4>
                                    
                                    <div class="border border-gray-200 dark:border-gray-600 p-4 rounded-md bg-white dark:bg-gray-800">
                                        <h5 class="text-blue-600 text-lg font-medium truncate">
                                            {{ $meta_title ?: $name }}
                                        </h5>
                                        <p class="text-green-600 text-sm truncate">
                                            {{ Request::root() }}/products/{{ $slug }}
                                        </p>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2 mt-1">
                                            {{ $meta_description ?: $short_description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-3 flex justify-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{-- {{ __('Save Product') }} --}}
                            {{ $editMode ? __('Update Product') : __('Save Product') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
