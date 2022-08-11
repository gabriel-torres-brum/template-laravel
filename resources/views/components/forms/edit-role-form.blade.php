<div class="flex flex-col gap-2 p-2">
    <span class="flex-1 text-lg font-bold">
      @if ($item)
      Editando informações do cargo de {{ $item->description }}
      @else
      Incluir cargo
      @endif
    </span>
    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-12">
        <x-input label="Nome do cargo" wire:model.lazy="item.role_name" />
      </div>
      <div class="col-span-12 sm:col-span-6">
        <x-native-select
          label="Gênero"
          :options="['Masculino', 'Feminino', 'Ambos']"
          wire:model="item.gender"
        />
      </div>
    </div>
  </div>