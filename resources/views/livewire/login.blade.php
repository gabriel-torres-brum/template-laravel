@push('pagetitle', 'Login')
<div class="bg-slate-50 dark:bg-slate-800">
    <div class="flex justify-center h-screen">
        <div class="hidden bg-no-repeat bg-cover lg:block lg:w-2/3"
            style="background-image: url({{asset('images/biblia.jpg')}})">
            <div class="flex items-center h-full px-20 bg-slate-900 bg-opacity-40">
                <div>
                    <h2 class="text-4xl font-bold text-white">Sistema de gerenciamento para igrejas</h2>

                    <p class="max-w-xl mt-3 text-slate-300">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. In autem ipsa, nulla laboriosam
                        dolores, repellendus perferendis libero suscipit nam temporibus molestiae
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
            <div class="flex flex-col flex-1 gap-4 p-4 bg-white rounded-md shadow">
                <x-errors />
                <x-divider>
                    Insira suas credenciais para continuar
                </x-divider>
                <form wire:submit.prevent="handle" class="flex flex-col gap-4">
                    @csrf
                    
                    <x-input label="Usuário ou Email" icon="user" placeholder="Digite o usuário"
                        wire:model.lazy="username" />

                    <x-input label="Senha" icon="lock-closed" type="password" placeholder="Digite a senha"
                        class="w-full" wire:model.lazy="password" />

                    <div class="flex items-center justify-end gap-2">
                        <a href="#"
                            class="text-sm text-slate-400 focus:text-blue-500 hover:text-blue-500 hover:underline">Esqueceu
                            a senha?</a>
                        <x-button type="submit" label="Entrar" outline sky wire:loading.attr='disabled' spinner='handle' />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>