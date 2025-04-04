<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-6">User Role Assignment</h2>
    
    <!-- Search & User List -->
    <div class="mb-6">
        <div class="mb-4">
            <input
                type="text"
                wire:model.debounce.300ms="search"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                placeholder="Search users by name or email..."
            />
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Roles</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="{{ $selectedUser && $selectedUser->id === $user->id ? 'bg-green-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($user->roles as $role)
                                        <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button
                                    wire:click="selectUser({{ $user->id }})"
                                    class="text-green-600 hover:text-green-900"
                                >
                                    Manage Roles
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
    
    <!-- User Role Management -->
    @if($selectedUser)
        <div class="border rounded-md p-4">
            <h3 class="text-lg font-medium mb-4">Manage Roles for {{ $selectedUser->name }}</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                @foreach($roles as $role)
                    <label class="flex items-center p-2 border rounded-md">
                        <input
                            type="checkbox"
                            wire:model="userRoles"
                            value="{{ $role->id }}"
                            class="mr-2 rounded text-green-600 focus:ring-green-500"
                        />
                        <span>{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
            
            <button
                wire:click="updateUserRoles"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Update User Roles
            </button>
        </div>
    @endif
    
    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('message') }}
        </div>
    @endif
</div>
