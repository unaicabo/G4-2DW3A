<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="../public/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@200;400&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100" style="font-family: 'Barlow Condensed', sans-serif;">
    <h1 class="flex justify-center text-4xl mt-8">Partidas</h1>
    <a class="text-2xl ml-8" href="{{ route('admin') }}">
        <span style='font-size:50px;' class="text-lime-400">&#11148;</span>
    </a>


    <section class="container mx-auto p-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-3">Usuario</th>
                            <th class="px-4 py-3">Fecha</th>
                            <th class="px-4 py-3">Dificultad</th>
                            <th class="px-4 py-3">Errores</th>
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($partidas as $partida)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 border">
                                    <div class="flex items-center text-sm">
                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                            @if ($partida->usuario->foto != '')
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src={{ env('APP_URL') . 'img/' . $partida->usuario->foto }}
                                                    alt="" />
                                            @else
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src={{ env('APP_URL') . 'img/default.png' }} alt="" />
                                            @endif
                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-black">{{ $partida->usuario->name }}</p>
                                            <p class="text-xs text-gray-600">{{ $partida->usuario->rol }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $partida->created_at }}</td>
                                <td class="px-4 py-3 text-sm border">{{ $partida->dificultad }}</td>
                                <td class="px-4 py-3 text-sm border">{{ $partida->errores }}</td>
                                <td class="px-4 py-3 text-sm border">
                                    <form action="{{ route('admin.partida.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $partida->id }}">
                                        <button type="submit"
                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $partidas->links() }}
                @vite('resources/js/app.js')
            </div>
        </div>
    </section>


</body>

</html>
