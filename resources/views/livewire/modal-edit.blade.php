<div x-data="{ show: @entangle('show') }">
    <div x-cloak x-show="show" x-transition.opacity.300ms class="fixed inset-0 z-40 flex items-end justify-center bg-base-300/20 backdrop-blur-sm sm:items-center">
        <div class="w-full h-full max-w-sm p-4 border rounded-md shadow-lg bg-base-200 border-base-300 max-h-32">
            <div class="flex flex-col h-full">
                <h3 class="text-lg font-medium">Editar</h3>
                <small class="text-xs font-bold">{{ $title }}</small>
                <div class="flex justify-between">
                    <button wire:loading.class='loading' wire:click="delete" class="rounded-md btn btn-error btn-sm">Confirmar</button>
                    <button x-on:click="show = false">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>