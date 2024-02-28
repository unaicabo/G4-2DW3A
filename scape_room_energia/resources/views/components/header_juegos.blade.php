<div class="w-full absolute top-0 bg-white">
    <div class="m-2 absolute top-1 left-2">
        <a href="{{route('home')}}">
            <img src={{ env('APP_URL') . 'img/exit.png' }} alt="exit" class="w-6 sm:w-8 md:w-10 lg:16">
        </a>
    </div>
    <div class="flex justify-center items-center">
        <img src={{ env('APP_URL') . 'img/logo.png' }} alt="energy crisis logo"
        class="flex justify-center w-48 sm:w-56 lg:72">
    </div>
    <hr class="h-1 bg-green-500 sm:hidden">
</div>
