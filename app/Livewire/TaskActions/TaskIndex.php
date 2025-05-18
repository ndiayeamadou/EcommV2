<?php

namespace App\Livewire\TaskActions;

use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskIndex extends Component
{
    public $tasks;

    function mount() {
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.task-actions.task-index');
    }

    #[On('reloadTasks')]
    public function reloadTasks() {
        $this->tasks = Task::all();
    }

    public function edit($id) {
        //dd($id);
        $this->dispatch('editTask', $id);
        /* now create the name of this event in TaskEdit */
    }

    public function delete($id) {
        $this->dispatch('deleteTask', $id);
        $this->dispatch('notify', [
            'text' => 'Tâche supprimée avec succès!',
            'type' => 'success',
            'position' => 'top-right'
        ]);
    }

}
