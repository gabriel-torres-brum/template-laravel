@push('pagetitle', 'Login')
<div class="bg-white dark:bg-gray-900">
    <div class="flex justify-center h-screen">
        <div class="hidden bg-no-repeat bg-cover lg:block lg:w-2/3"
            style="background-image: url({{asset('images/biblia.jpg')}})">
            <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                <div>
                    <h2 class="text-4xl font-bold text-white">Sistema de gerenciamento para igrejas</h2>

                    <p class="max-w-xl mt-3 text-gray-300">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. In autem ipsa, nulla laboriosam
                        dolores, repellendus perferendis libero suscipit nam temporibus molestiae
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
            <div class="flex flex-col flex-1 gap-4">
                <x-errors />
                <span class="text-sm text-center text-gray-500 dark:text-gray-300">
                    Insira suas credenciais para continuar
                </span>
                <form wire:submit.prevent="handle" class="flex flex-col gap-4">
                    @csrf
                    
                    <x-input icon="user" placeholder="Digite o usuário"
                        wire:model.lazy="username" />

                    <x-input icon="lock-closed" type="password" placeholder="Digite a senha"
                        class="w-full" wire:model.lazy="password" />

                    <div class="flex items-center justify-end gap-2">
                        <a href="#"
                            class="text-sm text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline">Esqueceu
                            a senha?</a>
                        <x-button type="submit" label="Entrar" outline sky wire:loading.attr='disabled' spinner='handle' />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>