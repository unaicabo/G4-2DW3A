@extends('LAYOUTS.plantilla')

@section('title', 'Admin Panel')

@section('content')


    <div class="min-h-[40vh] ">
        <img class="w-full h-screen" src="{{ env('APP_URL') . 'img/final.jpg' }}" alt="">
        <div
            class="w-full h-fit absolute bottom-0 top-24 left-0 mt-24  rounded-md text-xl text-white py-2 sm:text-l  sm:mt-24 md:text-l  md:mt-24 lg:text-l  lg:mt-24">
            <div class="flex justify-center">

                <h1 class="p-2 rounded backdrop-blur-md bg-black/30 w-fit mt-10 mb-5 text-center text-3xl text-white">Panel
                    de
                    administración</h1>
            </div>

            <div class="flex m-8 justify-center w-full space-x-14 text-white">
                <a class="text-center text-xl w-1/3  bg-lime-500 rounded shadow p-8 m-2 transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110 hover:bg-lime-600 duration-300  active:bg-lime-700"
                    href="{{ route('admin.users') }}">Usuarios</a>
                <a class=" text-center text-xl w-1/3 bg-lime-500 rounded shadow p-8 m-2 transition ease-in-out delay-150  hover:-translate-y-1 hover:scale-110 hover:bg-lime-600 duration-300 active:bg-lime-700"
                    href="{{ route('admin.partidas') }}">Partidas</a>
            </div>
            @vite('resources/js/app.js')
        </div>
    </div>

@endsection
