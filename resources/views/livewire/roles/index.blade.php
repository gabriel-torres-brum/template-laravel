@push('pagetitle', 'Cargos')

<div class="h-full">
    <x-table :options="$tableOptions" />

    <livewire:roles.create />
    <livewire:roles.update />
</div>
