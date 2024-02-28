@extends('LAYOUTS.plantilla')

@section('title', 'Energy crisis')

@section('content')

    <style>
        .alien {
            position: absolute;
            animation: alien 6s linear 3s infinite alternate
        }

        @keyframes alien {
            0% {
                left: 0vw;
                top: 0vh;
            }

            25% {
                left: 80vw;
                top: 40vh;
            }

            50% {
                left: 50vw;
                top: 20vh;
            }

            75% {
                left: 20vw;
                top: 60vh;
            }

            100% {
                left: 0vw;
                top: 0vh;
            }
        }
    </style>
    <form class="absolute bottom-0 top-8 right-0 mt-24 mx-4" action="{{ route('change_language') }}" method="POST">
        @csrf
        <select name="idioma" class="rounded-md" onchange="this.form.submit()">
            @if (session()->get('language') == 'es')
                <option value="es" selected>ES</option>
                <option value="en">EN</option>
                <option value="eus">EU</option>
            @elseif (session()->get('language') == 'en')
                <option value="es">ES</option>
                <option value="en" selected>EN</option>
                <option value="eus">EU</option>
            @elseif (session()->get('language') == 'eus')
                <option value="es">ES</option>
                <option value="en">EN</option>
                <option value="eus" selected>EU</option>
            @else
                <option value="es">ES</option>
                <option value="en">EN</option>
                <option value="eus">EU</option>
            @endif
        </select>
    </form>
    <div class="static">
        <img class="w-full h-screen" src={{env('APP_URL')."img/final.jpg"}} alt="">
        <div class="backdrop-blur-md bg-black/30 h-fit absolute bottom-0 top-24 left-0 mt-24 mx-4 rounded-md text-xl text-white py-2 px-4 sm:text-l sm:mx-8 sm:mt-24 md:text-l md:mx-12 md:mt-24 lg:text-l lg:mx-16 lg:mt-24">
            <img src={{env('APP_URL')."img/alien.png"}} class="alien w-8 h-8 sm:w-12 sm:h-12 lg:w-16 lg:h-16 pointer-events-none" alt="alienigena">
            <div class="mx-1  rounded-md text-sm px-2 sm:text-xs sm:mx-8 sm:mt-2 md:text-lg md:mx-12 lg:text-xl lg:mx-16 lg:mt-1">
                <div class="text-center">
                    <p>
                        {{ __('text.descripcion1') }}
                    </p>
                    <br>
                    <p>
                        {{ __('text.descripcion2') }}
                    </p>
                    <br>
                    <p>
                        {{ __('text.descripcion3') }}
                    </p>
                    <br>
                    <p>
                        {{ __('text.descripcion4') }}
                    </p>
                </div>
                <div class="flex justify-center">
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="flex duration-300 w-1/3 sm:w-1/4 mt-8 mb-5 justify-center rounded-md bg-lime-500 px-3 py-1.5 text-l  font-semibold leading-6 text-white shadow-sm hover:bg-lime-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-500">
                        {{ __('text.start_game') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/js/controlForm.js')
@endsection
