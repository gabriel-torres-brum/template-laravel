<label
    {{ $attributes->class([
        'block text-sm font-medium',
        'text-negative-600' => $hasError,
        'opacity-60' => $attributes->get('disabled'),
        'text-zinc-700 dark:text-zinc-400' => !$hasError,
    ]) }}
>
    {{ $label ?? $slot }}
</label>
