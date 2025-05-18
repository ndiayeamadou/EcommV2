<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <!-- CSS alertifyjs -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>

    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                <x-app-logo />
                {{-- ELAN CODEUR --}}
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('messages.dashboard') }}</flux:navlist.item>
                    <flux:navlist.item icon="book-open-text" :href="route('admin.categories')" :current="request()->routeIs('admin.categories')" wire:navigate>{{ __('messages.categories') }}</flux:navlist.item>
                    <flux:navlist.item icon="book-open-text" :href="route('admin.products')" :current="request()->routeIs('admin.products')" wire:navigate>{{ __('messages.products') }}</flux:navlist.item>
                    <flux:navlist.item icon="book-open-text" :href="route('posts.index')" :current="request()->routeIs('posts.index')" wire:navigate>{{ __('Postes') }}</flux:navlist.item>
                    <flux:navlist.item icon="book-open-text" :href="route('tasks')" :current="request()->routeIs('tasks')" wire:navigate>{{ __('Tâches') }}</flux:navlist.item>
                    <flux:navlist.item icon="book-open-text" :href="route('admin.posales')" :current="request()->routeIs('admin.posales')" wire:navigate>{{ __('messages.posales') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="users" :href="route('users')" :current="request()->routeIs('users')" wire:navigate>
                {{-- {{ __('Users') }} --}}
                @lang('messages.users')
                </flux:navlist.item>

                <flux:navlist.item icon="folder-git-2" :href="route('admindashboard')" :current="request()->routeIs('admindashboard')" wire:navigate>
                {{ __('Roles') }}
                </flux:navlist.item>

                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank">
                {{ __('Documentation') }}
                </flux:navlist.item>

                <div class="language-switcher">
                    <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
                    <a href="{{ route('language.switch', 'fr') }}" class="{{ app()->getLocale() == 'fr' ? 'active' : '' }}">FR</a>
                </div>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>Paramètres</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            Déconnexion
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>Paramètres</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            Déconnexion
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}


        <!-- JavaScript Alertifyjs -->
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                window.addEventListener('notify', event => {
                    //console.log('Received notification event:', event.detail[0].text);
                    alertify.set('notifier','position', event.detail[0].position || 'top-right');
                    alertify.notify(event.detail[0].text, event.detail[0].type || 'success');
                });
            });
        </script>
        {{-- OR --}}
        {{-- <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('notify', (data) => {
                    alertify.set('notifier','position', data.position || 'top-right');
                    alertify.notify(data.text, data.type || 'success');
                });
            });
        </script> --}}

        {{-- let code script in other extended pages - using at first section('scripts') --}}
        {{-- @yield('scripts') --}}


        @fluxScripts
    </body>
</html>
