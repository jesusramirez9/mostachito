<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{-- fontawesone --}}
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    {{-- Dropzone --}}
    <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @livewireStyles
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   --}}
   
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    {{-- ckedito --}}
    <script src="{{asset('js/ckeditor.js')}}"></script>
    {{-- sweetalert2@ --}}
    <script src="{{asset('js/sweetalert2_11.js')}}"></script>

    {{-- Dropzone --}}
    <script src="{{asset('js/dropzone.min.js')}}"
        integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="font-sans antialiased">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="h-auto">
            {{ $slot }}
        </main>
       
    </div>

    @stack('modals')

    @livewireScripts
    <script>
        function dropdown() {
            return {
                open: false,
                show() {
                    if (this.open) {
                        //se cierra el menu
                        this.open = false;
                        document.getElementsByTagName('html')[0].style.overflow = "auto"
                    } else {
                        //Esta abriendo el menu
                        this.open = true;
                        document.getElementsByTagName('html')[0].style.overflow = "hidden"
                    }

                },
                close() {
                    this.open = false;
                    document.getElementsByTagName('html')[0].style.overflow = "auto"
                }
            }
        }
    </script>
    @stack('script')

    {{-- <script>
        Livewire.on('errorSize', mensaje => {

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: mensaje,

            })
        });
    </script> --}}

</body>

</html>
