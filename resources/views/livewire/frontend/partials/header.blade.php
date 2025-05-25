<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" wire:navigate class="flex items-center">
            <span class="text-2xl font-bold text-purple-600">Boutique</span>
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('home') }} wire:navigate" class="text-gray-700 hover:text-purple-600 transition-colors">
                {{ __('messages.home') }}
            </a>
            <a href="{{ route('products') }}" wire:navigate class="text-gray-700 hover:text-purple-600 transition-colors">
                {{-- {{ __('Products') }} --}}
                @lang('messages.products')
            </a>
            <a href="{{ route('categories') }}" wire:navigate class="text-gray-700 hover:text-purple-600 transition-colors">
                {{ __('messages.categories') }}
            </a>
            {{-- <a href="{{ route('about') }}" class="text-gray-700 hover:text-purple-600 transition-colors">
                {{ __('About') }}
            </a> --}}
        </div>

        <!-- Search, Cart, User Icons, and Language Flag -->
        <div class="hidden md:flex items-center space-x-4">
            <button type="button" class="p-2 hover:bg-purple-100 rounded-full" aria-label="Search">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            
            <a href="{{ route('cart') }}" wire:navigate class="relative p-2 hover:bg-purple-100 rounded-full" aria-label="Cart">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                {{-- @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 bg-purple-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                        {{ $cartCount > 9 ? '9+' : $cartCount }}
                    </span>
                @endif --}}
                <span class="absolute -top-1 -right-1 bg-purple-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                    <livewire:frontend.cart.cart-count />
                </span>
            </a>
            
            <a href="{{ route('login') }}" wire:navigate class="p-2 hover:bg-purple-100 rounded-full" aria-label="Account">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </a>
            
            <button 
                wire:click="toggleLanguage" 
                class="ml-2 p-1 hover:bg-gray-100 rounded-md"
                title="{{ $currentLanguage === 'en' ? 'Switch to French' : 'Switch to English' }}"
            >
                @if($currentLanguage === 'en')
                    <img src="{{ asset('images/france-flag.svg') }}" alt="French" class="w-6 h-6">
                @else
                    <img src="{{ asset('images/uk-flag.svg') }}" alt="English" class="w-6 h-6">
                @endif
            </button>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden flex items-center space-x-2">
            <button 
                wire:click="toggleLanguage" 
                class="p-1 hover:bg-gray-100 rounded-md"
                title="{{ $currentLanguage === 'en' ? 'Switch to French' : 'Switch to English' }}"
            >
                @if($currentLanguage === 'en')
                    <img src="{{ asset('images/france-flag.svg') }}" alt="French" class="w-6 h-6">
                @else
                    <img src="{{ asset('images/uk-flag.svg') }}" alt="English" class="w-6 h-6">
                @endif
            </button>
            
            <button class="ml-2" wire:click="toggleMenu">
                @if($isMenuOpen)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                @endif
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    @if($isMenuOpen)
        <div class="md:hidden bg-white px-4 pt-2 pb-4 shadow-md animate-fade-in">
            <div class="flex flex-col space-y-3">
                <a
                    href="{{ route('home') }}" wire:navigate
                    class="px-2 py-2 text-gray-700 hover:bg-purple-100 rounded-md"
                    wire:click="toggleMenu"
                >
                    {{ __('messages.home') }}
                </a>
                <a
                    href="{{ route('products') }}" wire:navigate
                    class="px-2 py-2 text-gray-700 hover:bg-purple-100 rounded-md"
                    wire:click="toggleMenu"
                >
                    {{ __('Products') }}
                </a>
                <a
                    href="{{ route('categories') }}" wire:navigate
                    class="px-2 py-2 text-gray-700 hover:bg-purple-100 rounded-md"
                    wire:click="toggleMenu"
                >
                    {{ __('Categories') }}
                </a>
                {{-- <a
                    href="{{ route('about') }}"
                    class="px-2 py-2 text-gray-700 hover:bg-purple-100 rounded-md"
                    wire:click="toggleMenu"
                >
                    {{ __('About') }}
                </a> --}}
                <hr class="border-gray-200" />
                <div class="flex justify-between">
                    {{-- <a
                        href="{{ route('search') }}"
                        class="px-2 py-2 text-gray-700 hover:bg-purple-100 rounded-md flex items-center"
                        wire:click="toggleMenu"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        {{ __('Search') }}
                    </a> --}}
                    <a
                        href="{{ route('cart') }}" wire:navigate
                        class="px-2 py-2 text-gray-700 hover:bg-purple-100 rounded-md flex items-center"
                        wire:click="toggleMenu"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ __('Cart') }} ({{ $cartCount }})
                    </a>
                    <a
                        href="{{ route('login') }}" wire:navigate
                        class="px-2 py-2 text-gray-700 hover:bg-purple-100 rounded-md flex items-center"
                        wire:click="toggleMenu"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ __('Account') }}
                    </a>
                </div>
            </div>
        </div>
    @endif
</header>
