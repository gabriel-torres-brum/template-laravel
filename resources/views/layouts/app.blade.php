<!DOCTYPE html>
<html lang="pt-BR" :class="{ 'dark': darkMode }" x-data="{ darkMode: $persist(false) }" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@stack('pagetitle')</title>
    
    <script>
        if (localStorage._x_darkMode === 'true' || (!('_x_darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add("dark")
        } else {
            document.documentElement.classList.remove("dark")
        }
    </script>
    
    @livewireStyles
    {{-- @toastScripts --}}
    @wireUiScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-notifications />
    <x-dialog id="delete" z-index="z-40" align="center" />
    {{-- <livewire:toasts /> --}}
    {{-- @include('layouts.preloader') --}}
    @auth
    <header class="fixed inset-x-0 top-0 z-30 flex items-center justify-between w-full h-16 px-6 bg-white shadow">
        <a href="javascript:void(0)" class="text-lg font-medium">
            Igreja
        </a>
        <div class="flex items-center justify-center flex-1 text-sm">
            <ul class="flex gap-6">
                <li class="transition-colors duration-300 transform border-b-2 p-1 @if (request()->routeIs('app.dashboard')) border-blue-700 @else border-transparent hover:border-blue-800 @endif">
                    <a href="{{ route('app.dashboard') }}">Dashboard</a>
                </li>
                <li class="transition-colors duration-300 transform border-b-2 p-1 @if (request()->routeIs('app.members-list')) border-blue-700 @else border-transparent hover:border-blue-800 @endif">
                    <a href="{{ route('app.members-list') }}">Membros</a>
                </li>
                <li class="transition-colors duration-300 transform border-b-2 p-1 @if (request()->routeIs('app.roles-list')) border-blue-700 @else border-transparent hover:border-blue-800 @endif">
                    <a href="{{ route('app.roles-list') }}">Cargos</a>
                </li>
            </ul>
        </div>
        <div x-data="{ dropdown: false }" class="relative">
            <button x-on:click="dropdown = !dropdown" class="p-1 transition-transform bg-gray-200 rounded-full w-7 h-7 active:scale-95">
                <x-icon name="user" class="w-5 h-5" />
            </button>
            <div x-cloak x-show="dropdown" x-on:click.away="dropdown = false" class="absolute flex flex-col mt-6 text-sm bg-white rounded shadow -ml-28 w-36 after:rotate-45 after:bg-white after:absolute after:-top-2 after:right-2 after:-z-10 after:w-4 after:h-4 after:shadow">
                <a class="relative inline-flex flex-1 p-3 transition-colors hover:bg-gray-100" href="javascript:void(0)">
                    <x-icon name="cog" class="absolute left-0 w-5 h-5 ml-2.5" />
                    <span class="ml-6">Configurações</span>
                </a>
                <a href="{{ route('logout') }}" class="relative inline-flex flex-1 p-3 transition-colors hover:bg-gray-100" href="javascript:void(0)">
                    <x-icon name="logout" class="absolute left-0 w-5 h-5 ml-2.5" />
                    <span class="ml-6">Sair</span>
                </a>
            </div>
        </div>
    </header>
    <main class="px-8 pt-20 pb-10">
        <h3 class='mb-4 text-xl font-bold tracking-wide text-center'>
            @stack('pagetitle')
        </h3>
        {{ $slot }}
    </main>
    @endauth
    @guest
    {{ $slot }}
    @endguest
    @livewireScripts
    <livewire:modal-edit />
</body>

</html>