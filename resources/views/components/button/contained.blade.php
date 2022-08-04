<button {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-1 h-8 font-medium text-zinc-100 tracking-wide transition-colors duration-200 transform bg-$color-500 rounded-md hover:bg-$color-600 focus:outline-none focus:ring focus:ring-$color-300 focus:ring-opacity-80"]) }}>
  {{ $slot }}
</button>