@extends('LAYOUTS.plantilla_juegos')

@section('title', 'Jugar')

@section('content')
    <input type="hidden" id="dificultad" value="{{$dificultad}}">
    <div id="app">

    </div>
@endsection
