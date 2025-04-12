<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class UserManagement extends Component
{
    public function suspend($user_id)
    {
        $user = User::find($user_id);

        if($user->isSuspended()) {
            $user->unsuspendUser();   /* func created in User mdl */
            session()->flash("success", "User unsuspended.");
        } else {
            $user->suspendUser(); /* func created in User mdl */
            session()->flash("success", "User suspended.");
        }
    }

    public function cleanSession ()
    {
        session()->forget('success');
    }

    public function render()
    {
        return view('livewire.admin.user-management', [
            'users' => User::paginate(10)
        ]);
    }
}
