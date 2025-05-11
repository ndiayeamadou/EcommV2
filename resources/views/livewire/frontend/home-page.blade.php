<div>
    <!-- Hero Section with Animation -->
    <section class="bg-gradient-to-b from-purple-100 to-white py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0" 
                     x-data="{show: false}"
                     x-init="setTimeout(() => show = true, 200)"
                     x-show="show"
                     x-transition:enter="transition duration-700 ease-out"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                        {{ __('Discover Modern Essentials') }}
                    </h1>
                    <p class="text-lg text-gray-700 mb-8 max-w-lg">
                        {{ __('Find premium products for your lifestyle. From tech to fashion, we\'ve curated the best just for you.') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="{{ route('products') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-6 rounded-md transition-colors">
                            {{ __('Shop Now') }}
                        </a>
                        <a href="{{ route('categories') }}" class="border border-purple-600 text-purple-600 hover:bg-purple-50 font-medium py-2 px-6 rounded-md transition-colors">
                            {{ __('View Categories') }}
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2"
                     x-data="{show: false}"
                     x-init="setTimeout(() => show = true, 500)"
                     x-show="show"
                     x-transition:enter="transition duration-700 ease-out"
                     x-transition:enter-start="opacity-0 transform translate-x-10"
                     x-transition:enter-end="opacity-100 transform translate-x-0">
                    <img
                        src="{{ asset('images/hero.jpg') }}"
                        alt="Hero"
                        class="rounded-lg shadow-lg hover:scale-[1.02] transition-all duration-500"
                    />
                </div>
            </div>
        </div>
    </section>

    <!-- Product Slider Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">{{ __('Trending Now') }}</h2>
            {{-- <livewire:home.product-slider /> --}}
        </div>
    </section>

    <!-- Categories Section -->
    {{-- <livewire:home.category-list /> --}}

    <!-- Featured Products Section -->
    {{-- <livewire:home.featured-products /> --}}

    <!-- Promotion Banner -->
    <section class="py-12 bg-purple-600 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4"
                    x-data="{show: false}"
                    x-intersect="show = true"
                    x-show="show"
                    x-transition:enter="transition duration-700 ease-out"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100">
                    {{ __('Special Offer: Get 20% Off Your First Order!') }}
                </h2>
                <p class="mb-6 max-w-2xl mx-auto">
                    {{ __('Sign up for our newsletter and receive a 20% discount code for your first purchase. Don\'t miss out on this limited-time offer!') }}
                </p>
                <form wire:submit.prevent="subscribeNewsletter" class="flex flex-col sm:flex-row justify-center items-center max-w-md mx-auto space-y-4 sm:space-y-0 sm:space-x-4">
                    <input
                        type="email"
                        wire:model="email"
                        placeholder="{{ __('Your email address') }}"
                        class="w-full px-4 py-2 border rounded-md bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-300"
                    />
                    <button type="submit" class="bg-white text-purple-600 hover:bg-gray-100 font-medium py-2 px-6 rounded-md transition-colors w-full sm:w-auto">
                        {{ __('Subscribe') }}
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 hover:scale-105 transition-transform duration-300"
                     x-data="{show: false}"
                     x-intersect="show = true"
                     x-show="show"
                     x-transition:enter="transition duration-700 ease-out delay-100"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-purple-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('Free Shipping') }}</h3>
                    <p class="text-gray-600">
                        {{ __('Enjoy free shipping on all orders over $50') }}
                    </p>
                </div>
                
                <div class="text-center p-6 hover:scale-105 transition-transform duration-300"
                     x-data="{show: false}"
                     x-intersect="show = true"
                     x-show="show"
                     x-transition:enter="transition duration-700 ease-out delay-300"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-purple-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('Secure Payment') }}</h3>
                    <p class="text-gray-600">
                        {{ __('Your payment information is always protected') }}
                    </p>
                </div>
                
                <div class="text-center p-6 hover:scale-105 transition-transform duration-300"
                     x-data="{show: false}"
                     x-intersect="show = true"
                     x-show="show"
                     x-transition:enter="transition duration-700 ease-out delay-500"
                     x-transition:enter-start="opacity-0 transform translate-y-10"
                     x-transition:enter-end="opacity-100 transform translate-y-0">
                    <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-purple-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">{{ __('24/7 Support') }}</h3>
                    <p class="text-gray-600">
                        {{ __('Our customer service team is always ready to help') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Partners Slider Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-center mb-10">{{ __('Our Partners') }}</h2>
            
            <!-- Partners Slider with auto-scroll and indicators -->
            <div 
                x-data="{
                    activeSlide: 0,
                    totalSlides: 5,  // Update this based on actual partner count
                    autoPlayInterval: null,
                    
                    init() {
                        this.startAutoPlay();
                        
                        // Pause on hover
                        this.$el.addEventListener('mouseenter', () => this.stopAutoPlay());
                        this.$el.addEventListener('mouseleave', () => this.startAutoPlay());
                    },
                    
                    startAutoPlay() {
                        this.autoPlayInterval = setInterval(() => {
                            this.activeSlide = (this.activeSlide + 1) % this.totalSlides;
                        }, 3000);
                    },
                    
                    stopAutoPlay() {
                        clearInterval(this.autoPlayInterval);
                    },
                    
                    goToSlide(index) {
                        this.activeSlide = index;
                        this.stopAutoPlay();
                        this.startAutoPlay();
                    }
                }"
                class="relative overflow-hidden"
            >
                <!-- Partners Container -->
                <div class="flex transition-transform duration-500 ease-in-out"
                     :style="`transform: translateX(-${activeSlide * 100}%)`">
                    
                    <!-- Partner 1 -->
                    <div class="w-full flex-shrink-0 flex justify-center items-center px-4">
                        <img src="{{ asset('images/partners/partner1.png') }}" alt="Partner 1" 
                             class="max-h-20 filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    
                    <!-- Partner 2 -->
                    <div class="w-full flex-shrink-0 flex justify-center items-center px-4">
                        <img src="{{ asset('images/partners/partner2.png') }}" alt="Partner 2" 
                             class="max-h-20 filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    
                    <!-- Partner 3 -->
                    <div class="w-full flex-shrink-0 flex justify-center items-center px-4">
                        <img src="{{ asset('images/partners/partner3.png') }}" alt="Partner 3" 
                             class="max-h-20 filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    
                    <!-- Partner 4 -->
                    <div class="w-full flex-shrink-0 flex justify-center items-center px-4">
                        <img src="{{ asset('images/partners/partner4.png') }}" alt="Partner 4" 
                             class="max-h-20 filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                    
                    <!-- Partner 5 -->
                    <div class="w-full flex-shrink-0 flex justify-center items-center px-4">
                        <img src="{{ asset('images/partners/partner5.png') }}" alt="Partner 5" 
                             class="max-h-20 filter grayscale hover:grayscale-0 transition-all duration-300">
                    </div>
                </div>
                
                <!-- Indicator Dots -->
                <div class="flex justify-center mt-8 space-x-2">
                    <template x-for="(_, index) in Array.from({length: totalSlides})" :key="index">
                        <button 
                            @click="goToSlide(index)"
                            class="w-3 h-3 rounded-full transition-all duration-300"
                            :class="{'bg-purple-600': activeSlide === index, 'bg-gray-300': activeSlide !== index}"
                            :aria-label="`Go to slide ${index + 1}`"
                        ></button>
                    </template>
                </div>
            </div>
        </div>
    </section>
</div>
