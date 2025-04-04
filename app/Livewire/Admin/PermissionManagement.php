<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionManagement extends Component
{
    public $permissions;
    public $name;
    public $group = 'general';
    public $description = '';
    public $groups = ['general', 'users', 'content', 'settings'];

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function render()
    {
        $groupedPermissions = $this->permissions->groupBy(function ($permission) {
            // Extract group from permission name or use stored group if available
            if (property_exists($permission, 'group')) {
                return $permission->group;
            }
            
            $parts = explode('.', $permission->name);
            return count($parts) > 1 ? $parts[0] : 'general';
        });
        
        return view('livewire.admin.permission-management', [
            'groupedPermissions' => $groupedPermissions
        ]);
    }

    public function createPermission()
    {
        $this->validate([
            'name' => 'required|unique:permissions,name',
            'group' => 'required',
        ]);

        $permission = Permission::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);
        
        // Store additional metadata in custom field if your DB structure supports it
        // Or consider adding a 'group' column to the permissions table via migration
        
        $this->name = '';
        $this->description = '';
        $this->permissions = Permission::all();
        session()->flash('message', 'Permission created successfully!');
    }

    public function deletePermission($permissionId)
    {
        Permission::find($permissionId)->delete();
        $this->permissions = Permission::all();
        session()->flash('message', 'Permission deleted successfully!');
    }
}
