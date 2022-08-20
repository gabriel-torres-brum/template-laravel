@push('pagetitle', 'Membros')

<div class="h-full">
    <x-table :options="$tableOptions" />

    <livewire:members.create />
    <livewire:members.update />
</div>
