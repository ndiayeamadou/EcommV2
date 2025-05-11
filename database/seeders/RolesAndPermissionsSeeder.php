<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        // Create permissions for products
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        
        // Create permissions for categories
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);
        
        // Create permissions for orders
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'edit orders']);
        Permission::create(['name' => 'delete orders']);
        
        // Create permissions for customers
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'edit customers']);
        Permission::create(['name' => 'delete customers']);
        
        // Create permissions for users
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        
        // Create permissions for reports
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'export reports']);
        
        // Create roles and assign created permissions
        $customerRole = Role::create(['name' => 'customer']);
        
        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'view products', 'create products', 'edit products',
            'view categories', 'create categories', 'edit categories',
            'view orders', 'edit orders',
            'view customers', 'edit customers',
            'view reports'
        ]);
        
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
        
        // Create admin user
        $admin = User::create([
            'name' => 'AdminElan',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        $admin2 = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        $admin2->assignRole('admin');
        
        // Create manager user
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('password')
        ]);
        $manager->assignRole('manager');
    }
}
