<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>


{{-- switching the sidebar layout the header layout --}}
{{--
rf doc :
https://laravel.com/docs/12.x/starter-kits
--}}

{{-- <x-layouts.app.header :title="$title ?? null">
    <flux:main container>
        {{ $slot }}
    </flux:main>
</x-layouts.app.header>
 --}}