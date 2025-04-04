<?php

namespace App\Livewire\PostActions;

use App\Livewire\Forms\PostActions\PostForm;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;
    public PostForm $form;

    public function mount (Post $post)
    {
        $this->form->setPost($post);
    }

    public function update()
    {
        $this->form->update();
        session()->flash('success', 'Poste modifié avec succès!');
        return redirect()->to('/posts');
        //return $this->redirect('/posts', navigate: true);
    }

    public function render()
    {
        return view('livewire.post-actions.post-edit');
    }
}
