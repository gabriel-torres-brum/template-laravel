<!DOCTYPE html>
<html lang="pt-BR" x-data="{ darkMode: $persist(false) }" :data-theme="darkMode ? 'dark' : 'light'">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@stack('pagetitle')</title>

    @vite('resources/css/app.css')
    @livewireStyles
    <script>
        if (localStorage._x_darkMode === 'true' || (!('_x_darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute("data-theme", "dark")
        } else {
            document.documentElement.setAttribute("data-theme", "light")
        }
    </script>
    @vite('resources/js/app.js')
</head>

<body>
    @include('layouts.preloader')
    <header class="fixed inset-x-0 top-0 z-30 flex items-center px-4 py-2 shadow bg-primary text-primary-content">
        @auth
        <div class="flex-none">
            <label for="drawer" class="btn btn-square btn-ghost drawer-button btn-sm lg:hidden">
                <i class='text-lg fa-solid fa-bars'></i>
            </label>
        </div>
        <div class="flex-1">
            <a class="text-lg">
                Sistema Igreja
            </a>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar btn-sm">
                    <div class="w-10 rounded-full">
                        <img src="https://placeimg.com/80/80/people" />
                    </div>
                </label>
                <ul
                    tabindex="0" class="p-2 mt-3 border rounded-md shadow bg-base-300 menu menu-compact dropdown-content w-52 border-base-content/20 text-base-content">
                    <li>
                        <a x-on:click="darkMode = !darkMode">
                            <i x-cloak x-show="darkMode" class="fa-solid fa-sun"></i>
                            <i x-cloak x-show="!darkMode" class="fa-solid fa-moon"></i>
                        </a>
                    </li>
                    {{-- <li>
                        <a>Configuraçõe</a>
                    </li> --}}
                    <li>
                        <a>Sair</a>
                    </li>
                </ul>
            </div>
        </div>
        @endauth
        @guest
        <div class="flex justify-center flex-1">
            <a class="text-lg">
                Sistema Igreja
            </a>
        </div>
        @endguest
    </header>
    @auth
    <div class="drawer drawer-mobile">
        <input id="drawer" type="checkbox" class="drawer-toggle" />
        <div class="flex flex-col drawer-content">
            <!-- Page content here -->
            <main class='flex-1 p-8 mt-12 overflow-x-hidden overflow-y-auto'>
                <h3 class='text-xl font-bold tracking-wide text-center md:text-left'>
                    @stack('pagetitle')
                </h3>
                {{ $slot }}
            </main>
        </div>
        <div class="mt-12 drawer-side">
            <label for="drawer" class="drawer-overlay"></label>
            <ul
                class="flex flex-col flex-1 gap-2 p-4 overflow-y-auto border-r bg-primary text-primary-content border-base-300 w-36">
                <!-- Sidebar content here -->
                <li>
                    <a href="{{ !request()->routeIs('app.dashboard') ? route('app.dashboard') : " #" }}"
                        class="gap-1.5 !flex-col btn h-16 btn-ghost btn-block @if(request()->routeIs('app.dashboard')) btn-active @endif">
                        <i class="gap-3 fa-solid fa-chart-pie"></i>
                        <span class="block">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ !request()->routeIs('app.members-list') ? route('app.members-list') : " #" }}"
                        class="gap-1.5 !flex-col btn h-16 btn-ghost btn-block @if(request()->routeIs('app.members-list')) btn-active @endif">
                        <i class="gap-3 fa-solid fa-users"></i>
                        <span class="block">
                            Membros
                        </span>
                    </a>
                </li>
                <li class='mt-auto'>
                    <a href="{{ route('logout') }}" class="gap-1.5 !flex-col btn h-16 btn-ghost btn-block">
                        <i class="gap-3 fa-solid fa-sign-out"></i>
                        <span class="block">
                            Sair
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @endauth
    @guest
    <main class="flex h-full pt-16">
        {{ $slot }}
    </main>
    @endguest

    @livewireScripts

    <livewire:modal-delete />
    <livewire:modal-edit />
</body>

</html>