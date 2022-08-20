<!DOCTYPE html>
<html
    lang="pt-BR"
    :class="{ 'dark': darkMode }"
    x-data="{ darkMode: $persist(false) }"
>

<head>
    <meta charset="UTF-8">
    <meta
        http-equiv="X-UA-Compatible"
        content="IE=edge"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>@stack('pagetitle')</title>

    <script>
        if (localStorage._x_darkMode === 'true' || (!('_x_darkMode' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
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

<body x-data="{ sidebar: $persist(true) }">
    <x-notifications />
    <x-dialog
        id="delete"
        z-index="z-30"
        align="center"
    />
    @auth
        <x-navbar />
        <x-sidebar />
        <main
            class="h-full px-8 pt-20 transition-all lg:ml-48"
            :class="{ 'lg:ml-48': sidebar }"
        >
            <h3 class='mb-4 text-left text-xl font-bold tracking-wide'>
                @stack('pagetitle')
            </h3>
            {{ $slot }}
        </main>
    @endauth
    @guest
        {{ $slot }}
    @endguest
    @livewireScripts
</body>

</html>
