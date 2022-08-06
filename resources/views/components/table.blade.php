<div x-data="{ selectedRows: @entangle('selectedRows'), selectAllRows: @entangle('selectAllRows') }" class="p-8 bg-white rounded-md shadow">
  <div class="flex flex-col gap-2 registro-center sm:flex-row">
    <div class="relative w-full max-w-xs">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <x-antdesign-search-o class="w-5 h-5" />
      </div>
      <x-input
        icon="search"
        wire:model.lazy="search"
        placeholder="Pesquisar registros"
      />
    </div>
    @if ($selectedRows)
    <x-button
      icon="trash"
      label="Excluir selecionados"
      x-on:confirm="{
        id: 'delete',
        title: 'Deseja mesmo excluir {{ count($selectedRows) }} registros?',
        icon: 'error',
        accept: {
          label: 'Excluir',
        },
        reject: {
          label: 'Cancelar',
        },
        method: 'delete',
      }"
      negative
      outline
    />
    @endif
  </div>
  <div class="flex items-center py-4 text-sm font-light text-center">
    @if ($selectedRows)

    @if ($selectAll)

    <span class="w-full py-2 text-zinc-700 sm:w-auto">{{ count($selectedRows) }} registros selecionados</span>

    @else

    <div class="flex flex-col items-center flex-1 gap-2 sm:flex-row">
      <span class="w-full text-zinc-700 sm:w-auto">
        {{ count($selectedRows) . (count($selectedRows) === 1 ? " registro selecionado." : " registros
        selecionados.") }}
      </span>

      <x-button
        label="Selecionar todos os registros"
        info
        flat
        wire:click='selectAll'
      />
    </div>

    @endif
    @else
    <span class="w-full py-2 text-zinc-700 sm:w-auto">Nenhum registro selecionado</span>
    @endif
  </div>
  <div class="relative overflow-x-auto border-t rounded-md border-zinc-200 border-x soft-scrollbar">
    <table class="w-full text-sm text-left">
      <thead class="text-xs uppercase bg-white border-b border-zinc-200">
        <tr>
          <th scope="col" class="px-6 py-4 border-r border-zinc-200">
            <div class="flex items-center">
              <x-checkbox x-model="selectAllRows" />
            </div>
          </th>
          @foreach ($itemNames as $itemName)
          <th scope="col" class="px-6 py-4 border-r border-zinc-100">
            {{ $itemName }}
          </th>
          @endforeach
          <th scope="col" class="px-6 py-4 text-center align-middle border-r border-zinc-100">
            Ações
          </th>
        </tr>
      </thead>
      <tbody>
        @forelse ($itens as $item)
        <tr
          wire:key="table-item-{{ $item->id }}"
          @class([
            'bg-zinc-50'=> !$this->isChecked($item->id),
            'bg-blue-300' => $this->isChecked($item->id),
            'font-medium',
            'border-b',
            'border-zinc-300'
          ])>
          <td class="w-4 px-6 py-4 bg-white border-r border-zinc-200">
            <div class="flex items-center">
              <x-checkbox
                value="{{ $item->id }}"
                x-model="selectedRows"
              />
            </div>
          </td>
          @foreach ($itemValues as $itemValue)
          <td scope="row" class="px-6 py-4 border-r border-zinc-200 whitespace-nowrap">
            {{ eval("echo \$item->$itemValue;"); }}
          </td>
          @endforeach
          <td class="w-10 px-6 py-4 align-middle bg-white">
            <div class="flex w-full gap-2.5">
              <x-button.circle
                icon="pencil-alt"
                info
                flat
                spinner="edit"
                wire:click="edit('{{ $item->id }}')"
              />
              <x-button.circle
                icon="trash"
                negative
                flat
                spinner='delete'
                x-on:confirm="{
                  id: 'delete',
                  title: 'Deseja mesmo excluir esse registro?',
                  icon: 'error',
                  accept: {
                    label: 'Excluir',
                  },
                  reject: {
                    label: 'Cancelar',
                  },
                  method: 'delete',
                  params: '{{ $item->id }}'
                }"
                {{-- wire:click="$emit('modal-delete', '{{$modelName}}', '{{ $item->id }}')" --}}
              />
            </div>
          </td>
        </tr>
        @empty
        <tr class='font-medium border-b bg-zinc-700-100 text-zinc-700-content border-zinc-700-300'>
          <td colspan='100%' class='px-6 py-4 text-center'>
            Nenhum item encontrado.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="pt-4">
    {{ $itens->links() }}
  </div>
</div>