<div
    x-data="wireui_timepicker({
        model: @entangle($attributes->wire('model')),
        config: {
            isLazy: @boolean($attributes->wire('model')->hasModifier('lazy')),
            interval: @js($interval),
            format: @js($format),
            is12H: @boolean($format == '12'),
            readonly: @boolean($readonly),
            disabled: @boolean($disabled),
        },
    })"
    x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
    x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
    x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
    class="relative w-full"
    {{ $attributes->only('wire:key') }}
>
    <div class="relative">
        <x-dynamic-component
            :component="WireUi::component('input')"
            {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key']) }}
            :borderless="$borderless"
            :shadowless="$shadowless"
            :label="$label"
            :hint="$hint"
            :corner-hint="$cornerHint"
            :icon="$icon"
            :prefix="$prefix"
            :prepend="$prepend"
            x-model="input"
            x-on:input.debounce.150ms="onInput($event.target.value)"
            x-on:blur="emitInput"
        >
            <x-slot name="append">
                <div class="z-5 absolute inset-y-0 right-3 flex items-center justify-center">
                    <div @class([
                        'flex items-center gap-x-2 my-auto',
                        'text-negative-400 dark:text-negative-600' => $name && $errors->has($name),
                        'text-secondary-400' => $name && $errors->has($name),
                    ])>
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            class="hover:text-negative-500 h-4 w-4 cursor-pointer transition-colors duration-150 ease-in-out"
                            x-cloak
                            name="x"
                            x-show="!config.readonly && !config.disabled && input"
                            x-on:click="clearInput"
                        />

                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            class="h-5 w-5 cursor-pointer text-zinc-400 dark:text-zinc-600"
                            name="clock"
                            x-show="!config.readonly && !config.disabled"
                            x-on:click="toggle"
                        />
                    </div>
                </div>
            </x-slot>
        </x-dynamic-component>
    </div>

    <x-wireui::parts.popover
        :margin="(bool) $label"
        class="p-2.5"
    >
        <x-dynamic-component
            :component="WireUi::component('input')"
            :label="trans('wireui::messages.selectTime')"
            tabindex="0"
            x-model="search"
            x-bind:placeholder="input ? input : '12:00'"
            x-ref="search"
            x-on:input.debounce.150ms="onSearch($event.target.value)"
        />

        <ul class="soft-scrollbar mt-1 h-64 w-full overflow-y-auto pb-1 pt-2 sm:h-32">
            <template x-for="time in filteredTimes">
                <li
                    class="group focus:bg-primary-100 hover:bg-primary-600 dark:hover:bg-secondary-700 relative cursor-pointer select-none rounded-md py-2 pl-2 pr-9 hover:text-white focus:outline-none"
                    :class="{
                        'text-primary-600 dark:text-secondary-400': input === time.value,
                        'text-secondary-700 dark:text-secondary-400': input !== time.value,
                    }"
                    tabindex="0"
                    x-on:keydown.enter="selectTime(time)"
                    x-on:click="selectTime(time)"
                >
                    <span
                        x-text="time.label"
                        class="block truncate font-normal"
                    ></span>
                    <span
                        class="text-primary-600 dark:text-secondary-400 absolute inset-y-0 right-0 flex items-center pr-4 group-hover:text-white"
                        x-show="input === time.value"
                    >
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            name="check"
                            class="h-5 w-5"
                        />
                    </span>
                </li>
            </template>
        </ul>
    </x-wireui::parts.popover>
</div>
