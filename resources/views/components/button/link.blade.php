<button {{ $attributes->merge(['class' => 'flex items-center justify-center gap-2 font-medium tracking-wide text-white transition duration-200 transform bg-transparent text-blue-500 hover:text-blue-600 focus:outline-none text-sm active:scale-[95%]']) }}>
  {{ $slot }}
</button>