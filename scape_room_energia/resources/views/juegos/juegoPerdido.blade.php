@extends('LAYOUTS.plantilla')

@section('title', 'Final')

@section('content')
    <div class="static">
        <img class="w-full h-screen" src={{env('APP_URL')."img/juegoPerdido.jpg"}} alt="">
        <div
            class="backdrop-blur-md bg-black/30 h-fit absolute bottom-0 top-14 left-0 mt-24 mx-4 rounded-md text-xs text-white py-6 px-4 sm:text-md sm:mx-8 sm:mt-24 md:text-l md:mx-12 md:mt-24 lg:text-lg lg:mx-16 lg:mt-24">
            <h1 class="text-2xl">Invasión Extraterrestre Exitosa: El Dolor de una Tierra Perdida</h1>
            <p class="mt-6 ">
                Hoy, nos enfrentamos a una realidad devastadora. La invasión extraterrestre ha triunfado, y con ella, la
                pérdida irreparable de nuestra tecnología renovable. El planeta Tierra, una vez vibrante con la esperanza de
                un futuro sostenible, ahora se ve sumido en la oscuridad de la derrota.
            </p>
            <p class="mt-6">
                Imágenes impactantes de naves espaciales alienígenas dominando nuestros cielos y la destrucción de nuestras
                fuentes de energía renovable son testigos mudos de una batalla que no pudimos ganar.
            </p>
            <p class="mt-6">
                El sol ya no ilumina con la misma intensidad, y los campos de paneles solares y turbinas eólicas yacen
                inútiles, como monumentos de un pasado que se esfuma.
            </p>

            <div class="flex justify-center ">
                <a href="{{ route('home') }}"
                    class="flex duration-300 mr-24 mt-6  w-1/3 sm:w-1/5 mb-5 justify-center rounded-md bg-lime-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white lg:text-xl shadow-sm hover:bg-lime-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-lime-500">
                    Volver al inicio
                </a>

            </div>
        </div>

    </div>
@endsection
