@push('pagetitle', 'Login')
<div class="bg-zinc-50 dark:bg-zinc-800">
    <div class="flex h-screen justify-center">
        <div
            class="hidden bg-cover bg-no-repeat lg:block lg:w-2/3"
            style="background-image: url({{ asset('images/biblia.jpg') }})"
        >
            <div class="flex h-full items-center bg-zinc-900 bg-opacity-40 px-20">
                <div>
                    <h2 class="text-4xl font-bold text-white">Sistema de gerenciamento para igrejas</h2>

                    <p class="mt-3 max-w-xl text-zinc-300">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. In autem ipsa, nulla laboriosam
                        dolores, repellendus perferendis libero suscipit nam temporibus molestiae
                    </p>
                </div>
            </div>
        </div>

        <div class="mx-auto flex w-full max-w-md items-center px-6 lg:w-2/6">
            <div class="flex flex-1 flex-col gap-4 rounded-md bg-white p-4 shadow">
                <x-errors />
                <x-divider>
                    Insira suas credenciais para continuar
                </x-divider>
                <form
                    wire:submit.prevent="handle"
                    class="flex flex-col gap-4"
                >
                    @csrf

                    <x-input
                        label="Usuário ou Email"
                        icon="user"
                        placeholder="Digite o usuário"
                        wire:model.lazy="username"
                    />

                    <x-input
                        label="Senha"
                        icon="lock-closed"
                        type="password"
                        placeholder="Digite a senha"
                        class="w-full"
                        wire:model.lazy="password"
                    />

                    <div class="flex items-center justify-end gap-2">
                        <a
                            href="#"
                            class="text-sm text-zinc-400 hover:text-blue-500 hover:underline focus:text-blue-500"
                        >Esqueceu
                            a senha?</a>
                        <x-button
                            type="submit"
                            label="Entrar"
                            outline
                            sky
                            wire:loading.attr='disabled'
                            spinner='handle'
                        />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
