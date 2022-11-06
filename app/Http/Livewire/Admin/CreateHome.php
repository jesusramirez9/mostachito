<?php

namespace App\Http\Livewire\Admin;

use App\Models\Home;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateHome extends Component
{
    use WithFileUploads; // para las imagenes

    public $image, $identificador, $identificador2, $identificador3, $identificador4, $identificador5;
    public $image2, $image3, $image4;
    public $filepdf;
    public $url_yt;
    public $open = false;
    public $price;
    public $post;
    public $title;

    public $content;

    protected $rules = [
        'url_yt' => '',
        'filepdf' => 'mimes:pdf',
        'image' => 'image|max:2048',
        'image2' => 'image|max:2048',
        'image3' => 'image|max:2048',
        'image4' => 'image|max:2048'
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
       $filepdf = $this->filepdf->store('homes');
       $image = $this->image->store('homes');
       $image2 = $this->image2->store('homes');
       $image3 = $this->image3->store('homes');
       $image4 = $this->image4->store('homes');
    //    $data2 = [
    //     'title' => $this->title,
    //     'content' => $this->content,
    //     'image' => $image,
    //    ];
     
       $data = Home::create([
            'url_yt' => $this->url_yt,
            'filepdf' => $filepdf,
            'image' => $image,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
        ]);

      
         session()->flash('flash.banner', 'Se creo con exito');
         session()->flash('flash.bannerStyle','success');   

        $this->reset(['open','url_yt','filepdf','image','image2','image3','image4']);
        $this->identificador = rand();
        $this->identificador2 = rand();
        $this->identificador3 = rand();
        $this->identificador4 = rand();
        $this->identificador5 = rand();

        $this->emitTo('admin.show-home','render');
        $this->emit('alert', 'Se creó satisfactoriamente');
    }
  
    public function updatingOpen()
    {
        if($this->open == false){
            $this->reset(['url_yt','filepdf','image','image2','image3','image4']);
            $this->identificador = rand(); 
        $this->identificador2 = rand();
        $this->identificador3 = rand();
        $this->identificador4 = rand();
        $this->identificador5 = rand();
            $this->emit('resetCKEditor');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.create-home');
    }
}
