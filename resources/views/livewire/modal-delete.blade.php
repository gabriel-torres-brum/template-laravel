<x-modal wire:model='show'>
    <div class="flex flex-col h-full text-center">
        <h3 class="text-lg font-medium">Atenção</h3>
        <span class="flex-1 text-lg font-bold">{{ $title }}</span>
        <span class="py-4 mt-auto tracking-wide text-center text-amber-600">Essa ação não poderá ser desfeita</span>
        <div class="flex justify-around">
            <x-button.link variant="info" x-on:click="show = false" class="!text-gray-700 hover:!text-gray-800">
                Cancelar
            </x-button.link>
            <x-button.contained variant="danger" wire:loading.attr='disabled' wire:click="delete" wire:target='delete'
                class="w-28">
                <x-antdesign-loading-o class="hidden w-6 h-6 animate-spin" wire:loading.class.remove='hidden' />
                <span wire:loading.class='hidden'>
                    Confirmar
                </span>
            </x-button.contained>
        </div>
    </div>
</x-modal>