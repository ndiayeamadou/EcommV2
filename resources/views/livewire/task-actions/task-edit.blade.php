<div>
    
    <flux:modal name="edit-task" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edition de la tâche</flux:heading>
                <flux:text class="mt-2">Make changes to your personal details.</flux:text>
            </div>
    
            <flux:input wire:model="title" label="Title" placeholder="Task title..." />
    
            <flux:input wire:model="deadline" label="Deadline" type="date" />

            <flux:textarea wire:model="description" label="Description" placeholder="Description..." />
    
            <div class="flex">
                <flux:spacer />
    
                <flux:button type="submit" variant="primary" wire:click="update">Mettre à jour</flux:button>
            </div>
        </div>
    </flux:modal>



    {{-- <flux:modal.trigger name="delete-task">
        <flux:button variant="danger">Delete</flux:button>
    </flux:modal.trigger> --}}

    <flux:modal name="delete-task" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Supprimer cette tâche?</flux:heading>

                <flux:text class="mt-2">
                    <p>Vous êtes sur le point de supprimer la tâche.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Annuler</flux:button>
                </flux:modal.close>

                <flux:button type="submit" wire:click="removeTask" variant="danger">Oui, Supprimer</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
