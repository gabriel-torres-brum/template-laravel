<div class="flex flex-col gap-2 p-2">
  <span class="flex-1 text-lg font-bold">
    @if ($item)
    Editando informações de {{ $item->name }}
    @else
    Incluir membro
    @endif
  </span>
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12">
      <x-input label="Nome" wire:model.lazy="item.name" />
    </div>
    <div class="col-span-12 sm:col-span-6">
      <x-datetime-picker
        label="Data de nascimento"
        wire:model.lazy="item.birthday"
        parse-format="YYYY-MM-DD"
        display-format="DD/MM/YYYY"
      />
    </div>
    <div class="col-span-12 sm:col-span-6">
      <x-native-select
        label="Gênero"
        :options="['Masculino', 'Feminino']"
        wire:model="item.gender"
      />
    </div>
    <div class="col-span-12">
      <x-toggle left-label="Dizimista" wire:model.lazy="item.tither" />
    </div>
    <div class="col-span-12 sm:col-span-6">
      <x-native-select
        label="Cargo"
        :options="$roles"
        option-label="name"
        option-value="id"
        wire:model="item.role_id"
      />
    </div>
    <div class="col-span-12 sm:col-span-6">
      <x-native-select
        label="Igreja"
        :options="$churchs"
        option-label="name"
        option-value="id"
        wire:model="item.church_id"
      />
    </div>
  </div>
  <x-divider>Dados de Usuário</x-divider>
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-12">
      <x-input label="Usuário" wire:model.lazy="item.user.username" />
    </div>
    <div class="col-span-12">
      <x-input label="E-mail" wire:model.lazy="item.user.email" />
    </div>
    <div class="col-span-12">
      <x-toggle left-label="Administrador" wire:model.lazy="item.user.admin" />
    </div>
  </div>
</div>