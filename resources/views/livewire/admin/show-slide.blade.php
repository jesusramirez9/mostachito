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
                @livewire('admin.create-slide')
            </div>
            <div>

            </div>
            @if (count($slides))
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
                                Url

                                {{-- Sort --}}

                                @if ($sort == 'url_yt')
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
                        @foreach ($slides as $item)
                            <tr>

                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->id }}</div>
                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $item->title }}</div>
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
                
            @else
                <div class="px-6 py-4">
                    No existe ningún registro coincidente
                </div>

            @endif
        </x-table>
    </div>

    <x-jet-dialog-modal wire:ignore wire:model="open_edit">
        <x-slot name="title">
            Editar
        </x-slot>
        <x-slot name="content">

            <div wire:loading wire:target="image"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                    Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div wire:loading wire:target="image2"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                    Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div wire:loading wire:target="image3"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                    Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div wire:loading wire:target="image4"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">
                    Imagen Cargando
                </strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado..</span>
            </div>
            <div class="flex space-x-5">
                <div>
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="mb-4 w-20 object-cover object-center h-20"
                            alt="">
                    @elseif($slide->image)
                        <img src="{{ Storage::url($slide->image) }}" class="w-20 object-cover object-center h-20"
                            alt="">
                    @endif
                </div>
                <div>
                    @if ($image2)
                        <img src="{{ $image2->temporaryUrl() }}" class="mb-4 w-20 object-cover object-center h-20"
                            alt="">
                    @elseif($slide->image2)
                        <img src="{{ Storage::url($slide->image2) }}" class="w-20 object-cover object-center h-20"
                            alt="">
                    @endif
                </div>
                <div>
                    @if ($image3)
                        <img src="{{ $image3->temporaryUrl() }}" class="mb-4 w-20 object-cover object-center h-20"
                            alt="">
                    @elseif($slide->image3)
                        <img src="{{ Storage::url($slide->image3) }}" class="w-20 object-cover object-center h-20"
                            alt="">
                    @endif
                </div>
                <div>
                    @if ($image4)
                        <img src="{{ $image4->temporaryUrl() }}" class="mb-4 w-20 object-cover object-center h-20"
                            alt="">
                    @elseif($slide->image4)
                        <img src="{{ Storage::url($slide->image4) }}" class="w-20 object-cover object-center h-20"
                            alt="">
                    @endif
                </div>



            </div>

            <div class="mb-4 mt-4">
                <x-jet-label value="Título del servicio:" />
                <x-jet-input type="text" class="w-full" wire:model="slide.title" />
              

            </div>
            <div class="mb-4 mt-4">
                <x-jet-label value="Fondos que aparecen al inicio de la web:" />
                
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen del servicio1:" />
                <input type="file" wire:model="image" id="{{ $identificador2 }}">
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen del servicio2:" />
                <input type="file" wire:model="image2" id="{{ $identificador3 }}">
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen del servicio3:" />
                <input type="file" wire:model="image3" id="{{ $identificador4 }}">
            </div>
            <div class="mb-4">
                <x-jet-label value="Imagen del servicio4:" />
                <input type="file" wire:model="image4" id="{{ $identificador5 }}">
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit', false)" class="mr-4">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update" wire:target="save, image, image2, image3, image4" wire:loadin.attr="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script src="{{ asset('vendor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('deletePost', postId => {
                Swal.fire({
                    title: 'Está seguro de eliminar este elemento?',
                    text: "No podrás revertir esto.!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('admin.show-slide', 'delete', postId)

                        Swal.fire(
                            'Eliminado!',
                            'El elemento ha sido eliminado',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush

</div>
