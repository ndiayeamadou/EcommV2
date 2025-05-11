<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center">
            <span class="text-2xl font-bold text-primary">Bloom</span>
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition-colors">
                @lang('messages.home')
            </a>
            <a href="{{ route('admin.products') }}" class="text-gray-700 hover:text-primary transition-colors">
                @lang('messages.products')
            </a>
            <a href="{{ route('admin.categories') }}" class="text-gray-700 hover:text-primary transition-colors">
                @lang('messages.categories')
            </a>
            <a href="" class="text-gray-700 hover:text-primary transition-colors">
                @lang('messages.about')
            </a>
        </div>

        <div class="language-switcher">
            <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
            <a href="{{ route('language.switch', 'fr') }}" class="{{ app()->getLocale() == 'fr' ? 'active' : '' }}">FR</a>
        </div>        

        <!-- Search, Cart, and User Icons -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="" class="p-2 rounded-full hover:bg-primary-light">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </a>
            
            {{-- <a href="{{ route('cart') }}" class="p-2 rounded-full hover:bg-primary-light relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                @livewire('cart-counter')
            </a> --}}
            
            @auth
                <a href="{{ route('settings.profile') }}" class="p-2 rounded-full hover:bg-primary-light">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            @else
                <a href="{{ route('login') }}" class="p-2 rounded-full hover:bg-primary-light">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <button x-data="{ open: false }" @click="open = !open" class="md:hidden">
            <template x-if="!open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </template>
            <template x-if="open">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </template>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div x-data="{ open: false }" x-show="open" class="md:hidden bg-white px-4 pt-2 pb-4 shadow-md animate-fade-in">
        <!-- Mobile menu items -->
    </div>
</header>
