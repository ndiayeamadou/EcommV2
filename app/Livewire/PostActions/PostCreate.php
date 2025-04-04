<?php

namespace App\Livewire\PostActions;

use App\Livewire\Forms\PostActions\PostForm;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreate extends Component
{
    use WithFileUploads;
    public PostForm $form;

    public function store()
    {
        $this->form->store();
        session()->flash('success', 'Poste ajouté avec succès!');
        return redirect()->to('/posts');
    }

    public function render()
    {
        return view('livewire.post-actions.post-create');
    }
}
