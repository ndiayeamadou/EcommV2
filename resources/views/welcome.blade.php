{{-- Real estate detail page --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Detail - Luxury Beachfront Villa</title>
    @vite('resources/css/app.css')
    <style>
        [x-cloak] { display: none !important; }
        .property-image:hover { transform: scale(1.02); }
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        .slide-in { animation: slideIn 0.5s ease-in-out; }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        /* Image gallery animation */
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 1rem;
        }
        
        .image-gallery img {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        /* Lightbox styles */
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }
        
        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }
        
        .lightbox-content img {
            max-width: 100%;
            max-height: 90vh;
            border-radius: 0.5rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }
        
        .lightbox-close, .lightbox-prev, .lightbox-next {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .lightbox-close:hover, .lightbox-prev:hover, .lightbox-next:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        .lightbox-close {
            top: -50px;
            right: 0;
        }
        
        .lightbox-prev {
            left: -60px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .lightbox-next {
            right: -60px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div x-data="{ 
            activeTab: 'overview',
            showLightbox: false,
            currentImage: 0,
            images: [
                'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2069&q=80',
                'https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                'https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80'
            ],
            openLightbox(index) {
                this.currentImage = index;
                this.showLightbox = true;
                document.body.style.overflow = 'hidden';
            },
            closeLightbox() {
                this.showLightbox = false;
                document.body.style.overflow = 'auto';
            },
            nextImage() {
                this.currentImage = (this.currentImage + 1) % this.images.length;
            },
            prevImage() {
                this.currentImage = (this.currentImage - 1 + this.images.length) % this.images.length;
            },
            handleKeydown(event) {
                if (!this.showLightbox) return;
                if (event.key === 'Escape') this.closeLightbox();
                if (event.key === 'ArrowRight') this.nextImage();
                if (event.key === 'ArrowLeft') this.prevImage();
            }
        }" 
        class="relative min-h-screen"
        @keydown.window="handleKeydown">
        
        <!-- Main Content -->
        <div class="w-full">
            <!-- Top Navbar -->
            <header class="bg-white shadow-sm fixed w-full z-20">
                <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                    <h1 class="text-xl font-bold text-gray-800">Property Details</h1>
                    
                    <!-- Back to listings button -->
                    <a href="/properties" class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Back to Listings
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="pt-16 container mx-auto px-4 py-6">
                <!-- Property Header -->
                <div class="slide-in mb-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">Luxurious Beachfront Villa</h1>
                            <p class="text-lg text-gray-600 mt-1">
                                <span class="inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Oceanfront Drive, Malibu Beach
                                </span>
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="text-3xl font-bold text-indigo-600">$1,200,000</span>
                            <span class="text-gray-500 text-sm ml-2">Est. $5,250/mo</span>
                        </div>
                    </div>
                    
                    <!-- Property Tags -->
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-2.5 py-1 rounded-full">Villa</span>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-1 rounded-full">Beachfront</span>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-1 rounded-full">Swimming Pool</span>
                        <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-1 rounded-full">Luxury</span>
                    </div>
                </div>
                
                <!-- Main Image & Gallery -->
                <div class="fade-in mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Main Image -->
                        <div class="overflow-hidden rounded-xl">
                            <img 
                                src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&auto=format&fit=crop&w=2069&q=80" 
                                alt="Luxurious Beachfront Villa - Main View" 
                                class="w-full h-96 object-cover property-image transition-transform duration-500 cursor-pointer"
                                @click="openLightbox(0)">
                        </div>
                        
                        <!-- Gallery Grid -->
                        <div class="grid grid-cols-2 gap-4 h-96">
                            <template x-for="(image, index) in images.slice(1, 5)" :key="index">
                                <div class="overflow-hidden rounded-xl">
                                    <img 
                                        :src="image" 
                                        :alt="`Property Image ${index + 1}`" 
                                        class="w-full h-full object-cover property-image transition-transform duration-500 cursor-pointer"
                                        @click="openLightbox(index + 1)">
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    <!-- "View all photos" button -->
                    <div class="mt-2 text-right">
                        <button @click="openLightbox(0)" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            View all 12 photos
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Property Details Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
                    <!-- Left Column - Details -->
                    <div class="lg:col-span-2 slide-in" style="animation-delay: 0.1s">
                        <!-- Property Tabs -->
                        <div class="border-b border-gray-200 mb-8">
                            <div class="flex -mb-px">
                                <button 
                                    @click="activeTab = 'overview'" 
                                    :class="{'border-b-2 border-indigo-600 text-indigo-600': activeTab === 'overview', 'text-gray-500 hover:text-gray-700': activeTab !== 'overview'}"
                                    class="py-4 px-6 font-medium text-sm">
                                    Overview
                                </button>
                                <button 
                                    @click="activeTab = 'features'" 
                                    :class="{'border-b-2 border-indigo-600 text-indigo-600': activeTab === 'features', 'text-gray-500 hover:text-gray-700': activeTab !== 'features'}"
                                    class="py-4 px-6 font-medium text-sm">
                                    Features
                                </button>
                                <button 
                                    @click="activeTab = 'location'" 
                                    :class="{'border-b-2 border-indigo-600 text-indigo-600': activeTab === 'location', 'text-gray-500 hover:text-gray-700': activeTab !== 'location'}"
                                    class="py-4 px-6 font-medium text-sm">
                                    Location
                                </button>
                            </div>
                        </div>
                        
                        <!-- Tab Contents -->
                        <div>
                            <!-- Overview Tab -->
                            <div x-show="activeTab === 'overview'" class="slide-in">
                                <div class="mb-6">
                                    <h2 class="text-2xl font-bold text-gray-800 mb-4">About This Property</h2>
                                    <p class="text-gray-600 mb-4">
                                        This stunning beachfront villa offers an unparalleled luxury living experience with direct access to pristine sandy beaches and breathtaking ocean views. Built in 2018 and recently renovated, this 3,500 sq. ft. property combines modern architectural elegance with comfortable living spaces designed for both relaxation and entertainment.
                                    </p>
                                    <p class="text-gray-600 mb-4">
                                        The main living area features floor-to-ceiling windows that flood the space with natural light and showcase panoramic ocean views. The open-concept design seamlessly connects the gourmet kitchen, dining area, and living room, creating a perfect flow for entertaining guests or enjoying quiet evenings with family.
                                    </p>
                                    <p class="text-gray-600">
                                        Outside, the property boasts a private infinity pool that appears to merge with the ocean, a spacious deck with lounging areas, and a covered outdoor kitchen perfect for al fresco dining. The landscaped gardens provide privacy while maintaining the connection to the natural beachfront environment.
                                    </p>
                                </div>
                                
                                <!-- Property Highlights -->
                                <div class="mb-6">
                                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Property Highlights</h3>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="text-gray-500 text-sm mb-1">Bedrooms</div>
                                            <div class="text-gray-900 font-semibold flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                5 Beds
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="text-gray-500 text-sm mb-1">Bathrooms</div>
                                            <div class="text-gray-900 font-semibold flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                4 Baths
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="text-gray-500 text-sm mb-1">Square Feet</div>
                                            <div class="text-gray-900 font-semibold flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                3,500
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="text-gray-500 text-sm mb-1">Year Built</div>
                                            <div class="text-gray-900 font-semibold flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                2018
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Features Tab -->
                            <div x-show="activeTab === 'features'" class="slide-in" x-cloak>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Property Features</h2>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Interior Features</h3>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Gourmet kitchen with high-end appliances</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Floor-to-ceiling windows with ocean views</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Master suite with private terrace</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Smart home technology throughout</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Wine cellar with temperature control</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Home theater with surround sound</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Exterior Features</h3>
                                        <ul class="space-y-2">
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Infinity edge swimming pool</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Private beach access</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Outdoor kitchen with built-in BBQ</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Landscaped gardens with irrigation system</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Two-car garage with EV charging</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Security system with cameras</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Location Tab -->
                            <div x-show="activeTab === 'location'" class="slide-in" x-cloak>
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Location</h2>
                                
                                <!-- Map Placeholder (in a real app, integrate with Google Maps or similar) -->
                                <div class="bg-gray-200 rounded-xl w-full h-80 mb-6 flex items-center justify-center">
                                    <div class="text-center p-5">
                                        <div class="mb-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-600">Map view would be displayed here.</p>
                                        <p class="text-gray-500 text-sm">Integrate with Google Maps API or similar service.</p>
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Neighborhood</h3>
                                    <p class="text-gray-600 mb-4">
                                        This property is located in the prestigious Malibu Beach area, known for its pristine beaches, upscale dining, and celebrity homes. The neighborhood offers a perfect balance of privacy and accessibility to urban amenities.
                                    </p>
                                </div>
                                
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Nearby Amenities</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <h4 class="font-medium text-gray-700 mb-2">Within 5 minutes</h4>
                                            <ul class="space-y-1 text-gray-600">
                                                <li>• Oceanside Gourmet Market</li>
                                                <li>• Blue Wave Beach Club</li>
                                                <li>• Coastal Cafe</li>
                                                <li>• Public Beach Access</li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-700 mb-2">Within 15 minutes</h4>
                                            <ul class="space-y-1 text-gray-600">
                                                <li>• Malibu Town Center</li>
                                                <li>• Pacific View Elementary School</li>
                                                <li>• Harbor Medical Center</li>
                                                <li>• Sunset Hills Golf Club</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Contact & Info -->
                    <div class="fade-in" style="animation-delay: 0.2s">
                        <!-- Contact Card -->
                        <div class="bg-white rounded-xl border shadow-sm overflow-hidden sticky top-24">
                            <div class="p-5 border-b">
                                <h3 class="text-lg font-semibold text-gray-800">Contact Agent</h3>
                                <p class="text-gray-500 text-sm mt-1">Get more information about this property</p>
                            </div>
                            
                            <div class="p-5">
                                <div class="flex items-center mb-5">
                                    <div class="h-14 w-14 rounded-full bg-gray-200 overflow-hidden mr-3">
                                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             alt="Agent Avatar" 
                                             class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Jennifer Roberts</h4>
                                        <p class="text-gray-500 text-sm">Luxury Property Specialist</p>
                                    </div>
                                </div>
                                
                                <form class="space-y-4">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                                        <input type="text" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                        <input type="email" id="email" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <input type="tel" id="phone" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                        <textarea id="message" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="I'd like to know more about this property..."></textarea>
                                    </div>
                                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition-colors">
                                        Contact Agent
                                    </button>
                                </form>
                                
                                <div class="mt-5 text-center">
                                    <p class="text-gray-500 text-sm">Or call directly:</p>
                                    <a href="tel:+14085551234" class="text-indigo-600 font-medium">(408) 555-1234</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Similar Properties Section -->
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Similar Properties</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Similar Property Card 1 -->
                        <div class="property-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <a href="/property/4" class="block">
                                <div class="relative overflow-hidden h-48">
                                    <div class="absolute inset-0 card-overlay bg-black opacity-0 transition-opacity z-10"></div>
                                    <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                                         alt="Modern Oceanview Condo" 
                                         class="card-img w-full h-full object-cover transition-transform duration-500">
                                    <div class="absolute bottom-2 left-2 z-20">
                                        <span class="bg-indigo-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">Condo</span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-gray-800">Modern Oceanview Condo</h3>
                                        <p class="text-indigo-600 font-bold">$850,000</p>
                                    </div>
                                    <p class="text-gray-600 text-sm mt-1">Marina District</p>
                                    <p class="text-gray-600 mt-3 text-sm line-clamp-2">Stunning condo with panoramic ocean views and modern amenities in a prime location.</p>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Similar Property Card 2 -->
                        <div class="property-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <a href="/property/5" class="block">
                                <div class="relative overflow-hidden h-48">
                                    <div class="absolute inset-0 card-overlay bg-black opacity-0 transition-opacity z-10"></div>
                                    <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                                         alt="Luxury Waterfront Estate" 
                                         class="card-img w-full h-full object-cover transition-transform duration-500">
                                    <div class="absolute bottom-2 left-2 z-20">
                                        <span class="bg-amber-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">Estate</span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-gray-800">Luxury Waterfront Estate</h3>
                                        <p class="text-indigo-600 font-bold">$2,500,000</p>
                                    </div>
                                    <p class="text-gray-600 text-sm mt-1">Harbor Point</p>
                                    <p class="text-gray-600 mt-3 text-sm line-clamp-2">Exquisite estate with private dock, tennis court, and panoramic water views.</p>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Similar Property Card 3 -->
                        <div class="property-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                            <a href="/property/6" class="block">
                                <div class="relative overflow-hidden h-48">
                                    <div class="absolute inset-0 card-overlay bg-black opacity-0 transition-opacity z-10"></div>
                                    <img src="https://images.unsplash.com/photo-1488590528505-98d2b5aba04b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                                         alt="Beach Cottage" 
                                         class="card-img w-full h-full object-cover transition-transform duration-500">
                                    <div class="absolute bottom-2 left-2 z-20">
                                        <span class="bg-green-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full">Cottage</span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-start">
                                        <h3 class="text-lg font-semibold text-gray-800">Charming Beach Cottage</h3>
                                        <p class="text-indigo-600 font-bold">$675,000</p>
                                    </div>
                                    <p class="text-gray-600 text-sm mt-1">Sandy Cove</p>
                                    <p class="text-gray-600 mt-3 text-sm line-clamp-2">Quaint cottage just steps from the beach with charming details and modern updates.</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        
        <!-- Lightbox for Image Gallery -->
        <div x-show="showLightbox" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="lightbox"
             @click.self="closeLightbox"
             x-cloak>
            <div class="lightbox-content">
                <img :src="images[currentImage]" alt="Property image" class="rounded shadow-xl">
                <button class="lightbox-close" @click="closeLightbox">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <button class="lightbox-prev" @click.stop="prevImage">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button class="lightbox-next" @click.stop="nextImage">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div class="absolute bottom-5 left-0 right-0 text-center text-white text-sm">
                    Image <span x-text="currentImage + 1"></span> of <span x-text="images.length"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
