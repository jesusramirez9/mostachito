<?php

namespace App\Http\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateService extends Component
{
    use WithFileUploads; // para las imagenes

    public $image, $identificador;

    public $open = false;
    public $price;
    public $post;
    public $title;

    public $content;

    protected $rules = [
        'title' => '',
        'content' => '',
        'price' => '',
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

       $image = $this->image->store('services');
    //    $data2 = [
    //     'title' => $this->title,
    //     'content' => $this->content,
    //     'image' => $image,
    //    ];
     
       $data = Service::create([
            'title' => $this->title,
            'content' => $this->content,
            'price' => $this->price,
            'image' => $image,
        ]);

      
         session()->flash('flash.banner', 'El articulo se creo con exito');
         session()->flash('flash.bannerStyle','success');   

        $this->reset(['open','title','content','price','image']);
        $this->identificador = rand();

        $this->emitTo('admin.show-service','render');
        $this->emit('alert', 'El servicio se creó satisfactoriamente');
    }
  
    public function updatingOpen()
    {
        if($this->open == false){
            $this->reset(['title','content','price','image']);
            $this->identificador = rand();
            $this->emit('resetCKEditor');
        }
    }
    
    public function render()
    {
        return view('livewire.admin.create-service');
    }
}
