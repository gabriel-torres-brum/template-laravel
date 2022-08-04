<x-modal wire:model='show'>
    <div class="relative flex flex-col h-full p-2">
        @if ($modelName)
            <x-dynamic-component
                :item="$item"
                :component="'forms.edit-'.strtolower($modelName).'-form'"
            />
        @endif
        <div class="flex justify-around mt-auto">
            <x-button.link x-on:click="show = false">
                Cancelar
            </x-button.link>
            <x-button.contained
                variant="danger"
                wire:loading.attr='disabled'
                class="w-28"
                wire:click="update"
            >
                <x-antdesign-loading-o
                    class="hidden w-6 h-6 animate-spin"
                    wire:loading.class.remove='hidden'
                />
                <span wire:loading.class='hidden'>
                    Confirmar
                </span>
            </x-button.contained>
        </div>
    </div>
</x-modal>