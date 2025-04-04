<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Role & Permission Management</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('roles') }}" wire:navigate.hover class="p-6 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Role Management</h3>
                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-100 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $roleCount }}</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">Create, edit, and manage roles in your application.</p>
                </a>
                
                <a href="{{ route('permissions') }}" wire:navigate class="p-6 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Permission Management</h3>
                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-100 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $permissionCount }}</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">Define and organize permissions for various actions.</p>
                </a>
                
                <a href="{{ route('user-roles') }}" wire:navigate class="p-6 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start">
                        <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">User Role Assignment</h3>
                        <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-100 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $userCount }}</span>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">Assign roles to users and manage their permissions.</p>
                </a>
            </div>
        </div>
    </div>
</div>