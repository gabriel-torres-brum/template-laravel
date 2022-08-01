<div x-data="{ show: @entangle($attributes->wire('model')) }">
  <div x-cloak x-show="show" x-transition.opacity.200ms class="fixed inset-0 z-40 flex items-end justify-center bg-transparent backdrop-blur-sm sm:items-center">
      <div class="w-full h-full max-w-sm p-4 bg-white border rounded-md shadow-lg border-gray-100 max-h-56">
        {{ $slot }}
      </div>
  </div>
</div>