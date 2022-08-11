<header
    class="fixed inset-x-0 top-0 z-20 flex items-center justify-between h-16 px-6 bg-white border-b border-slate-200 dark:border-slate-700 dark:bg-slate-800">
    <div class="flex items-center flex-1 gap-2">
        <x-button.circle icon="menu" outline x-on:click="sidebar = ! sidebar" />
        <span class="text-lg">Sistema</span>
    </div>
    <div x-data="{ dropdown: false }" class="relative">
        <x-button.circle icon="user" outline x-on:click="dropdown = !dropdown" />
        <div x-cloak x-show="dropdown" x-on:click.away="dropdown = false"
            class="absolute flex flex-col mt-6 text-sm bg-white border rounded shadow border-slate-100 dark:border-gray-900 dark:bg-slate-800 -ml-28 w-36 after:rotate-45 after:bg-white dark:after:bg-slate-800 after:absolute after:-top-2 after:right-2 after:-z-10 after:w-4 after:h-4 after:shadow">
            <button x-on:click="darkMode = !darkMode"
                class="relative inline-flex flex-1 p-3 transition-colors rounded-t hover:bg-slate-100 dark:hover:bg-slate-700"
                href="javascript:void(0)">
                <x-icon x-cloak x-show="darkMode" name="sun" class="absolute left-0 w-5 h-5 ml-2.5" />
                <x-icon x-cloak x-show="!darkMode" name="moon" class="absolute left-0 w-5 h-5 ml-2.5" />
                <span class="ml-6">Tema</span>
            </button>
            <a href="{{ route('logout') }}"
                class="relative inline-flex flex-1 p-3 transition-colors rounded-b hover:bg-slate-100 dark:hover:bg-slate-700"
                href="javascript:void(0)">
                <x-icon name="logout" class="absolute left-0 w-5 h-5 ml-2.5" />
                <span class="ml-6">Sair</span>
            </a>
        </div>
    </div>
</header>