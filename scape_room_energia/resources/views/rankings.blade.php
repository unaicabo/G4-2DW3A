@extends('LAYOUTS.plantilla')

@section('title', 'Rankings')

@section('content')
<div class="static">
<img class="w-full h-screen" src={{env('APP_URL')."img/final.jpg"}} alt="">
    <div class="absolute top-24">
        <div class="top-8 sm:top-8 absolute left-4">
            <select class="bg-green-100" id="dificultad_select">
                <option value="none">Dificultad</option>
                <option value="facil">Facil</option>
                <option value="medio">Medio</option>
                <option value="dificil">Dificil</option>
                <option value="heroe">Heroe</option>
            </select>
        </div>
        <div class="flex justify-center">
            <h1 class="p-2 rounded backdrop-blur-md bg-black/30 w-fit mt-2 sm:mt-10 md:mt-10 lg:mt-10 mb-5 text-center text-3xl text-white">{{ __('text.rank_puntuaciones') }}</h1>
        </div>
        @if (\Auth::user())
            <input type="hidden" id="user_id" value="{{\Auth::user()->id}}">
        @endif
        {{-- Tabla de Puntuaciones --}}
        <div class="flex justify-center flex-col items-center">
            <table id="rankTable" class="w-11/12 md:w-11/12 table-fixed">
                <thead class="bg-lime-500 text-center text-white border-b border-gray-200">
                    <tr>
                        <th class="w-1/4 py-2"></th>
                        <th class="w-1/4 py-2 md:px-2 md:font-bold md:uppercase">{{ __('text.rank_posicion') }}</th>
                        <th class="w-1/4 md:w-1/2 py-2 md:px-2 md:font-bold md:uppercase">{{ __('text.rank_nombre') }}</th>
                        <th class="w-1/4 py-2 md:px-2 md:font-bold md:uppercase">{{ __('text.rank_tiempo') }}</th>
                        <th class="w-1/4 py-2 md:px-2 md:font-bold md:uppercase">{{ __('text.rank_fallos') }}</th>
                        <th class="w-1/4 py-2 md:px-2 md:font-bold md:uppercase">{{ __('text.rank_dificultad') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-center">

                </tbody>
            </table>
            @if ($best != null)
                <div class="mt-4 p-3 rounded backdrop-blur-md bg-black/30 w-fit flex flex-col sm:flex-row w-full md:w-10/12 lg:9/12 items-center">
                    <h1 class="text-white text-center w-9/12 mb-2 sm:mb-0 sm:w-1/3 text-2xl">{{ __('text.rank_best') }}:</h1>
                    <table class="w-full table-fixed">
                        <tbody class="bg-white text-center">
                            <tr class="hover:bg-gray-300 hover:cursor-pointer">
                                <td class="text-sm sm:text-base w-1/4 py-2 px-2 sm:py-4 sm:px-6 border-y border-l border-gray-200">{{ $best->posicion }}º</td>
                                <td class="text-sm sm:text-base w-1/4 py-2 px-2 sm:py-4 sm:px-6 border-y border-gray-200">{{ \Auth::user()->name }}</td>
                                <td class="text-xs sm:text-base w-1/4 py-2 px-4 sm:py-4 border-y border-gray-200">{{ $best->tiempo }}</td>
                                <td class="text-sm sm:text-base w-1/4 py-2 px-2 sm:py-4 sm:px-6 border-y border-gray-200">{{ $best->errores }} fallos</td>
                                <td class="text-sm sm:text-base w-1/4 py-2 px-2 sm:py-4 sm:px-6 border-y border-r border-gray-200">{{ $best->dificultad }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        {{-- Control de Paginas --}}
        <nav class="flex justify-center mt-5">
            <ul class="flex items-center h-10" id="listnumber">

            </ul>
        </nav>
    </div>
</div>
    @vite('resources/js/ranking.js')

@endsection
