<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>Suppression du compte</flux:heading>
        <flux:subheading>Supprimer le compte et toutes ses ressources</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            Supprimer le compte
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">Êtes-vous sûr de vouloir supprimer votre compte?</flux:heading>

                <flux:subheading>
                    Une fois votre compte supprimé, toutes ses ressoucres et données seront permanemment supprimées. Veuillez saisir votre mot de passe pour confirmer que vous voulez supprimer votre compte de façon permanente.
                    {{-- {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }} --}}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" label="Mot de passe" type="password" />

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="filled">Annuler</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">Supprimer le compte</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
