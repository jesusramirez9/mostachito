<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads; // para las imagenes

    public $image, $identificador;
    public $post;
    public $open = false;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];  
  
    public function mount(Post $post){
        $this->post = $post;
        $this->identificador = rand();

    }

    public function render()
    {
        return view('livewire.edit-post');
    }

    public function save(){
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }

        $this->post->save();

        $this->reset(['open','image']);

        $this->identificador = rand();
        $this->emitTo('show-posts','render');
        $this->emit('alert', 'El post se actualizo satisfactoriamente');
    }
}
