<div x-data="{ open: @entangle('isOpen') }">
    <!-- Backdrop -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-50 z-40"
    ></div>

    <!-- Sidebar -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 max-w-xs w-full bg-white shadow-xl z-50 transform"
    >
        <!-- Header -->
        <div class="border-b pb-4 p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span class="text-lg font-bold">Bloom Menu</span>
                </div>
                <button 
                    @click="open = false"
                    class="text-gray-500 hover:text-gray-700"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-4 overflow-y-auto h-full pb-20">
            <!-- Navigation Group -->
            <div class="mb-6">
                <h3 class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-3">Navigation</h3>
                <ul class="space-y-2">
                    <li>
                        <a 
                            href="{{ route('home') }}" 
                            class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-md px-2 py-2 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>
                    
                    <li>
                        <a 
                            href="{{ route('products') }}" 
                            class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-md px-2 py-2 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span>{{ __('Products') }}</span>
                        </a>
                    </li>
                    
                    <li>
                        <a 
                            href="{{ route('cart') }}" 
                            class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-md px-2 py-2 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>{{ __('Cart') }}</span>
                        </a>
                    </li>
                    
                    <li>
                        <a 
                            {{-- href="{{ route('wishlist') }}" --}} 
                            href="" 
                            class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-md px-2 py-2 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>{{ __('Wishlist') }}</span>
                        </a>
                    </li>
                    
                    <li>
                        <a 
                            {{-- href="{{ route('account') }}" --}} 
                            href="" 
                            class="flex items-center space-x-3 text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-md px-2 py-2 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ __('My Account') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Categories Group -->
            <div>
                <h3 class="text-xs uppercase tracking-wider text-gray-500 font-semibold mb-3">{{ __('Categories') }}</h3>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <a 
                                href="{{ route('category.show', $category->slug) }}" 
                                class="flex items-center text-gray-700 hover:text-purple-600 hover:bg-purple-50 rounded-md px-2 py-2 transition-colors"
                            >
                                <span>{{ $category->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Language Switcher -->
            <div class="mt-8">
                <button 
                    wire:click="toggleLanguage" 
                    class="w-full flex items-center justify-center space-x-2 p-2 border border-gray-200 rounded-md hover:bg-gray-50 transition-colors"
                >
                    @if($currentLanguage === 'en')
                        <img src="{{ asset('images/france-flag.svg') }}" alt="French" class="w-5 h-5">
                        <span>{{ __('Switch to French') }}</span>
                    @else
                        <img src="{{ asset('images/uk-flag.svg') }}" alt="English" class="w-5 h-5">
                        <span>{{ __('Switch to English') }}</span>
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>
