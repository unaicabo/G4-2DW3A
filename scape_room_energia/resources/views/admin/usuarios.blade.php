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
    <h1 class="flex justify-center text-4xl mt-8">Usuarios</h1>
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
                            <th class="px-4 py-3">Nombre</th>
                            <th class="px-4 py-3">Correo</th>
                            <th class="px-4 py-3">Rol</th>
                            <th class="px-4 py-3">Aciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($usuarios as $usuario)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 border">
                                    <div class="flex items-center text-sm">
                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                            @if ($usuario->foto != null)
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ env('APP_URL') . 'img/' . $usuario->foto }}" alt=""
                                                    loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner"
                                                    aria-hidden="true"></div>
                                            @else
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="{{ env('APP_URL') . 'img/' . $usuario->foto }}" alt=""
                                                    loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner"
                                                    aria-hidden="true"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-semibold text-black">{{ $usuario->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $usuario->email }}</td>
                                <td class="px-4 py-3 text-xs border">
                                    @if ($usuario->rol == 'admin')
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                            Admin </span>
                                    @else
                                        <span
                                            class="px-2 py-1 font-semibold leading-tight text-slate-700 bg-slate-100 rounded-sm">
                                            Jugador </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm border">
                                    <div class=" flex justify-start">
                                        <form action="{{ route('admin.user.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $usuario->id }}">
                                            <button type="submit"
                                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm hover:underline-offset-1">
                                                Eliminar
                                            </button>
                                        </form>
                                        {{-- Si no es el usuario registrado --}}
                                        @if (Auth::User()->id != $usuario->id)
                                            &nbsp;/&nbsp;

                                            <form action="{{ route('admin.user.rol') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $usuario->id }}">
                                                <button type="submit"
                                                    class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-sm hover:underline-offset-1">
                                                    @if ($usuario->rol != 'admin')
                                                        Hacer admin
                                                    @else
                                                        Quitar admin
                                                    @endif
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{ $usuarios->links() }}

    @vite('resources/js/app.js')
</body>

</html>
