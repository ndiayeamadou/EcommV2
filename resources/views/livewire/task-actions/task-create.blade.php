<div>

    {{-- <flux:modal.trigger name="create-task">
        <flux:button class="">Créer une tâche</flux:button>
    </flux:modal.trigger> --}}
    
    <flux:modal name="create-task" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Création de tâche</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
    
            <flux:input wire:model="title" label="Title" placeholder="Task title..." />
    
            <flux:input wire:model="deadline" label="Deadline" type="date" />

            <flux:textarea wire:model="description" label="Description" placeholder="Description..." />
    
            <div class="flex">
                <flux:spacer />
    
                <flux:button type="submit" variant="primary" wire:click="store">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
