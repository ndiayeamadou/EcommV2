<!-- Real Estate - Proposition d'app web -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Listings</title>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
        .property-card:hover .card-img { transform: scale(1.05); }
        .property-card:hover .card-overlay { opacity: 0.3; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Changed initial sidebarOpen value to true for desktop and preserved mobile behavior -->
    <div x-data="{ sidebarOpen: window.innerWidth >= 768 }" 
         x-init="$watch('sidebarOpen', value => console.log('Sidebar is now:', value ? 'open' : 'closed'))" 
         class="relative min-h-screen flex">
        
        <!-- Sidebar - Fixed the translation classes to work properly -->
        <div x-cloak 
             :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
             class="bg-white w-64 md:w-72 fixed h-full overflow-y-auto z-30 transition-transform duration-300 shadow-lg">
            
            <!-- Sidebar Header -->
            <div class="p-4 border-b">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Filters</h2>
                    <button @click="sidebarOpen = false" class="p-1 md:hidden rounded-full hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Sidebar Search -->
                <div class="mt-4">
                    <div class="relative">
                        <input type="text" placeholder="Search..." 
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filter Groups - content kept the same -->
            <div class="p-4">
                <!-- Price Range Filter -->
                <div x-data="{ open: true }" class="mb-6">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 font-medium text-gray-700">
                        <span>Price Range</span>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'transform rotate-180' : ''" class="h-5 w-5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="mt-3">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="text-sm text-gray-500">Min</label>
                                <input type="number" placeholder="0" class="w-full px-3 py-2 border rounded-md">
                            </div>
                            <div>
                                <label class="text-sm text-gray-500">Max</label>
                                <input type="number" placeholder="Any" class="w-full px-3 py-2 border rounded-md">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Location Filter -->
                <div x-data="{ open: true }" class="mb-6">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 font-medium text-gray-700">
                        <span>Location</span>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'transform rotate-180' : ''" class="h-5 w-5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="mt-3 space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">Downtown</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">Suburbs</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">Beachfront</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">Urban</span>
                        </label>
                    </div>
                </div>
                
                <!-- Property Type Filter -->
                <div x-data="{ open: true }" class="mb-6">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 font-medium text-gray-700">
                        <span>Property Type</span>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'transform rotate-180' : ''" class="h-5 w-5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="mt-3 space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">Apartment</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">House</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">Villa</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" class="rounded text-indigo-600">
                            <span class="ml-2 text-gray-700">Loft</span>
                        </label>
                    </div>
                </div>
                
                <!-- Bedrooms Filter -->
                <div x-data="{ open: true }" class="mb-6">
                    <button @click="open = !open" class="flex justify-between items-center w-full py-2 font-medium text-gray-700">
                        <span>Bedrooms</span>
                        <svg xmlns="http://www.w3.org/2000/svg" :class="open ? 'transform rotate-180' : ''" class="h-5 w-5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" class="mt-3">
                        <div class="flex flex-wrap gap-2">
                            <button class="px-3 py-1 border rounded-full hover:bg-indigo-50 hover:border-indigo-300">1+</button>
                            <button class="px-3 py-1 border rounded-full hover:bg-indigo-50 hover:border-indigo-300">2+</button>
                            <button class="px-3 py-1 border rounded-full hover:bg-indigo-50 hover:border-indigo-300">3+</button>
                            <button class="px-3 py-1 border rounded-full hover:bg-indigo-50 hover:border-indigo-300">4+</button>
                            <button class="px-3 py-1 border rounded-full hover:bg-indigo-50 hover:border-indigo-300">5+</button>
                        </div>
                    </div>
                </div>
                
                <!-- Button to apply filters -->
                <button class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                    Apply Filters
                </button>
            </div>
        </div>

        <!-- Main Content - Fixed the margin to adjust with sidebar -->
        <div class="flex-1 transition-all duration-300" 
             :class="sidebarOpen ? 'md:ml-72' : 'ml-0'">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm fixed w-full z-20">
                <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <!-- Updated the hamburger button to always be visible -->
                        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-md hover:bg-gray-100">
                            <!-- Dynamic icon that changes based on sidebar state -->
                            <svg x-show="!sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg x-show="sidebarOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <h1 class="text-xl font-bold text-gray-800">Property Listings</h1>
                    </div>
                    
                    <!-- Global Search Bar (visible on desktop) -->
                    <div class="hidden md:block w-1/3">
                        <div class="relative">
                            <input type="text" placeholder="Search properties..." 
                                  class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area - Remaining content kept the same -->
            <main class="pt-16 container mx-auto px-4 py-6">
                <!-- Mobile Search (visible on mobile) -->
                <div class="mb-6 md:hidden">
                    <div class="relative">
                        <input type="text" placeholder="Search properties..." 
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Results Count and Sort -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                    <p class="text-gray-600 mb-2 sm:mb-0">Showing <span class="font-medium">324</span> properties</p>
                    <div class="relative">
                        <select class="appearance-none bg-white border border-gray-300 rounded-md pl-3 pr-10 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option>Most Recent</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Most Popular</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Property Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Property cards remain the same -->
                    <!-- Property Card 1 -->
                    <div class="property-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <a href="/property/1" class="block">
                            <div class="relative overflow-hidden h-48">
                                <div class="absolute inset-0 card-overlay bg-black opacity-0 transition-opacity z-10"></div>
                                <img src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" 
                                     alt="Modern Downtown Apartment" 
                                     class="card-img w-full h-full object-cover transition-transform duration-500">
                                <div class="absolute top-2 right-2 z-20">
                                    <button class="h-9 w-9 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-2 left-2 z-20">
                                    <span class="bg-indigo-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">Apartment</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-gray-800">Modern Downtown Apartment</h3>
                                    <p class="text-indigo-600 font-bold">$250,000</p>
                                </div>
                                <p class="text-gray-600 text-sm mt-1">Downtown</p>
                                <p class="text-gray-600 mt-3 text-sm line-clamp-2">Luxury 2-bedroom apartment with stunning city views and modern amenities.</p>
                                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        2 beds
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        2 baths
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5" />
                                        </svg>
                                        1,200 sqft
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Property Card 2 -->
                    <div class="property-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <a href="/property/2" class="block">
                            <div class="relative overflow-hidden h-48">
                                <div class="absolute inset-0 card-overlay bg-black opacity-0 transition-opacity z-10"></div>
                                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" 
                                     alt="Cozy Suburban House" 
                                     class="card-img w-full h-full object-cover transition-transform duration-500">
                                <div class="absolute top-2 right-2 z-20">
                                    <button class="h-9 w-9 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-2 left-2 z-20">
                                    <span class="bg-green-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">House</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-gray-800">Cozy Suburban House</h3>
                                    <p class="text-indigo-600 font-bold">$450,000</p>
                                </div>
                                <p class="text-gray-600 text-sm mt-1">Suburbs</p>
                                <p class="text-gray-600 mt-3 text-sm line-clamp-2">Beautiful family home with a garden in a quiet suburban neighborhood.</p>
                                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        4 beds
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        3 baths
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5" />
                                        </svg>
                                        2,400 sqft
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Property Card 3 -->
                    <div class="property-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                        <a href="/property/3" class="block">
                            <div class="relative overflow-hidden h-48">
                                <div class="absolute inset-0 card-overlay bg-black opacity-0 transition-opacity z-10"></div>
                                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2069&q=80" 
                                     alt="Luxurious Beachfront Villa" 
                                     class="card-img w-full h-full object-cover transition-transform duration-500">
                                <div class="absolute top-2 right-2 z-20">
                                    <button class="h-9 w-9 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="absolute bottom-2 left-2 z-20">
                                    <span class="bg-amber-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">Villa</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-gray-800">Luxurious Beachfront Villa</h3>
                                    <p class="text-indigo-600 font-bold">$1,200,000</p>
                                </div>
                                <p class="text-gray-600 text-sm mt-1">Beachfront</p>
                                <p class="text-gray-600 mt-3 text-sm line-clamp-2">Exclusive villa with direct beach access and panoramic ocean views.</p>
                                <div class="mt-4 flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        5 beds
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        4 baths
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5" />
                                        </svg>
                                        3,500 sqft
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Add more property cards as needed -->
                </div>

                <!-- Pagination -->
                <div class="mt-10 flex justify-center">
                    <nav class="flex items-center space-x-1">
                        <a href="#" class="px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-indigo-50">
                            <span class="sr-only">Previous</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm bg-indigo-600 text-white font-medium">1</a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-indigo-50">2</a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-indigo-50">3</a>
                        <span class="px-3 py-2 text-gray-500">...</span>
                        <a href="#" class="px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-indigo-50">12</a>
                        <a href="#" class="px-3 py-2 rounded-md text-sm text-gray-600 hover:bg-indigo-50">
                            <span class="sr-only">Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </nav>
                </div>
            </main>
        </div>
    </div>

    <!-- Include Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
