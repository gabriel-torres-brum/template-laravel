<x-modal.card
    wire:model="show"
    align="center"
    z-index="z-40"
>
    <x-slot name="title">
        Editando informações de {{ $member->name ?? null }}
    </x-slot>
    <x-errors />
    <form class="flex flex-col gap-4 p-2">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-input
                    label="Nome"
                    wire:model.defer="member.name"
                />
            </div>
            <div class="col-span-12 sm:col-span-6">
                <x-datetime-picker
                    label="Data de nascimento"
                    without-timezone
                    without-time
                    wire:model.defer="member.birthday"
                    parse-format="YYYY-MM-DD"
                    display-format="DD/MM/YYYY"
                />
            </div>
            <div class="col-span-12 sm:col-span-6">
                <x-native-select
                    label="Gênero"
                    :options="['Masculino', 'Feminino']"
                    wire:model="member.gender"
                />
            </div>
            <div class="col-span-12">
                <x-toggle
                    left-label="Dizimista"
                    wire:model.defer="member.tither"
                />
            </div>
            <div class="col-span-12 sm:col-span-6">
                <x-native-select
                    label="Cargo"
                    :options="$roles"
                    option-label="name"
                    option-value="id"
                    wire:model.lazy="member.role_id"
                />
            </div>
            <div class="col-span-12 sm:col-span-6">
                <x-native-select
                    label="Igreja"
                    :options="$churches"
                    option-label="name"
                    option-value="id"
                    wire:model.lazy="member.church_id"
                />
            </div>
        </div>

        <x-divider>Contato</x-divider>

        <div class="grid grid-cols-12 gap-4">
            <x-button
                primary
                label="Abrir telefones"
                icon="phone"
                class="col-span-12 md:col-span-6"
                onclick="$openModal('showAddPhones')"
            />

            <x-button
                outline
                label="Abrir endereços"
                icon="book-open"
                class="col-span-12 md:col-span-6"
                onclick="$openModal('showAddAddresses')"
            />
        </div>

        <x-divider>Dados de Usuário</x-divider>

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 md:col-span-6">
                <x-input
                    label="Usuário"
                    wire:model.defer="user.username"
                />
            </div>
            <div class="col-span-12 md:col-span-6">
                <x-input
                    label="E-mail"
                    wire:model.defer="user.email"
                />
            </div>
            <div class="col-span-12 flex justify-between">
                <x-toggle
                    left-label="Administrador"
                    wire:model.defer="user.admin"
                />
                <div class="flex flex-col text-right text-xs">
                    Senha de usuário padrão: <span class="font-bold">123456</span>
                </div>
            </div>
        </div>
        <div class="flex flex-1 justify-center">
            <span class="text-light py-2 text-xs">
                Um link de mudança de senha é enviado para o email informado assim que o usuário é criado.
            </span>
        </div>
    </form>
    <x-slot name="footer">
        <div class="flex justify-end gap-x-4">
            <x-button
                label="Cancelar"
                flat
                dark
                x-on:click="close"
            />
            <x-button
                label="Salvar"
                positive
                spinner="save"
                wire:click="save"
            />
        </div>
    </x-slot>
    <x-modal.card
        align="center"
        max-width="md"
        wire:model.defer="showAddPhones"
    >
        <x-slot name="title">
            Telefones
        </x-slot>
        <div class="flex flex-col gap-2 px-2">
            @foreach ($phones as $key => $phone)
                <form
                    class="relative flex items-center"
                    wire:key='phone_{{ $key }}'
                >
                    <x-input
                        x-mask:dynamic="$input.indexOf('9', 5) === 5 ? '(99) 99999-9999' : '(99) 9999-9999'"
                        icon="phone"
                        wire:model.defer="phones.{{ $key }}.phone_number"
                        class="px-10"
                        autofocus
                    />
                    <x-button.circle
                        icon="trash"
                        negative
                        xs
                        class="absolute top-0 right-0 m-1.5"
                        wire:click="removePhone({{ $key }})"
                    />
                </form>
            @endforeach
            <div>
                <x-button
                    full
                    positive
                    label="Adicionar telefone"
                    wire:click="addPhone"
                />
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end">
                <x-button
                    label="Salvar"
                    positive
                    x-on:click="close"
                />
            </div>
        </x-slot>
    </x-modal.card>
    <x-modal.card
        align="center"
        max-width="md"
        wire:model.defer="showAddAddresses"
    >
        <x-slot name="title">
            Endereços
        </x-slot>
        <div class="flex flex-col gap-2 px-2">
            @foreach ($addresses as $key => $address)
                <form
                    class="flex items-center gap-2"
                    wire:key='address_{{ $key }}'
                >
                    <div
                        x-data="{ address_collapse: false }"
                        class="relative flex flex-1 flex-col gap-1"
                    >
                        <x-button
                            right-icon="chevron-down"
                            label="Endereço {{ $key + 1 }}"
                            x-on:click="address_collapse = !address_collapse"
                            full
                            primary
                            outline
                        />

                        <x-button.circle
                            icon="trash"
                            negative
                            xs
                            class="absolute top-0 right-0 m-[.30rem]"
                            wire:click="removeAddress({{ $key }})"
                        />

                        <div
                            x-show="address_collapse"
                            x-collapse
                            class="flex p-4 shadow-md"
                        >
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-6">
                                    <x-input
                                        label="Endereço"
                                        wire:model.defer="addresses.{{ $key }}.address_name"
                                        autofocus
                                    />
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <x-input
                                        label="Nº"
                                        wire:model.defer="addresses.{{ $key }}.number"
                                    />
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <x-input
                                        label="Complemento"
                                        wire:model.defer="addresses.{{ $key }}.adjunct"
                                    />
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <x-input
                                        label="Bairro"
                                        wire:model.defer="addresses.{{ $key }}.district"
                                    />
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <x-input
                                        label="Cidade"
                                        wire:model.defer="addresses.{{ $key }}.city"
                                    />
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <x-input
                                        label="UF"
                                        x-mask="aa"
                                        wire:model.defer="addresses.{{ $key }}.state"
                                    />
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <x-input
                                        label="CEP"
                                        x-mask="99999-999"
                                        wire:model.defer="addresses.{{ $key }}.cep"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
            <div>
                <x-button
                    full
                    positive
                    label="Adicionar endereço"
                    wire:click="addAddress"
                />
            </div>
        </div>
        <x-slot name="footer">
            <div class="flex justify-end">
                <x-button
                    label="Salvar"
                    positive
                    x-on:click="close"
                />
            </div>
        </x-slot>
    </x-modal.card>
</x-modal.card>
