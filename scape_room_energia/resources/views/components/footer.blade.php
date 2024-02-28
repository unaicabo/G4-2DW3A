<div class="sticky bottom-0 w-full sm:hidden bg-white">
    <hr class="border-lime-500 border-[1.5px] mx-4">
    <div class="flex justify-around items-center mt-3">
        @if (empty(Auth::check()))
        <div class="footer-nav-links">
            <a class="flex flex-col items-center justify-center" data-modal-target="default-modal" data-modal-toggle="default-modal">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.5"/><path d="M15.4137 10.941C16.1954 11.4026 16.1954 12.5974 15.4137 13.059L10.6935 15.8458C9.93371 16.2944 9 15.7105 9 14.7868L9 9.21316C9 8.28947 9.93371 7.70561 10.6935 8.15419L15.4137 10.941Z" stroke="#1C274C" stroke-width="1.5"/></svg>
                <p class="w-20 text-center">{{__('text.header_play_as_guest')}}</p>
            </a>
        </div>
        @endif
        <div class="footer-nav-links">
            <a href="{{route('home')}}" class="flex flex-col items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                <p>{{__('text.footer_index')}}</p>
            </a>
        </div>
        <div class="footer-nav-links">
            <a href="{{route('partidas.rankings')}}" class="flex flex-col items-center justify-cente">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="48" height="48" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l11 0" /><path d="M9 12l11 0" /><path d="M9 18l11 0" /><path d="M5 6l0 .01" /><path d="M5 12l0 .01" /><path d="M5 18l0 .01" /></svg>
                <p>Ranking</p>
            </a>
        </div>
        <div class="footer-nav-links">
            @if (Route::has('login'))

                @auth
                    <a href="{{url('profile')}}" class="flex flex-col items-center justify-cente">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler" width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                        <p>{{__('text.header_profile')}}</p>
                    </a>
                @else
                    <a href="{{route('register')}}" class="flex flex-col items-center justify-cente">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler"
                        width="48" height="48" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" /></svg>
                        <p>{{ __('text.header_register')}}</p>
                    </a>
                @endauth

            @endif
        </div>
    </div>
</div>

<div class="sm:flex items-center justify-around hidden bg-slate-900 bottom-0 h-40 text-white">
    <div class="flex items-center justify-center w-48 md:w-80">
        <a href="https://www.facebook.com/?locale=es_ES" class="hover:text-lime-500 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
        </a>
        <a href="https://www.instagram.com/" class="hover:text-lime-500 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M16.5 7.5l0 .01" /></svg>
        </a>
        <a href="https://twitter.com/?lang=es" class="hover:text-lime-500 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-x" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg>
        </a>
        <a href="https://www.youtube.com/" class="hover:text-lime-500 duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-youtube" width="36" height="36" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 8a4 4 0 0 1 4 -4h12a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-8z" /><path d="M10 9l5 3l-5 3z" /></svg>
        </a>
    </div>
    <div class="w-48 md:w-80 flex items-center justify-center">
        <a href="{{route('home')}}" class="hover:scale-125 duration-300">
            <img src="{{ env('APP_URL')."img/logo_solo.png"}}" class="w-20">
        </a>
    </div>
    <div class="w-48 md:w-80 flex flex-col md:text-lg  justify-around text-sm h-full">
        <div>
            <p class="font-bold hover:cursor-pointer hover:text-lime-500 hover:scale-105 duration-300">{{__('text.contacto')}}: energycrisis@gmail.com</p>
        </div>
        <div>
            <p>{{__('text.footer_text')}}</p>
        </div>
    </div>
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
