<div>
    
    <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
    <flux:subheading size="lg" class="mb-6">{{ __('Manage all your users') }}</flux:subheading>
    <flux:separator variant="subtle" class="mb-3" />

    <div class="flex justify-end mr-0 py-3">
        {{-- <a href="user-create" wire:navigate.hover class="text-indigo-500 hover:text-indigo-700">Create</a> --}}
        <flux:button
            href="user-create" icon-trailing="plus" class="bg-blue-600! text-white! hover:bg-blue-700!"
        >
            Create
        </flux:button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nom
                    </th>
                    {{-- <th scope="col" class="px-6 py-3">
                        Image
                    </th> --}}
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Login At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Last Login IP
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center">
                            @if ($user->isSuspended())<flux:icon.x-circle variant="micro" class="text-red-600" />
                            @else <flux:icon.check variant="micro" class="text-green-600" /> @endif
                            {{ $user->name }}
                        </div>
                    </th>
                    {{-- <td class="px-6 py-4">
                        <img src="{{ asset('storage/'.$user->image) }}" alt="image" class="w-12 h-12 rounded-2xl" />
                    </td> --}}
                    <td class="px-6 py-4">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($user->last_login_at)->format('d-m-Y H:i:s') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->last_login_ip }}
                    </td>
                    <td class="px-6 py-4 space-x-2">
                        {{-- <a href="{{ route('user.edit', $user->id) }}" wire:navigate.hover class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</a>
                        <button wire:click="delete({{ $user->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</button>
                         --}}
                        <div class="flex items-center space-x-3">
                        {{-- <flux:button
                            href="https://google.com" size="xs"
                            icon-trailing="arrow-up-right"
                        >
                            Visit Google
                        </flux:button> --}}
                        @if ($user->isSuspended())
                        <flux:button wire:click="suspend({{ $user->id }})" size="xs" class="cursor-pointer text-white! bg-green-800! hover:bg-green-700!" icon="check">Rétablir</flux:button>
                            {{-- <button wire:click="unsuspend({{ $user->id }})" class="font-medium text-green-600 dark:text-green-500 hover:underline">Rétablir</button> --}}
                        @else
                            <flux:button wire:click="suspend({{ $user->id }})" size="xs" class="cursor-pointer" variant="danger" icon="x-circle">Suspendre</flux:button>
                            {{-- <button wire:click="suspend({{ $user->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                            <flux:icon.x-circle/>Suspendre</button> --}}
                        @endif
                        {{-- @if (empty($user->suspended_at))
                            <button wire:click="suspend({{ $user->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">Suspendre</button>
                        @else
                            <button wire:click="unsuspend({{ $user->id }})" class="font-medium text-red-600 dark:text-red-500 hover:underline">Rétablir</button>
                        @endif --}}
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="w-full">
                    <td colspan="4" class="text-orange-400 flex-1 items-center">
                        <p class="flex justify-center content-center p-4">
                            <img src="{{ asset('no_data.svg') }}" alt="" class="w-20">
                            <div class="flex justify-center content-center p-4">Aucun utilisateur enregistré.</div>
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>



    {{-- Toast --}}
    @if (session()->has('success'))
    <div
        x-data=""
        x-init="setTimeout(() => {$wire.cleanSession()}, 2000)"
        id="toast-top-right"
        class="fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow-sm top-5 right-5 dark:text-gray-400 dark:divide-gray-700 dark:bg-gray-800" role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
        <button wire:click="cleanSesssion()" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
    @endif

</div>
