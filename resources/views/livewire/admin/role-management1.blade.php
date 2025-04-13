<!-- Adapted in Dark Mode -->
<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700/30 transition-colors duration-300">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Role Management</h2>

    <!-- Create Role Form -->
    <div class="mb-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-md transition-colors duration-300">
        <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-gray-200">Create New Role</h3>
        <form wire:submit.prevent="createRole" class="flex gap-4">
            <div class="flex-1">
                <input
                    type="text"
                    wire:model="name"
                    class="w-full px-4 py-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 transition-colors duration-300"
                    placeholder="Role name"
                />
                @error('name') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <button
                type="submit"
                class="px-4 py-2 bg-green-600 dark:bg-green-700 text-white rounded-md hover:bg-green-700 dark:hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-300"
            >
                Create Role
            </button>
        </form>
    </div>

    <!-- Roles List -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        @foreach($roles as $role)
            <div
                class="p-4 border dark:border-gray-600 rounded-md cursor-pointer transition-all hover:shadow-md dark:hover:shadow-gray-700/50 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 
                {{ $selectedRole && $selectedRole->id === $role->id ? 'border-green-500 dark:border-green-400 bg-green-50 dark:bg-green-900/20' : '' }}"
                wire:click="selectRole({{ $role->id }})"
            >
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">{{ $role->name }}</h3>
                    <button
                        wire:click.stop="deleteRole({{ $role->id }})"
                        class="text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors duration-300"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ $role->permissions->count() }} permissions assigned
                </div>
            </div>
        @endforeach
    </div>

    <!-- Role Permissions -->
    @if($selectedRole)
        <div class="border dark:border-gray-600 rounded-md p-4 bg-white dark:bg-gray-800 transition-colors duration-300">
            <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-gray-200">Permissions for {{ $selectedRole->name }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                @foreach($permissions as $permission)
                    <label class="flex items-center p-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-300 cursor-pointer">
                        <input
                            type="checkbox"
                            wire:model="rolePermissions"
                            value="{{ $permission->name }}"
                            class="mr-2 rounded text-green-600 dark:text-green-500 focus:ring-green-500 dark:focus:ring-green-400 bg-white dark:bg-gray-600"
                        />
                        <span class="text-gray-800 dark:text-gray-200">{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>
            <button
                wire:click="updateRolePermissions"
                class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-300"
            >
                Update Permissions
            </button>
        </div>
    @endif

    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-md transition-colors duration-300">
            {{ session('message') }}
        </div>
    @endif
</div>
