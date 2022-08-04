<div class="flex flex-col gap-2">
  <span class="flex-1 text-lg font-bold">
      @if ($item)
      Editando informações de {{ $item->name }}
      @else
      Incluir membro
      @endif
  </span>
  <div class="grid grid-cols-12 gap-2">
    <div class="col-span-12">
      <x-input.primary field="name" label="Nome" type="text" wire:model.lazy="item.name"  class="w-full" />
    </div>
    <div class="col-span-6">
      <x-input.primary field="birthday" label="Aniversário" type="text" x-mask="99/99/9999" class="w-full" wire:model.lazy="item.birthday" wire:change="$set('item.birthday', item.birthday->format('d/m/Y'))" />
    </div>
    <div class="col-span-6">
      <x-select.primary field="gender" label="Gênero" type="text" class="w-full" wire:model.lazy="item.gender">
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
      </x-select.primary>
    </div>
    <div class="col-span-6">
      <x-select.primary field="tither" label="Dizimista?" type="text" class="w-full" wire:model.lazy="item.tither">
        <option value="0">Não</option>
        <option value="1">Sim</option>
    </x-select.primary>
    </div>
  </div>
</div>