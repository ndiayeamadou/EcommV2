<?php

namespace App\Livewire\TaskActions;

use App\Models\Task;
use Carbon\Carbon;
use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\On;

class TaskEdit extends Component
{
    public $title, $deadline, $description, $status, $taskId;

    public function render()
    {
        return view('livewire.task-actions.task-edit');
    }

    #[On('editTask')]
    public function editTask($id)
    {
        //dd('task');
        //$task = Task::whereId($id)->first();
        $task = Task::find($id);
        $this->taskId = $task->id;
        $this->title = $task->title;
        $this->description = $task->description;
        //$this->deadline = $task->deadline;
        $this->deadline = Carbon::parse($task->deadline)->format('Y-m-d');
        //dd($this->deadline);
        $this->status = $task->status;
        Flux::modal('edit-task')->show();
    }

    function update() {
        $this->validate([
            'title'     => 'required|min:2|max:255',
            'deadline'  => 'required|date|after_or_equal:today',
            'description' => 'nullable|min:2'
        ]);
        Task::whereId($this->taskId)->update([
            'title' => $this->title,
            'deadline' => $this->deadline.' 23:59:59',//.now()->format('H:i'),
            'description' => $this->description,
            'user_id'   => auth()->user()->id,
        ]);
        Flux::modal('edit-task')->close();
        $this->dispatch('reloadTasks');

    }

    #[On('deleteTask')]
    function delete($id) {
        Flux::modal('delete-task')->show();
        $this->taskId = $id;
    }

    function removeTask() {
        $task = Task::find($this->taskId);
        $task->delete();
        $this->dispatch('reloadTasks');
        Flux::modal('delete-task')->close();
    }
}
