@push('pagetitle', 'Lista de membros')

<div>
    <div class="flex gap-2 py-4">
        <div class="relative w-full max-w-xs">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-primary" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="search" class="w-full pl-10 rounded-md input input-primary input-sm" wire:model.lazy="search"
                placeholder="Pesquisar membros">
        </div>
        @if ($selectedRows)
        <div class="w-full max-w-xs">
            <button x-on:click="$wire.emit('modal-delete', '\\App\\Models\\Member', $wire.selectedRows)"
                class="normal-case rounded-md btn btn-outline btn-warning btn-sm">
                Deletar selecionados
            </button>
        </div>
        @endif
    </div>
    <div class="relative overflow-x-auto rounded-md shadow-lg shadow-base-200">
        @if ($selectedRows)
        <div class="flex py-2">
            @if ($selectAll)
            <span class='text-sm'>
                <span class='font-medium'>
                    {{ count($selectedRows) }} membros selecionados.
                </span>
            </span>
            @else
            <span class='text-sm'>
                <span class='font-medium'>
                    {{ count($selectedRows) . (count($selectedRows) === 1 ? " membro selecionado." : " membros
                    selecionados.") }}
                </span>
                <a wire:click='selectAll' class='font-bold link link-primary'>
                    Selecionar todos os {{ $members->total() }} membros
                </a>
            </span>
            @endif
        </div>
        @endif
        <table class="w-full text-sm text-left">
            <thead class="text-xs uppercase bg-primary text-primary-content">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input type="checkbox" wire:model="selectAllRows"
                                class="rounded checkbox checkbox-xs bg-primary-content">
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Idade
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gênero
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Igreja
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cargo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Ação
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (count($members) > 0)
                    @foreach ($members as $member)
                    <tr
                        class="font-medium border-b @if ($this->isChecked($member->id)) bg-secondary/60 @else bg-base-100 @endif text-base-content border-base-300">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input type="checkbox" value="{{$member->id}}" wire:model="selectedRows"
                                    class="rounded checkbox checkbox-xs bg-primary-content">
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 whitespace-nowrap">
                            {{$member->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$member->birthday->age}}
                        </td>
                        <td class="px-6 py-4">
                            {{$member->gender}}
                        </td>
                        <td class="px-6 py-4">
                            {{$member->church->church_name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$member->role->description}}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex w-full gap-3">
                                <a wire:click="editItem" class="link text-info">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <a wire:click="$emit('modal-delete', '\\App\\Models\\Member', '{{ $member->id }}', &quot;Deseja realmente excluir o membro {{ $member->name }} do sistema?&quot;)"
                                    class="link text-error">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr class='font-medium border-b bg-base-100 text-base-content border-base-300'>
                        <td colspan='100%' class='px-6 py-4 text-center'>
                            Nenhum item encontrado.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="pt-4">
        {{ $members->links() }}
    </div>
</div>