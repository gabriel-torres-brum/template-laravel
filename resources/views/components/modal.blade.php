<div x-data="{ show: @entangle($attributes->wire('model')) }" x-cloak x-show="show" @keyup.escape.window="show = false" x-transition.opacity.200ms class="fixed inset-0 z-40 flex items-end justify-center border bg-gray-200/40 backdrop-blur-sm sm:items-center border-gray-200/60">
    <div class="w-full p-6 bg-white border border-gray-100 rounded-md shadow-lg sm:max-w-sm md:max-w-md lg:max-w-lg min-h-72">
      {{ $slot }}
    </div>
</div>