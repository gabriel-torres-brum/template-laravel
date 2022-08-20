<div
    x-data="wireui_color_picker({
        colorNameAsValue: @boolean($colorNameAsValue),
    
        @if ($attributes->wire('model')->value()) wireModifiers: @js($attributes->wireModifiers()),
        wireModel: @entangle($attributes->wire('model')), @endif
    
        @if ($colors) colors: @js($getColors()) @endif
    })"
    {{ $attributes->only(['class', 'wire:key'])->class('relative') }}
>
    <x-dynamic-component
        {{ $attributes->except(['class', 'wire:key'])->whereDoesntStartWith('wire:model') }}
        :component="WireUi::component('input')"
        x-model="{{ $colorNameAsValue ? 'selected.name' : 'selected.value' }}"
        x-bind:class="{ 'pl-8': selected.value }"
        x-on:input="setColor($event.target.value)"
        x-ref="input"
        :label="$label"
        :prefix="null"
        :icon="null"
    >
        <x-slot name="prefix">
            <template x-if="selected.value">
                <div
                    class="h-4 w-4 rounded border shadow"
                    :style="{ 'background-color': selected.value }"
                ></div>
            </template>
        </x-slot>

        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="h-full rounded-r-md"
                    primary
                    flat
                    squared
                    x-on:click="toggle"
                    trigger
                >
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        class="group-focus:text-primary-700 dark:group-focus:text-primary-500 h-4 w-4 text-zinc-400 dark:text-zinc-600 dark:group-hover:text-zinc-500"
                        :name="$rightIcon"
                    />
                </x-dynamic-component>
            </div>
        </x-slot>
    </x-dynamic-component>

    <x-wireui::parts.popover
        :margin="(bool) $label"
        class="soft-scrollbar border-secondary-200 max-h-56 overflow-y-auto border py-3 px-2 sm:w-72 sm:rounded-xl sm:py-2 sm:px-1"
    >
        <div class="mx-auto flex max-w-[18rem] flex-wrap items-center justify-center gap-1 sm:gap-0.5">
            <span class="sr-only">dropdown-open</span>

            <template
                x-for="(color, index) in colors"
                :key="index"
            >
                <button
                    class="focus:ring-primary-600 sdark:focus:ring-zinc-400 h-6 w-6 cursor-pointer rounded border shadow-lg transition-all duration-100 ease-in-out hover:scale-125 hover:border-zinc-400 focus:outline-none focus:ring-2 dark:border-0 dark:hover:ring-2 dark:hover:ring-zinc-400"
                    :style="{ 'background-color': color.value }"
                    x-on:click="select(color)"
                    :title="color.name"
                    type="button"
                >
                </button>
            </template>
        </div>
    </x-wireui::parts.popover>
</div>
