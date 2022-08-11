<x-modal wire:model="show" align="center" z-index="z-40">
    <x-card>
        @if ($modelName)
        @livewire('forms.edit-'.strtolower($modelName).'-form', ['item' => $item])
        @endif
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button label="Cancelar" flat dark x-on:click="close" />
                <x-button label="Salvar" positive spinner="save" wire:click="save" />
            </div>
        </x-slot>
    </x-card>
</x-modal>