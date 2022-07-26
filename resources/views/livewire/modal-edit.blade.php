<div x-data="{ show: @entangle('show') }">
    <div x-cloak x-show="show" x-transition.opacity.200ms class="fixed inset-0 z-40 flex items-end justify-center bg-base-300/20 backdrop-blur-md sm:items-center">
        <div class="w-full h-full max-w-sm p-4 border rounded-md shadow-lg bg-base-200 border-base-300 max-h-56">
            <div class="flex flex-col h-full">
                <span class="text-sm font-bold">{{ $title }}</span>
                <form wire:submit.prevent='edit'>
                </form>
                <div class="flex justify-between mt-auto">
                    <button x-on:click="show = false" wire:click="hide">Cancelar</button>
                    <button wire:loading.class='loading' type="submit" class="rounded-md btn btn-warning btn-sm">
                        @if ($itemId) Editar @else Incluir @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>