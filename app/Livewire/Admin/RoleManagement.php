<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManagement extends Component
{
    public $roles;
    public $name;
    public $selectedRole = null;
    public $permissions = [];
    public $rolePermissions = [];

    public function mount()
    {
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function render()
    {
        return view('livewire.admin.role-management');
    }

    public function createRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::create(['name' => $this->name]);
        $this->name = '';
        $this->roles = Role::all();
        session()->flash('message', 'Role created successfully!');
    }

    public function selectRole($roleId)
    {
        $this->selectedRole = Role::find($roleId);
        $this->rolePermissions = $this->selectedRole->permissions->pluck('name')->toArray();
    }

    public function updateRolePermissions()
    {
        if ($this->selectedRole) {
            $this->selectedRole->syncPermissions($this->rolePermissions);
            session()->flash('message', 'Role permissions updated successfully!');
        }
    }

    public function deleteRole($roleId)
    {
        Role::find($roleId)->delete();
        $this->roles = Role::all();
        $this->selectedRole = null;
        session()->flash('message', 'Role deleted successfully!');
    }
}
