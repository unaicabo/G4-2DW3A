<div class="flex justify-center items-center w-full mt-4 sm:justify-around sm:text-lg md:text-xl lg:text-2xl">
    <img src="{{ env('APP_URL') . 'img/logo_2.png' }}" alt="energy crisis logo" class="w-24 sm:hidden">
    @if (empty(Auth::check()))
        <button class="hidden sm:block uppercase hover:text-lime-500 duration-300" data-modal-target="default-modal" data-modal-toggle="default-modal">
            {{__('text.header_play_as_guest')}}
        </button>
    @endif
    <a class="hidden sm:block uppercase hover:text-lime-500 duration-300"
        href="{{ route('partidas.rankings') }}">Ranking</a>
    <a href="{{ route('home') }}">
        <img src={{ env('APP_URL') . 'img/logo.png ' }} alt="energy crisis logo" class="w-64 hidden sm:flex justify-center items-center">
    </a>
    @if (Route::has('login'))
            @auth
                <a href="{{ url('/profile') }}"
                    class="hidden sm:block uppercase hover:text-lime-500 duration-300">
                    {{__('text.header_profile')}}
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="hidden sm:block uppercase hover:text-lime-500 duration-300">
                    {{ __('text.header_login') }}
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="hidden sm:block uppercase hover:text-lime-500 duration-300">
                        {{ __('text.header_register') }}
                    </a>
                @endif
            @endauth

    @endif

</div>

<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <form action="{{route('juegos.index')}}" id="form" method="POST">
            @csrf
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Elija su aventura
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <div class="mb-6">
                        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dificultad (Solo afecta al tiempo)</label>
                        <select name="dificultad" id="dificultad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="0">Elije dificultad</option>
                            <option value="F">Facil</option>
                            <option value="N">Normal</option>
                            <option value="D">Dificil</option>
                            <option value="H">Heroe Intergalactico</option>
                        </select>
                    </div>
                    @if (empty(Auth::check()))
                        <p>Si no tiene la sesión inciada no se guardara el progreso</p>
                    @endif
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button type="sumbit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Jugar</button>
                    <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
