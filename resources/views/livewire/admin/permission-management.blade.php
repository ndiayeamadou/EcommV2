<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700/30 transition-colors duration-300">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Permission Management</h2>

    <!-- Create Permission Form -->
    <div class="mb-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-md transition-colors duration-300">
        <h3 class="text-lg font-medium mb-4 text-gray-700 dark:text-gray-200">Create New Permission</h3>
        <form wire:submit.prevent="createPermission" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Permission Name</label>
                <input
                    type="text"
                    wire:model="name"
                    class="w-full px-4 py-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 transition-colors duration-300"
                    placeholder="e.g., users.create"
                />
                @error('name') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Group</label>
                <select
                    wire:model="group"
                    class="w-full px-4 py-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 transition-colors duration-300"
                >
                    @foreach($groups as $groupOption)
                        <option value="{{ $groupOption }}">{{ ucfirst($groupOption) }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (Optional)</label>
                <textarea
                    wire:model="description"
                    class="w-full px-4 py-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 transition-colors duration-300"
                    rows="2"
                    placeholder="Describe what this permission allows"
                ></textarea>
            </div>
            
            <button
                type="submit"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-300"
            >
                Create Permission
            </button>
        </form>
    </div>

    <!-- Permissions By Group -->
    <div class="space-y-6">
        @foreach($groupedPermissions as $group => $permissions)
            <div class="border dark:border-gray-600 rounded-md overflow-hidden transition-colors duration-300">
                <div class="bg-gray-100 dark:bg-gray-700 px-4 py-2 font-medium text-gray-800 dark:text-gray-200">
                    {{ ucfirst($group) }}
                </div>
                <ul class="divide-y dark:divide-gray-700 bg-white dark:bg-gray-800">
                    @foreach($permissions as $permission)
                        <li class="px-4 py-3 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-300">
                            <div>
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $permission->name }}</span>
                                @if(property_exists($permission, 'description') && $permission->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $permission->description }}</p>
                                @endif
                            </div>
                            <button
                                wire:click="deletePermission({{ $permission->id }})"
                                class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors duration-300"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-md transition-colors duration-300">
            {{ session('message') }}
        </div>
    @endif
</div>
