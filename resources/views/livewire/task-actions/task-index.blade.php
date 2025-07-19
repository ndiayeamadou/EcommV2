<div>
    
    <div class="flex justify-end mr-6 py-3">
        {{-- the flux modal btn can be hear or in task-create blade file --}}
        <flux:modal.trigger name="create-task">
            <flux:button class="">Créer une tâche</flux:button>
        </flux:modal.trigger>

    {{-- move the modal, if u want, to this livewire component and call them --}}
    @livewire('task-actions\task-create')
    <livewire:task-actions.task-edit>
    </div>

    {{-- <button onclick="alertify.notify('Test message', 'error')">Test</button> --}}

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Titre
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
                @forelse ($tasks as $task)
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
                            <div class="flex justify-center content-center p-4">Aucune tâche enregistrée.</div>
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>
