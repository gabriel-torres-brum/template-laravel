<div class="p-8 bg-white rounded-md shadow">
  <div class="flex flex-col gap-2 registro-center sm:flex-row">
    <div class="relative w-full max-w-xs">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <x-antdesign-search-o class="w-5 h-5" />
      </div>
      <x-input.primary field="search" label="" wire:model.lazy="search" placeholder="Pesquisar registros"
        class="w-full pl-10" />
    </div>
    @if ($selectedRows)
    <x-button.link variant="danger" x-on:click="$wire.emit('modal-delete', '{{ $modelName }}', $wire.selectedRows)"
      class="w-full sm:w-auto">
      <x-antdesign-delete-o class="w-5 h-5 max-w-xs my-2 sm:my-0" />
      <span class="ml-1">Excluir selecionados</span>
    </x-button.link>
    @endif
  </div>
  <div class="flex items-center py-4 text-sm font-light text-center">
    @if ($selectedRows)

    @if ($selectAll)

    <span class="w-full text-zinc-700 sm:w-auto">{{ count($selectedRows) }} registros selecionados</span>

    @else

    <div class="flex flex-col flex-1 gap-2 sm:flex-row">
      <span class="w-full text-zinc-700 sm:w-auto">
        {{ count($selectedRows) . (count($selectedRows) === 1 ? " registro selecionado." : " registros
        selecionados.") }}
      </span>

      <x-button.link variant="info" wire:click='selectAll'>
        Selecionar todos os registros
      </x-button.link>
    </div>

    @endif
    @else
    <span class="w-full text-zinc-700 sm:w-auto">Nenhum registro selecionado</span>
    @endif
  </div>
  <div x-data="{ selectedRows: @entangle('selectedRows'), selectAllRows: @entangle('selectAllRows') }"
    class="relative overflow-x-auto border-t rounded-md border-zinc-200 border-x">
    <table class="w-full text-sm text-left">
      <thead class="text-xs uppercase bg-white border-b border-zinc-200">
        <tr>
          <th scope="col" class="px-6 py-4 border-r border-zinc-200">
            <div class="flex items-center">
              <input type="checkbox" x-model="selectAllRows"
                class="w-4 h-4 text-blue-600 rounded bg-zinc-100 border-zinc-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-zinc-800 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600">
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
        <tr @class([ 'bg-zinc-50'=> !$this->isChecked($item->id),
          'bg-blue-300' => $this->isChecked($item->id),
          'font-medium',
          'border-b',
          'border-zinc-300'
          ])>
          <td class="w-4 px-6 py-4 bg-white border-r border-zinc-200">
            <div class="flex items-center">
              <input type="checkbox" value="{{ $item->id }}" x-model="selectedRows"
                class="w-4 h-4 text-blue-600 bg-white rounded border-zinc-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-zinc-800 focus:ring-2 dark:bg-zinc-700 dark:border-zinc-600">
            </div>
          </td>
          @foreach ($itemValues as $itemValue)
          <td scope="row" class="px-6 py-4 border-r border-zinc-200 whitespace-nowrap">
            {{ eval("echo \$item->$itemValue;"); }}
          </td>
          @endforeach
          <td class="w-10 px-6 py-4 align-middle bg-white">
            <div class="flex w-full gap-2.5">
              <x-button.link variant="info" wire:loading.attr='disabled' wire:target='showEditModal' wire:click.prefetch="$emit('modal-edit', '{{$modelName}}', '{{ $item->id }}')">
                <x-antdesign-edit-o class="w-5 h-5" />
              </x-button.link>
              <x-button.link variant="danger"
                wire:click.prefetch="$emit('modal-delete', '{{$modelName}}', '{{ $item->id }}')">
                <x-antdesign-delete-o class="w-5 h-5" />
              </x-button.link>
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