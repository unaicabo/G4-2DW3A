@extends('LAYOUTS.plantilla')

@section('title', 'Final')

@section('content')
    <div class="static">
        <img class="w-full h-screen" src={{env('APP_URL')."img/final.jpg"}} alt="">
        <div class="backdrop-blur-md bg-black/30 h-fit absolute bottom-0 top-14 left-0 mt-24 mx-4 rounded-md text-xs text-white py-6 px-4 sm:text-md sm:mx-8 sm:mt-24 md:text-l md:mx-12 md:mt-24 lg:text-lg lg:mx-16 lg:mt-24">
            <h1 class="text-2xl">Querido Héroe Intergaláctico,</h1>
            <p class="mt-6 ">
                ¡Enhorabuena por completar con éxito la misión más crucial de tu vida! Te saludamos con júbilo desde la base
                de operaciones terrestre, donde celebramos tu valentía y destreza en el Escape Room Energy Crisis. Has
                demostrado ser un estratega excepcional y un verdadero protector de nuestro hogar planetario.
            </p>
            <p class="mt-6">
                Después de enfrentarte a los desafíos alienígenas con ingenio y tenacidad, podemos anunciar con orgullo que
                tu tiempo de escape fue de {{$last_game->tiempo}}. Tu agilidad mental y habilidades tácticas te
                han posicionado en el puesto {{$posicion}} en el prestigioso Ranking
                Mundial de Defensores de la Tierra.
            </p>
            <p class="mt-6">
                Imagina a las futuras generaciones contando la historia de cómo un intrépido ser humano salvó a la Tierra de
                la invasión extraterrestre. ¡Esa persona eres tú!
            </p>
            <p class="mt-6">
                Queremos expresar nuestro más profundo agradecimiento por tu dedicación y valentía. Sin tu astucia, la
                humanidad estaría ahora en manos de invasores de otros mundos. Celebra tu victoria y
                mantén vivo el espíritu de resistencia ante cualquier amenaza que se cruce en nuestro camino.
            </p>
            <p class="mt-6">
                Te extendemos una cordial invitación a regresar cuando desees enfrentarte a nuevos desafíos. ¡Estamos
                preparando más misiones emocionantes para héroes como tú!
            </p>
            <h1 class="mt-6 ">
                Con gratitud intergaláctica, El Equipo de Energy Crisis
            </h1>

            <div class="flex justify-center ">
                <a href="{{ route('home') }}"
                    class="flex duration-300 mr-24 mt-6  w-1/3 sm:w-1/5 mb-5 justify-center rounded-md bg-lime-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white lg:text-xl shadow-sm hover:bg-lime-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-500">
                    Volver al inicio
                </a>
                <a href="{{ route('partidas.rankings') }}"
                    class="flex duration-300 w-1/3 mt-6  sm:w-1/5 mb-5 justify-center rounded-md bg-lime-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white lg:text-xl shadow-sm hover:bg-lime-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-500">
                    Ver el ranking
                </a>
            </div>
        </div>
    </div>
@endsection
