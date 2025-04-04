<?php

namespace App\Livewire\PostActions;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class PostIndex extends Component
{
    public function delete ($id)
    {
        $post = Post::findOrFail($id);
        Storage::disk('public')->delete($post->image);
        $post->delete();
        session()->flash('success', 'Poste supprimé avec succès!');
    }

    public function cleanSession ()
    {
        session()->forget('success');
    }

    public function render()
    {
        return view('livewire.post-actions.post-index',[
            //'posts' => Post::all()
            'posts' => auth()->user()->posts()->latest()->get()
        ]);
    }
}
