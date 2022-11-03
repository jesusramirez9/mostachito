<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads; // para las imagenes

    public $image, $identificador;

    public $open = false;

    public $post;
    public $title;

    public $content;

    protected $rules = [
        'title' => '',
        'content' => '',
        'image' => 'image|max:2048'
    ];

    // public function updated($propertyName){

    //     $this->validateOnly($propertyName);
    //     //cada ves que modifiquemos el valor de una propiedad se va aejecutar este mettodo y va verificar
    // }

    public function mount(){
        $this->identificador = rand();
    }

    public function save(){

        $this->validate();

       $image = $this->image->store('posts');
    //    $data2 = [
    //     'title' => $this->title,
    //     'content' => $this->content,
    //     'image' => $image,
    //    ];
     
       $data = Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image,
        ]);

        $re_extracting = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($re_extracting, $data['content'], $matches);
        $images1 = $matches[1];

        foreach ($images1 as $image1) {
          $image_url = 'images/'. pathinfo($image1, PATHINFO_BASENAME);
            Image::create([
               
                'image_url' => $image_url,
                'post_id' => $data->id
            ]);
            
        }

         session()->flash('flash.banner', 'El articulo se creo con exito');
         session()->flash('flash.bannerStyle','success');   

        $this->reset(['open','title','content', 'image']);
        $this->identificador = rand();

        $this->emitTo('show-posts','render');
        $this->emit('alert', 'El post se creó satisfactoriamente');
    }
    public function render()
    {
        return view('livewire.create-post');
    }
    public function updatingOpen()
    {
        if($this->open == false){
            $this->reset(['title','content','image']);
            $this->identificador = rand();
            $this->emit('resetCKEditor');
        }
    }
    

}
