<aside :class="{ '-translate-x-72': !sidebar }" class="fixed bottom-0 left-0 z-10 flex flex-col w-48 p-2 transition-transform bg-white border-r shadow dark:bg-slate-800 top-16 border-slate-200 dark:border-slate-700">
    <ul class="flex flex-col gap-2">
        <x-navlink icon="home" route="app.dashboard" label="Painel" />
        <x-navlink icon="users" route="app.members-list" label="Membros" />
        <x-navlink icon="identification" route="app.roles-list" label="Cargos" />
    </ul>
</aside>