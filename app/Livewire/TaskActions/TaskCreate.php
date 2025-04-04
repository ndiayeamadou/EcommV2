<?php

namespace App\Livewire\TaskActions;

use App\Models\Task;
use Flux\Flux;
use Livewire\Component;

class TaskCreate extends Component
{
    public $title, $deadline, $description;

    function store() {
        $this->validate([
            'title' => 'required|min:2|max:255',
            'deadline' => 'required|date|after_or_equal:today',
            'description' => 'nullable|min:2'
        ]);
        if ($this->deadline) {
            $this->deadline = $this->deadline. ' 23:59:59';
        }
        //dd($this->deadline);
        Task::create([
            'title' => $this->title,
            'deadline' => $this->deadline,//.now()->format('H:i'),
            'description' => $this->description,
            'user_id'   => auth()->user()->id,
        ]);
        $this->dispatch('reloadTasks'); // to parent - TaskIndex
        session()->flash('success', 'Tâche créée avec succès!');
        $this->resetForm();
        Flux::modal('create-task')->close();
    }

    public function resetForm()
    {
        $this->deadline = ""; $this->title = ""; $this->description = "";
    }

    public function render()
    {
        return view('livewire.task-actions.task-create');
    }
}
