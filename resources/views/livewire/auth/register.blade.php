<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Nom complet')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Nom complet')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Mot de passe')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Mot de passe')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirmation mot de passe')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirmation mot de passe')"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Créer un compte') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Vous avez déjà un compte?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Se connecter') }}</flux:link>
    </div>
</div>
