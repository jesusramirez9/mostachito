<div>
    <a class="btn btn-green" wire:click="$set('open','true')"> <i class="fas fa-edit"></i></a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el postasdas {{ $post->title }}
        </x-slot>
        <x-slot name="content">

            <div wire:loading wire:target="image"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                    Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>

            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" class="mb-4" alt="">

            @else
                <img src="{{Storage::url($post->image)}}" alt="">
                 
            @endif

            <div>
                <x-jet-label value="Titulo del post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
            </div>

            <div wire:ignore>
                <x-jet-label value="Contenido del post" />
                <textarea id="editor" wire:model.defer="post.content" class="w-full form-control" rows="6"
                x-data 
                ></textarea>
            </div>
            <div class="mb-4">
                <input type="file" wire:model="image" id="{{ $identificador }}">
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)" class="mr-4">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loadin.attr="disabled:opacity-25">
                Actualizar Post
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

@push('js')
   
@endpush
</div>
