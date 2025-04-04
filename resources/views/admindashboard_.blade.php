<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 dark:text-white">Role & Permission Management</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('roles') }}" class="p-6 bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2 dark:text-white">Role Management</h3>
                        <p class="text-gray-600 dark:text-gray-300">Create, edit, and manage roles in your application.</p>
                    </a>
                    
                    <a href="{{ route('permissions') }}" class="p-6 bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2 dark:text-white">Permission Management</h3>
                        <p class="text-gray-600 dark:text-gray-300">Define and organize permissions for various actions.</p>
                    </a>
                    
                    <a href="{{ route('user-roles') }}" class="p-6 bg-white dark:bg-gray-700 border dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                        <h3 class="text-xl font-semibold mb-2 dark:text-white">User Role Assignment</h3>
                        <p class="text-gray-600 dark:text-gray-300">Assign roles to users and manage their permissions.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
