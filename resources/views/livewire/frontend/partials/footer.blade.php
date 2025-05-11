<footer class="bg-gray-50 pt-12 pb-6">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4">{{ __('Bloom') }}</h3>
                <p class="text-gray-600 mb-4">
                    {{ __('Your one-stop shop for high-quality products at affordable prices.') }}
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-purple-600 transition-colors" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-purple-600 transition-colors" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-purple-600 transition-colors" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-md font-semibold text-gray-900 mb-4">{{ __('Quick Links') }}</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('Products') }}
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('about') }}" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('About Us') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('Contact') }}
                        </a>
                    </li> --}}
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-md font-semibold text-gray-900 mb-4">{{ __('Customer Service') }}</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('FAQ') }}
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('Shipping & Returns') }}
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('Terms & Conditions') }}
                        </a>
                    </li>
                    <li>
                        <a href="" class="text-gray-600 hover:text-purple-600 transition-colors">
                            {{ __('Privacy Policy') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-md font-semibold text-gray-900 mb-4">{{ __('Contact Us') }}</h3>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600 shrink-0 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-gray-600">123 Commerce St, City, Country</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span class="text-gray-600">+1 (555) 123-4567</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-600">support@bloom.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-200 pt-6 mt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm mb-4 md:mb-0">
                    &copy; {{ date('Y') }} {{ __('Bloom E-Commerce. All rights reserved.') }}
                </p>
                <div class="flex space-x-4">
                    <img src="{{ asset('images/payment/visa.png') }}" alt="Visa" class="h-8 w-12 object-contain">
                    <img src="{{ asset('images/payment/mastercard.png') }}" alt="Mastercard" class="h-8 w-12 object-contain">
                    <img src="{{ asset('images/payment/paypal.png') }}" alt="PayPal" class="h-8 w-12 object-contain">
                </div>
            </div>
        </div>
    </div>
</footer>
