<?php

namespace App\Http\Livewire\Admin;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowService extends Component
{
    use WithPagination;
    use WithFileUploads; 
    public $image, $identificador;
    public $service;
    public $open_edit =false;
    public $post;
    public $price;
    public $search = '';
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
        'service.title' => 'required',
        'service.content' => 'required',
        'service.price' => 'required',
    ];  
  
    public function mount(){
        $this->identificador = rand();
        $this->service = new Service();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    //renderiza el contenido
    public function render()
    {
        if ($this->readyToLoad) {
           $services = Service::where('title', 'like', '%'.$this->search.'%')
                       ->orWhere('content', 'like', '%'.$this->search.'%')
                       ->orWhere('price','like','%'.$this->price.'%')
                       ->orderBy($this->sort, $this->direction)
                       ->paginate($this->cant);
        }else{
            $services = [];
        }

        
        return view('livewire.admin.show-service', compact('services'));
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

    public function edit(Service $service){
        $this->service = $service;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();
        
        if ($this->image) {
            Storage::delete([$this->service->image]);
            $this->service->image = $this->image->store('services');
        }

        $this->service->save();

        $this->reset(['open_edit','image']);

        $this->identificador = rand();
        $this->emit('alert', 'El servicio se actualizo satisfactoriamente');
    }

    public function delete(Service $service){
        $service->delete();
    }

    
}
