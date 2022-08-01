<x-modal wire:model='show'>
    <div class="flex flex-col h-full">
        <h3 class="text-lg font-medium text-center">Atenção</h3>
        <span class="mt-auto text-sm font-bold">{{ $title }}</span>
        <span class="py-4 mt-auto text-center">Essa ação não poderá ser desfeita</span>
        <div class="flex justify-between">
            <x-button.link x-on:click="show = false" class="!text-gray-700 hover:!text-gray-800">
            Cancelar
            </x-button.link>
            <x-button.danger wire:loading.attr='disabled' wire:click="delete" wire:target='delete' class="w-28">
                <x-antdesign-loading-o class="hidden w-6 h-6 animate-spin" wire:loading.class.remove='hidden'/>
                <span wire:loading.class='hidden'>
                Confirmar
                </span>
            </x-button.danger>
        </div>
    </div>
</x-modal>
