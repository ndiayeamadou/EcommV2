<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashbRolesPerms extends Component
{
    public $roleCount;
    public $permissionCount;
    public $userCount;
    
    public function mount()
    {
        $this->refreshCounts();
    }
    
    public function refreshCounts()
    {
        $this->roleCount = Role::count();
        $this->permissionCount = Permission::count();
        $this->userCount = User::count();
    }

    public function render()
    {
        return view('livewire.admin.dashb-roles-perms');
    }
}
