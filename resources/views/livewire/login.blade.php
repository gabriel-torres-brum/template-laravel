<div class="flex items-center justify-center flex-1">
    <div class="flex flex-col justify-center flex-1 h-full max-w-sm p-6 mx-6 border rounded-md shadow-xl max-h-80 border-base-200 bg-base-100">
        <h4 class="text-xl font-normal text-center text-primary">Acesso</h4>
        <form wire:submit.prevent="handle" class="gap-3 form-control">
            <div class="my-3 text-xs font-light tracking-wide divider">Informe suas credenciais</div>
            @csrf
            <div class="gap-2 form-control">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 @if($errors->has('form.username')) text-error @else text-primary @endif" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.defer="form.username"
                        class="w-full pl-10 rounded-md input @if($errors->has('form.username')) input-error @else input-primary @endif input-sm" placeholder="Nome de usuário" />
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 @if($errors->has('form.password')) text-error @else text-primary @endif" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" wire:model.defer="form.password"
                        class="w-full pl-10 rounded-md input @if($errors->has('form.password')) input-error @else input-primary @endif input-sm" placeholder="Senha" />
                </div>
            </div>
            <div class="flex justify-between">
                <button wire:loading.class="loading" class="rounded-md btn btn-primary btn-sm">
                    Acessar
                </button>
                <a href="#" class="font-medium btn-sm btn-link btn-primary">
                    Esqueceu sua senha?
                </a>
            </div>
        </form>
    </div>

</div>