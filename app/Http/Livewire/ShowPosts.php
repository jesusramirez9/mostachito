<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    use WithFileUploads; 
    public $image, $identificador;

    public $open_edit =false;
    public $post;
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
        'post.title' => 'required',
        'post.content' => 'required',
    ];  
  
    public function mount(){
        $this->identificador = rand();
        $this->post = new Post();
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    //renderiza el contenido
    public function render()
    {
        if ($this->readyToLoad) {
           $posts = Post::where('title', 'like', '%'.$this->search.'%')
                       ->orWhere('content', 'like', '%'.$this->search.'%')
                       ->orderBy($this->sort, $this->direction)
                       ->paginate($this->cant);
        }else{
            $posts = [];
        }

        
        return view('livewire.show-posts', compact('posts'));
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

    public function edit(Post $post){
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();

        $data2 = [
                'post.title' => $this->title,
             'post.content' => $this->content,
               
              ];

        $images_antiguas = $this->post->images->pluck('image_url')->toArray();
        $re_extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($re_extractImages, $data2['post.content'], $matches);
        $images_nuevas = $matches[1];

        foreach ($images_nuevas as $image) {
            $image_url = 'images/' . pathinfo($image, PATHINFO_BASENAME);

            $clave = array_search($image_url, $images_antiguas);

            if ($clave === false) {

                $this->post->images()->create([
                    'image_url' => $image_url,
                ]);

            } else {

                unset($images_antiguas[$clave]);

            }
        }
        
        foreach ($images_antiguas as $image) {
            Storage::delete($image);
            $this->post->images()->where('image_url', $image)->delete();
        }

        if ($this->image) {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }

        $this->post->save();

        $this->reset(['open_edit','image']);

        $this->identificador = rand();
        $this->emit('alert', 'El post se actualizo satisfactoriamente');
    }

    public function delete(Post $post){
        $post->delete();
    }
}
