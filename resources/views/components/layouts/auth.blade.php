<x-layouts.auth.simple :title="$title ?? null">
    {{ $slot }}
</x-layouts.auth.simple>

{{--
rf doc :
https://laravel.com/docs/12.x/starter-kits
--}}

{{-- <x-layouts.auth.split :title="$title ?? null">
    {{ $slot }}
</x-layouts.auth.split>
 --}}

{{-- 
Authentication Page Layout Variants
The authentication pages included with the Livewire starter kit, such as the login page and registration page,
also offer three different layout variants: "simple", "card", and "split".
--}}