<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout heading="Mettre à jour le mot de passe" subheading="Ensure your account is using a long, random password to stay secure">
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                label="Current password"
                type="password"
                required
                autocomplete="current-password"
            />
            <flux:input
                wire:model="password"
                label="New password"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                label="Confirm Password"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">Sauvegarder</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    Sauvegardé.
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
