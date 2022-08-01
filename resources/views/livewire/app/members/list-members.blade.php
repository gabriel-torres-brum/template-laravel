@push('pagetitle', 'Lista de membros')

<div class="p-8 bg-white rounded-md shadow">
    <div class="flex flex-col gap-2 item-center sm:flex-row">
        <div class="relative w-full max-w-xs">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <x-antdesign-search-o class="w-5 h-5" />
            </div>
            <x-inputs.input-primary field="search" label="" wire:model.lazy="search" placeholder="Pesquisar membros"
                class="w-full pl-10" />
        </div>
        @if ($selectedRows)
            <x-button.link x-on:click="$wire.emit('modal-delete', 'Member', &quot;Deseja realmente excluir {{ count($selectedRows) }} membros do sistema?&quot;, $wire.selectedRows)" class="w-full text-red-500 rounded-md sm:w-auto hover:text-red-600">
                <x-antdesign-delete-o class="w-5 h-5 max-w-xs my-2 sm:my-0" />
                <span class="ml-1">Excluir selecionados</span>
            </x-button.link>
        @endif
    </div>
    <div class="flex items-center py-4 text-sm font-light text-center">
        @if ($selectedRows)

            @if ($selectAll)

            <span class="w-full text-base sm:w-auto">{{ count($selectedRows) }} membros selecionados</span>

            @else

            <div class="flex flex-col flex-1 gap-2 sm:flex-row">
                <span class="w-full text-base sm:w-auto">
                    {{ count($selectedRows) . (count($selectedRows) === 1 ? " membro selecionado." : " membros selecionados.") }}
                </span>
            
                <x-button.link wire:click='selectAll'>
                    Selecionar os {{ $members->total() }} membros
                </x-button.link>
            </div>

            @endif
        @else
        <span class="w-full text-base sm:w-auto">Nenhum membro selecionado</span>
        @endif
    </div>
    <div x-data="{ selectedRows: @entangle('selectedRows'), selectAllRows: @entangle('selectAllRows') }" class="relative overflow-x-auto border-t border-gray-100 rounded-md border-x bg-gray-50">
        <table class="w-full text-sm text-left">
            <thead class="text-xs uppercase bg-white">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input type="checkbox" x-model="selectAllRows"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                    @class([
                        'bg-gray-50' => !$this->isChecked($member->id),
                        'bg-blue-100' => $this->isChecked($member->id),
                        'font-medium',
                        'border-b',
                        'border-gray-300'
                    ])>
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input type="checkbox" value="{{$member->id}}" x-model="selectedRows"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                        {{$member->church->church_name ?? 'Nenhuma'}}
                    </td>
                    <td class="px-6 py-4">
                        {{$member->role->description ?? 'Nenhum'}}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex w-full gap-2.5">
                            <x-button.link {{-- wire:click="editItem" --}} >
                                <x-antdesign-edit-o class="w-5 h-5" />
                            </x-button.link>
                            <x-button.link x-on:click="$wire.emit('modal-delete', 'Member', &quot;Deseja realmente excluir o membro {{ $member->name }} do sistema?&quot;, '{{ $member->id }}')" class="active:border-red-500">
                                <x-antdesign-delete-o class="w-5 h-5 text-red-500 hover:text-red-600" />
                            </x-button.link>
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