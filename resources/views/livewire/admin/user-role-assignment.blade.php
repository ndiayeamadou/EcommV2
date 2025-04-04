<div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700/30 transition-colors duration-300">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">User Role Assignment</h2>
    
    <!-- Search & User List -->
    <div class="mb-6">
        <div class="mb-4">
            <input
                type="text"
                wire:model.debounce.300ms="search"
                class="w-full px-4 py-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-400 transition-colors duration-300"
                placeholder="Search users by name or email..."
            />
        </div>

        <div class="overflow-x-auto rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Current Roles</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                        <tr class="{{ $selectedUser && $selectedUser->id === $user->id ? 'bg-green-50 dark:bg-green-900/20' : '' }} hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($user->roles as $role)
                                        <span class="px-2 py-1 text-xs bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 rounded-full">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button
                                    wire:click="selectUser({{ $user->id }})"
                                    class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 transition-colors duration-200"
                                >
                                    Manage Roles
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 text-gray-800 dark:text-gray-200">
            {{ $users->links() }}
        </div>
    </div>
    
    <!-- User Role Management -->
    @if($selectedUser)
        <div class="border dark:border-gray-600 rounded-md p-4 bg-white dark:bg-gray-800 transition-colors duration-300">
            <h3 class="text-lg font-medium mb-4 text-gray-800 dark:text-gray-100">Manage Roles for {{ $selectedUser->name }}</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                @foreach($roles as $role)
                    <label class="flex items-center p-2 border dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 cursor-pointer">
                        <input
                            type="checkbox"
                            wire:model="userRoles"
                            value="{{ $role->id }}"
                            class="mr-2 rounded text-green-600 dark:text-green-500 focus:ring-green-500 dark:focus:ring-green-400 bg-white dark:bg-gray-600 transition-colors duration-200"
                        />
                        <span class="text-gray-800 dark:text-gray-200">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
            
            <button
                wire:click="updateUserRoles"
                class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors duration-300"
            >
                Update User Roles
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
