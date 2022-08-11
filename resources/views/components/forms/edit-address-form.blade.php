<div {{ $attributes->merge(['class' => 'grid grid-cols-12 gap-4 p-4 shadow border-slate-200 dark:border-slate-700']) }}>
    <div class="col-span-12">
        <x-input label="Endereço" wire:model.lazy="item.addresses.{{ $key }}.address_name" />
    </div>
    <div class="col-span-12 md:col-span-6">
        <x-input label="Número" wire:model.lazy="item.addresses.{{ $key }}.number" />
    </div>
    <div class="col-span-12 md:col-span-6">
        <x-input label="Complemento" wire:model.lazy="item.addresses.{{ $key }}.adjunct" />
    </div>
    <div class="col-span-12 md:col-span-4">
        <x-input label="Bairro" wire:model.lazy="item.addresses.{{ $key }}.district" />
    </div>
    <div class="col-span-12 md:col-span-4">
        <x-input label="Cidade" wire:model.lazy="item.addresses.{{ $key }}.city" />
    </div>
    <div class="col-span-12 md:col-span-4">
        <x-input label="UF" x-mask="aa" wire:model.lazy="item.addresses.{{ $key }}.state" />
    </div>
</div>