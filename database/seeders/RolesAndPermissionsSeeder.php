<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User permissions
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            
            // Content permissions
            'content.view',
            'content.create',
            'content.edit',
            'content.delete',
            
            // Settings permissions
            'settings.view',
            'settings.edit',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        
        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo([
            'users.view',
            'content.view', 
            'content.create', 
            'content.edit',
        ]);
        
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo([
            'content.view',
        ]);
    }
    
}
