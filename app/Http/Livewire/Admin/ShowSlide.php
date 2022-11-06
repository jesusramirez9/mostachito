<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slide;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowSlide extends Component
{
    use WithFileUploads; 
    public $image, $identificador, $identificador2, $identificador3, $identificador4, $identificador5;
    public $image2, $image3, $image4, $filepdf;
    public $open_edit =false;
    public $search = '';
    public $slide;
    public $title;
    public $sort = 'id';
    public $direction = 'desc';
    public $cant = '10';
    public $readyToLoad = false;
    protected $listeners = ['render' => 'render', 'delete'];

    protected $queryString=[
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    protected $rules = [
        'slide.title' => 'required',
    ];  
  
    public function mount(){
        $this->identificador = rand();
        $this->identificador2 = rand();
        $this->identificador3 = rand();
        $this->identificador4 = rand();
        $this->identificador5 = rand();
        $this->slide = new Slide();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    //renderiza el contenido
    public function render()
    {
        if ($this->readyToLoad) {
            $slides = Slide::where('title', 'like', '%'.$this->search.'%')
                        ->orderBy($this->sort, $this->direction)
                        ->paginate($this->cant);
         }else{
             $slides = [];
         }
        return view('livewire.admin.show-slide', compact('slides'));
    }

    public function loadPosts(){
        $this->readyToLoad = true;
    }

    public function order($sort){

        if ( $this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
            
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Slide $slide){
        $this->slide = $slide;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();
        
      
        if ($this->image) {
            Storage::delete([$this->slide->image]);
            $this->slide->image = $this->image->store('slides');
        }
        if ($this->image2) {
            Storage::delete([$this->slide->image2]);
            $this->slide->image2 = $this->image2->store('slides');
        }
        if ($this->image3) {
            Storage::delete([$this->slide->image3]);
            $this->slide->image3 = $this->image3->store('slides');
        }
        if ($this->image4) {
            Storage::delete([$this->slide->image4]);
            $this->slide->image4 = $this->image4->store('slides');
        }

        $this->slide->save();

        $this->reset(['open_edit', 'title','image','image2','image3','image4']);

        $this->identificador = rand();
        $this->emit('alert', 'Se actualizo satisfactoriamente');
    }

    public function delete(Slide $slide){
        $slide->delete();
    }

}
