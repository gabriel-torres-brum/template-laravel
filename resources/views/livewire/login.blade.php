@push('pagetitle', 'Login')
<div class="bg-white dark:bg-gray-900">
    <div class="flex justify-center h-screen">
        <div class="hidden bg-no-repeat bg-cover lg:block lg:w-2/3" style="background-image: url({{asset('images/biblia.jpg')}})">
            <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                <div>
                    <h2 class="text-4xl font-bold text-white">Sistema de gerenciamento para igrejas</h2>
                    
                    <p class="max-w-xl mt-3 text-gray-300">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. In autem ipsa, nulla laboriosam dolores, repellendus perferendis libero suscipit nam temporibus molestiae
                    </p>
                </div>
            </div>
        </div>
        
        <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
            <div class="flex-1">
                <div class="text-center">
                    <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-white">Acesso</h2>
                    
                    <p class="mt-3 text-gray-500 dark:text-gray-300">Insira suas credenciais para continuar</p>
                </div>

                <div class="mt-8">
                    <form wire:submit.prevent="handle">
                        @csrf
                        <x-input.primary field="form.username" label="Usuário" type="text" placeholder="Digite o usuário" class="w-full" wire:model.debounce.1s="form.username" />
                        
                        <div class="mt-6">
                            <div class="flex justify-end mb-2">
                                {{-- <label for="password" class="text-sm text-gray-600 dark:text-gray-200">Password</label> --}}
                                <a href="#" class="text-sm text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline">Esqueceu a senha?</a>
                            </div>

                            <x-input.primary field="form.password" label="Senha" type="password" placeholder="Digite a senha" class="w-full" wire:model.debounce.1s="form.password" />
                        </div>

                        <div class="mt-6">
                            <x-button.contained variant="info" type="submit" class="w-full" wire:loading.attr='disabled'>
                                <x-antdesign-loading-3-quarters-o wire:loading.class="!inline" class="hidden w-6 h-6 animate-spin" />
                                <span wire:loading.class='hidden'>Entrar</span>
                            </x-button.contained>
                        </div>

                    </form>

                    <p class="mt-6 text-sm text-center text-gray-400">
                        Ainda não é cadastrado? <a href="#" class="text-blue-500 focus:outline-none focus:underline hover:underline">Cadastre-se</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>