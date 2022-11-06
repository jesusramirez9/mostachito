<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slide;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateSlide extends Component
{
    use WithFileUploads; // para las imagenes

    public $image,  $identificador2, $identificador3, $identificador4, $identificador5;
    public $image2, $image3, $image4;
    public $open = false;
    public $title;
    public $content;

    protected $rules = [
        'title' => '',
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
       $image = $this->image->store('slides');
       $image2 = $this->image2->store('slides');
       $image3 = $this->image3->store('slides');
       $image4 = $this->image4->store('slides');
    //    $data2 = [
    //     'title' => $this->title,
    //     'content' => $this->content,
    //     'image' => $image,
    //    ];
     
       $data = Slide::create([
            'title' => $this->title,
            'image' => $image,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
        ]);

      
         session()->flash('flash.banner', 'Se creo con exito');
         session()->flash('flash.bannerStyle','success');   

        $this->reset(['open','title','image','image2','image3','image4']);
       
        $this->identificador2 = rand();
        $this->identificador3 = rand();
        $this->identificador4 = rand();
        $this->identificador5 = rand();

        $this->emitTo('admin.show-slide','render');
        $this->emit('alert', 'Se creó satisfactoriamente');
    }
  
    public function updatingOpen()
    {
        if($this->open == false){
            $this->reset(['title','image','image2','image3','image4']);
        
        $this->identificador2 = rand();
        $this->identificador3 = rand();
        $this->identificador4 = rand();
        $this->identificador5 = rand();
            $this->emit('resetCKEditor');
        }
    }
    
   
    public function render()
    {
        return view('livewire.admin.create-slide');
    }
}
