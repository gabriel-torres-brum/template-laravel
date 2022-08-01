<button {{ $attributes->merge(['class' => 'flex items-center justify-center gap-2 px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-yellow-400 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-yellow-500 focus:ring-opacity-80']) }}>
  {{ $slot }}
</button>