<x-modal wire:model="showForm" align="center" z-index="z-40">
    @if ($item)
    <x-card title="Editando informações de {{ $item->name }}">
        <div class="flex flex-col gap-4 p-2">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <x-input label="Nome" wire:model.lazy="item.name" />
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-datetime-picker label="Data de nascimento" wire:model.lazy="item.birthday"
                        parse-format="YYYY-MM-DD" display-format="DD/MM/YYYY" />
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-native-select label="Gênero" :options="['Masculino', 'Feminino']"
                        wire:model.lazy="item.gender" />
                </div>
                <div class="col-span-12">
                    <x-toggle left-label="Dizimista" wire:model.lazy="item.tither" />
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-native-select label="Cargo" :options="$roles" option-label="name" option-value="id"
                        wire:model.lazy="item.role_id" />
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <x-native-select label="Igreja" :options="$churches" option-label="name" option-value="id"
                        wire:model.lazy="item.church_id" />
                </div>
            </div>
            <x-divider>Contato</x-divider>
            <div class="grid grid-cols-12 gap-4">
                <x-button outline label="Abrir telefones" icon="phone" class="col-span-6"
                    onclick="$openModal('showPhonesModal')" />
                <x-modal.card title="Telefones" align="center" wire:model.lazy="showPhonesModal" max-width="lg">
                    <div class="grid grid-cols-12 gap-4 p-4">
                        @foreach ($phones as $key => $phone)
                        <div class="flex items-center justify-between col-span-12 gap-2 md:col-span-6"
                            wire:key='phone_{{$key}}'>
                            <x-inputs.phone icon="phone" mask="['(##) ####-####', '(##) #####-####']"
                                wire:model.lazy="phones.{{ $key }}.phone_number" class="flex-1 w-full pl-10" />
                            <x-button.circle icon="trash" class="flex-none" sm negative
                                wire:click="removePhone({{ $key }})" />
                        </div>
                        @endforeach
                        <div class="col-span-12">
                            <x-button positive icon="plus" label="Adicionar telefone" solid class="w-full"
                                wire:click="addPhone()" />
                        </div>
                    </div>
                    <x-slot name="footer">
                        <div class="flex justify-end">
                            <x-button label="Salvar" positive x-on:click="close" />
                        </div>
                    </x-slot>
                </x-modal.card>
                <x-button outline label="Abrir endereços" icon="book-open" class="col-span-6"
                    onclick="$openModal('showAddressesModal')" />
                <x-modal.card title="Endereços" align="center" wire:model.lazy="showAddressesModal">
                    <div class="grid grid-cols-12 gap-4 p-4">

                        @foreach ($item->addresses as $key => $address)
                        <div x-data="{ 'addressCollapse{{ $key }}': false }"
                            class="flex flex-col col-span-12 border rounded-md border-slate-200 dark:border-slate-700"
                            wire:key='address_{{$key}}'>
                            <div class="flex items-center justify-between gap-2">
                                <button outline x-on:click="addressCollapse{{ $key }} = !addressCollapse{{ $key }}"
                                    class="inline-flex items-center justify-center w-full gap-1 p-2 border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800">
                                    Endereço {{ $key + 1 }}
                                    <x-icon x-cloak x-show="!addressCollapse{{ $key }}" solid name="chevron-left"
                                        class="flex-shrink-0 w-4 h-4" />
                                    <x-icon x-cloak x-show="addressCollapse{{ $key }}" solid name="chevron-down"
                                        class="flex-shrink-0 w-4 h-4" />
                                </button>
                                <x-button.circle icon="trash" class="flex-none mr-2" xs negative
                                    wire:click="removeAddress({{ $key }})" />
                            </div>
                            <div x-show="addressCollapse{{ $key }}" x-collapse
                                class="grid grid-cols-12 gap-4 p-4 shadow border-slate-200 dark:border-slate-700">
                                <div class="col-span-12">
                                    <x-input label="Endereço"
                                        wire:model.lazy="item.addresses.{{ $key }}.address_name" />
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
                        </div>
                        @endforeach
                        <div class="col-span-12">
                            <x-button positive icon="plus" label="Adicionar endereço" solid class="w-full"
                                wire:click="addAddress()" />
                        </div>
                    </div>
                    <x-slot name="footer">
                        <div class="flex justify-end">
                            <x-button label="Salvar" positive x-on:click="close" />
                        </div>
                    </x-slot>
                </x-modal.card>
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
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button label="Cancelar" flat dark x-on:click="close" />
                <x-button label="Salvar" positive spinner="save" wire:click="save" />
            </div>
        </x-slot>
    </x-card>
    @endif
</x-modal>