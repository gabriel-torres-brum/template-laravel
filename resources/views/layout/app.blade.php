<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    <header class="fixed top-0 inset-x-0 navbar bg-base-100 border-b border-base-content/20 h-16 z-30 px-4">
        <div class="flex-none">
            <label for="drawer" class="btn btn-square btn-ghost drawer-button btn-sm lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-5 h-5 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </label>
        </div>
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl">Sistema</a>
        </div>
        <div class="flex-none">
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://placeimg.com/80/80/people" />
                    </div>
                </label>
                <ul tabindex="0"
                    class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <a class="justify-between">
                            Profile
                            <span class="badge">New</span>
                        </a>
                    </li>
                    <li><a>Settings</a></li>
                    <li><a>Logout</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="drawer drawer-mobile">
        <input id="drawer" type="checkbox" class="drawer-toggle"  />
        <div class="drawer-content flex flex-col">
            <!-- Page content here -->
            <main class='mt-16'>
                @yield('content')
            </main>
        </div>
        <div class="drawer-side mt-16">
            <label for="drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 overflow-y-auto w-72 bg-base-100 border-r border-base-content/20">
                <!-- Sidebar content here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
            </ul>
        </div>
    </div>
</body>

</html>
