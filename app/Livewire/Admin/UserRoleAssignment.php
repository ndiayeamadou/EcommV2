<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserRoleAssignment extends Component
{
    use WithPagination;
    
    public $search = '';
    public $selectedUser = null;
    public $roles = [];
    public $userRoles = [];
    
    public function mount()
    {
        $this->roles = Role::all();
    }
    
    public function render()
    {
        $users = User::where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->paginate(10);
            
        return view('livewire.admin.user-role-assignment', [
            'users' => $users
        ]);
    }
    
    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->userRoles = $this->selectedUser->roles->pluck('id')->toArray();
    }
    
    public function updateUserRoles()
    {
        if ($this->selectedUser) {
            $roles = Role::whereIn('id', $this->userRoles)->get();
            $this->selectedUser->syncRoles($roles);
            session()->flash('message', 'User roles updated successfully!');
        }
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
