<?php

namespace App\Http\Livewire\Admin;

use App\Models\Home;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowHome extends Component
{
    use WithPagination;
    use WithFileUploads; 
    public $image, $identificador, $identificador2, $identificador3, $identificador4, $identificador5;
    public $image2, $image3, $image4, $filepdf;
    public $service;
    public $open_edit =false;
    public $post;
    public $home;
    public $url_yt;
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
        'home.url_yt' => 'required',
    ];  
  
    public function mount(){
        $this->identificador = rand();
        $this->home = new Home();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    //renderiza el contenido
    public function render()
    {
        if ($this->readyToLoad) {
           $homes = Home::where('url_yt', 'like', '%'.$this->search.'%')
                       ->orderBy($this->sort, $this->direction)
                       ->paginate($this->cant);
        }else{
            $homes = [];
        }

        
        return view('livewire.admin.show-home', compact('homes'));
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

    public function edit(Home $home){
        $this->home = $home;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();
        
        if ($this->filepdf) {
            Storage::delete([$this->home->filepdf]);
            $this->home->filepdf = $this->filepdf->store('homes');
        }
        if ($this->image) {
            Storage::delete([$this->home->image]);
            $this->home->image = $this->image->store('homes');
        }
        if ($this->image2) {
            Storage::delete([$this->home->image2]);
            $this->home->image2 = $this->image2->store('homes');
        }
        if ($this->image3) {
            Storage::delete([$this->home->image3]);
            $this->home->image3 = $this->image3->store('homes');
        }
        if ($this->image4) {
            Storage::delete([$this->home->image4]);
            $this->home->image4 = $this->image4->store('homes');
        }

        $this->home->save();

        $this->reset(['open_edit','filepdf','image','image2','image3','image4']);

        $this->identificador = rand();
        $this->emit('alert', 'Se actualizo satisfactoriamente');
    }

    public function delete(Home $home){
        $home->delete();
    }

   
}
