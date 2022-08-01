<button {{ $attributes->merge(['class' => 'flex items-center justify-center gap-2 px-2 py-2 font-medium tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-600 rounded-md hover:bg-red-500 focus:outline-none focus:ring focus:ring-red-300 focus:ring-opacity-80']) }}>
  {{ $slot }}
</button>