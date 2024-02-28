<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="grid grid-cols-2" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mr-16">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Información de perfil') }}
            </h2>
            
            <p class="text-gray-600 text-base pt-3 font-normal">Ultimo tiempo:</p>
            <p class="text-gray-800 text-sm">
    
                @if (isset($tiempo_last))
                    ❀ {{$tiempo_last}} ❀
                @else
                    Todavia no tienes registros
                @endif
    
            </p>
            <br>
            <p class="text-gray-600 text-base pt-3 font-normal">Tu mejor tiempo:</p>
            <p class="text-gray-800 text-sm mb-4">
                @if (isset($tiempo_best))
                    ❀ {{$tiempo_best}} ❀
                @else
                    Todavia no tienes registros
                @endif
            </p>
            <div class="mt-8">
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
    
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Su dirección de correo no esta verficada.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Clica aqui para reenviar la verificación del email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('Un nuevo link de verifiación ha sido enviado a tu email.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
    
            <div class="flex items-center gap-4 mt-6">
                <x-primary-button>{{ __('Guardar') }}</x-primary-button>
    
                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Guardado.') }}</p>
                @endif
            </div>
        </div>
        <div>
            <x-input-label for="name" :value="__('Foto de Perfil')" />
            <div class="h-64 w-64 m-4">
                {{-- Si la Foto es Default, me la muestra --}}
                @if($user->foto == 'default.png')
                    <img src="{{asset('img/default.png')}}"
                    class="rounded-full object-cover w-2/3 h-2/3 sm:h-full sm:w-full border-2 border-lime-500">
                {{-- si no, me muestra la foto de Storage --}}
                @else 
                    <img src="{{asset('storage/Fotos-Perfil/' . $user->foto)}}"
                    class="rounded-full object-cover w-2/3 h-2/3 sm:h-full sm:w-full border-2 border-lime-500">
                @endif
            </div>
            <input id="foto" name="foto" type="file" accept="image/*" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold
            file:bg-lime-50 file:text-lime-700 hover:file:bg-lime-100" :value="old('foto', $user->foto)" autocomplete="foto" />
        </div>
    </form>
</section>
