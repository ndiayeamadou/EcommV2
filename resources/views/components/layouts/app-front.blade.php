<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Side Menu -->
        {{-- <livewire:frontend.partials.side-menu :currentLanguage="app()->getLocale()" /> --}}
        
        <!-- Header -->
        {{-- <livewire:layout.header /> --}}
        <livewire:frontend.partials.header />
        
        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        {{-- <livewire:layout.footer /> --}}
        <livewire:frontend.partials.footer />
    </div>
    
    <!-- Toast Notifications -->
    <div id="toast-container" 
        x-data="{ 
            notices: [],
            add(notice) {
                notice.id = Date.now();
                this.notices.push(notice);
                const timeout = setTimeout(() => {
                    this.remove(notice.id);
                }, notice.duration || 3000);
            },
            remove(id) {
                this.notices = this.notices.filter(notice => notice.id !== id);
            }
        }"
        @notify.window="add($event.detail)"
        class="fixed top-4 right-4 z-50 space-y-4"
        aria-live="assertive"
    >
        <template x-for="notice in notices" :key="notice.id">
            <div
                x-show="true"
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
                :class="{
                    'border-l-4 border-green-500': notice.type === 'success',
                    'border-l-4 border-blue-500': notice.type === 'info',
                    'border-l-4 border-red-500': notice.type === 'error',
                    'border-l-4 border-yellow-500': notice.type === 'warning'
                }"
            >
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <template x-if="notice.type === 'success'">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </template>
                            
                            <template x-if="notice.type === 'info'">
                                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </template>
                            
                            <template x-if="notice.type === 'warning'">
                                <svg class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </template>
                            
                            <template x-if="notice.type === 'error'">
                                <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </template>
                        </div>
                        
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="notice.title" class="text-sm font-medium text-gray-900"></p>
                            <p x-text="notice.message" class="mt-1 text-sm text-gray-500"></p>
                        </div>
                        
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="remove(notice.id)" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <span class="sr-only">Close</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
    
    @livewireScripts
</body>
</html>
