<x-layouts.app :title="__('Tasks')">
    <flux:heading size="xl" level="1">{{ __('Liste des tâches') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Gestion des tâches') }}</flux:subheading>
    <flux:separator variant="subtle" />

    
        @livewire('task-actions\task-index')
</x-layouts.app>
