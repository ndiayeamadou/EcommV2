<?php

namespace App\Livewire\Forms\PostActions;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post; /* for the update method - ? = optional */

    public $title = ''; public $image; public $content = '';

    public function store()
    {
        $data = $this->validate([
            'title'     =>  'required',
            'content'   =>  'required',
            'image'     =>  'required|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $data['slug'] = str()->slug($data['title']);

        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        auth()->user()->posts()->create($data);

        $this->reset();
    }

    /* update func */
    public function setPost(Post $post)
    {
        //dd($post);
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function update()
    {
        $data = $this->validate([
            'title'     =>  'required',
            'content'   =>  'required',
            'image'     =>  'required|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        $data['slug'] = str()->slug($data['title']);

        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        auth()->user()->posts()->create($data);

        $this->reset();
    }
}
