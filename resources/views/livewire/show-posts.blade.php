<div wire:init="loadPosts">

    {{ $search }}

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <x-table>
            <div class="px-6 py-4 flex items-center">
                {{-- <input type="text" wire:model='search'> --}}
                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select class="mx-2 form-control" wire:model="cant">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entradas</span>
                </div>
                <x-jet-input class="flex-1 mx-4" placeholder="Escriba lo que quiere buscar" type="text"
                    wire:model='search' />
                @livewire('create-post')
            </div>
            @if (count($posts))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 w-24 cursor-pointer py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">
                                Id
                                {{-- Sort --}}

                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>


                            <th scope="col"
                                class="px-6 cursor-pointer py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('title')">
                                Titulo

                                {{-- Sort --}}

                                @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif

                            </th>
                            <th scope="col"
                                class="px-6 cursor-pointer py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('content')">
                                Contenido
                                @if ($sort == 'content')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right mt-1"></i>
                                @endif
                            </th>
                            {{-- Sort --}}



                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $item)
                            <tr>

                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->id }}</div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->title }}</div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{!!$item->content !!}</div>
                                </td>
                                <td class="px-6 py-4 flex text-sm font-medium">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}

                                    <a class="btn btn-green" wire:click="edit({{ $item }})">
                                        <i class="fas fa-edit"></i></a>
                                    <a class="btn btn-red ml-2" wire:click="$emit('deletePost', {{ $item->id }})">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <!-- More people... -->
                    </tbody>
                </table>
                @if ($posts->hasPages())
                    <div class="px-6 py-3">
                        {{ $posts->links() }}
                    </div>
                @endif

            @else
                <div class="px-6 py-4">
                    No existe ningún registro coincidente
                </div>

            @endif
        </x-table>
    </div>

    <x-jet-dialog-modal wire:ignore  wire:model="open_edit">
        <x-slot name="title">
            Editar el post {{ $post->title }}
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

            @elseif($post->image)
                <img src="{{ Storage::url($post->image) }}" alt="">
            @endif

            <div>
                <x-jet-label value="Titulo del post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
            </div>

            <div wire:ignore>
                <x-jet-label value="Contenido del post" />
                <textarea  wire:model="post.content" class="w-full form-control" rows="6"
                x-init="
            ClassicEditor.create( $refs.editor )
            .then(function(editor){
                editor.model.document.on('change:data',() => {
                    @this.set('post.content', editor.getData())
                })
            })
            .catch( error => {
                console.error( error );
            } );
            function previewImage(event, querySelector) {

                //Recuperamos el input que desencadeno la acción
                const input = event.target;

                //Recuperamos la etiqueta img donde cargaremos la imagen
                $imgPreview = document.querySelector(querySelector);

                // Verificamos si existe una imagen seleccionada
                if (!input.files.length) return

                //Recuperamos el archivo subido
                file = input.files[0];

                //Creamos la url
                objectURL = URL.createObjectURL(file);

                //Modificamos el atributo src de la etiqueta img
                $imgPreview.src = objectURL;

            }
            " x-ref="editor"
                ></textarea>
            </div>
            <div class="mb-4">
                <input type="file" wire:model="image" id="{{ $identificador }}">
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)" class="mr-4">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update" wire:loadin.attr="disabled:opacity-25">
                Actualizar Post
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
     <script src="{{asset('vendor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('deletePost', postId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('show-posts', 'delete', postId)

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        </script>
       
        
    @endpush

</div>
