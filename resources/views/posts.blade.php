<x-layouts.app :title="__('Posts')">
    <flux:heading size="xl" level="1">{{ __('Posts') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage all your posts') }}</flux:subheading>
    <flux:separator variant="subtle" />

    
        @livewire('post-actions\post-index')
</x-layouts.app>
