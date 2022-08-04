<button {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-1 font-medium tracking-wide transition-colors duration-200 transform text-$color-500 hover:text-$color-600 hover:underline bg-transparent appearance-none focus:outline-none"]) }}>
  {{ $slot }}
</button>