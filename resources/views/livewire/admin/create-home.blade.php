<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        Crear nuevo 
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
           Home - Página de inicio
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                   Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div wire:loading wire:target="image2" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                   Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div wire:loading wire:target="image3" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                   Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div wire:loading wire:target="image4" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                   Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div class="flex space-x-5">
                @if ($image)
                <img src="{{$image->temporaryUrl()}}" class="w-20 object-cover object-center h-20"  alt="">
              @endif
            @if ($image2)
            <img src="{{$image2->temporaryUrl()}}" class="w-20 object-cover object-center h-20"  alt="">
             @endif
              @if ($image3)
              <img src="{{$image3->temporaryUrl()}}" class="w-20 object-cover object-center h-20"  alt="">
             @endif
             @if ($image4)
          <img src="{{$image4->temporaryUrl()}}" class="w-20 object-cover object-center h-20"  alt="">
            @endif

            </div>
            
            <div class="mb-4 mt-4">
                <x-jet-label value="Enlace o URL de video YouTube:" />
                <x-jet-input type="text" class="w-full" wire:model="url_yt"  />
                <x-jet-input-error for="url_yt" />
            </div>
            <div class="mb-4">
                <x-jet-label value="Ingresar pdf:" />
                <input type="file" wire:model="filepdf" id="{{$identificador}}">
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen 1:" />
                <input type="file" wire:model="image" id="{{$identificador2}}">
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen 2:" />
                <input type="file" wire:model="image2" id="{{$identificador3}}">
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen 3:" />
                <input type="file" wire:model="image3" id="{{$identificador4}}">
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen 4:" />
                <input type="file" wire:model="image4" id="{{$identificador5}}">
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)" class="mr-4">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save,filepdf, image, image2, image3, image4" class="disabled:opacity-25">
                Crear 
            </x-jet-danger-button>

            {{-- <span wire:loading wire:target="save">Cargando..</span> --}}
        </x-slot>

    </x-jet-dialog-modal>
@push('js')
    {{-- <script src="{{asset('vendor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
    <script>
          ClassicEditor
            .create( document.querySelector( '#editor' ),{
                simpleUpload: {
            // The URL that the images are uploaded to.
            uploadUrl: "{{route('image.upload')}}",

            }
            } )
            .then(function(editor){
            editor.model.document.on('change:data', ()=>{
	    	@this.set('content',editor.getData());
	        });
            Livewire.on('resetCKEditor', function() {
                        editor.setData('');
                    });
	
	        })
            .catch( error => {
                console.error( error );
            } );
    </script> --}}

@endpush
</div>
