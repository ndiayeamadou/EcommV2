<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Mon tableau de bord</flux:heading>
        <flux:subheading size="lg" class="mb-6">Gérer votre profil et paramètres du compte</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Orders -->
        <div class="bg-cyan-50 dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                Total Commandes
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $totalOrders }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <a href="{{ route('admin.orders') }}" class="text-sm text-primary-600 hover:text-primary-900">
                    View all orders
                </a>
            </div>
        </div>

        <!-- Order in this day -->
        <div class="bg-red-50 dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-200 rounded-md p-3">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate" title="Commande(s) de ce jour">
                                Commande(s) de ce jour
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $todayOrder }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <a href="{{ route('admin.products') }}?stock=low" class="text-sm text-primary-600 hover:text-primary-900">
                    View low stock products
                </a>
            </div>
        </div>

        <!-- Orders this Month -->
        <div class="bg-cyan-50 dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate" title="Commandes de ce mois">
                                Commandes ce mois
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{ $thisMonthOrder }}
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <a href="{{ route('admin.orders') }}" class="text-sm text-primary-600 hover:text-primary-900">
                    View all orders
                </a>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="bg-red-50 dark:bg-gray-800 overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-200 rounded-md p-3">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate" title="Commandes en cours de validation">
                                Commandes en cours de validation
                            </dt>
                            <dd>
                                <div class="text-lg font-medium text-gray-900 dark:text-white">
                                    {{-- {{ $lowStockProducts }} --}}-
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                <a href="{{ route('admin.products') }}?stock=low" class="text-sm text-primary-600 hover:text-primary-900">
                    View low stock products
                </a>
            </div>
        </div>
    </div>

    {{-- 
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex justify-between gap-4 p-4">
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg text-center flex-1 min-w-[200px]">
                <h2 class="text-lg font-bold">Utilisateurs</h2>
                <p class="text-2xl font-semibold">120</p>
            </div>
        </div>
    </div>
    --}}

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        N° Cammande
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Délai
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $task)
                <tr class="bg-white dark:bg-gray-800">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{-- <span class="decoration-red-700 line-through decoration-1">{{ $task->title }}</span> --}}
                        @if($task->deadline >= now()->format('Y-m-d H'))
                            <span class="">{{ $task->title }}</span>
                        @else
                            <span class="decoration-red-700 line-through decoration-1">{{ $task->title }}</span>
                        @endif
                    </th>
                    <td class="px-6 py-4">
                        {{-- <span class="{{ $task->status == 1 ? 'text-red-600' : 'text-green-600' }}">{{ $task->status == 1 ? 'déja traité' : 'en cours...' }}</span> --}}
                        @if ($task->status == 0)
                            @if ($task->deadline >= now()->format('Y-m-d H'))
                                <span class="text-green-600">en attente</span>
                            @else
                                <span class="text-red-600">déja traité</span>
                            @endif
                        @else
                            <span class="text-orange-400">annulé</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="">{{ Carbon\Carbon::parse($task->deadline)->diffForHumans() }}</span>
                    </td>
                    <td class="px-6 py-4">
                        {{-- <a href="" wire:click="edit({task->id})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editer</a> --}}
                        {{-- doesn't work --}}
                        {{-- <flux:button {{ $task->status == 1 ? 'disabled' : '' }} size="sm" wire:click="edit({task->id})">Editer</flux:button> --}}
                        @can('tasks.edit')
                        @if ($task->status == 1)
                            <flux:button disabled size="xs">Editer</flux:button>
                        @elseif ($task->status == 0)
                            <flux:button size="xs" wire:click="edit({{$task->id}})">Editer</flux:button>
                            <flux:button size="xs" wire:click="delete({{$task->id}})" variant="danger">Supprimer</flux:button>
                        @endif
                        @endcan
                    </td>
                </tr>
                @empty
                <tr class="w-full">
                    <td colspan="4" class="text-orange-400 flex-1 items-center">
                        <p class="flex justify-center content-center p-4">
                            <img src="{{ asset('no_data.svg') }}" alt="" class="w-20">
                            <div class="flex justify-center content-center p-4">Aucune commande enregistrée.</div>
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
