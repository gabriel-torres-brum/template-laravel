<div>
  @if ($label)
  <label for="{{ $field }}" class="block mb-2 text-sm text-gray-600 dark:text-gray-200">{{ $label }}</label>
  @endif
  <select name="{{ $field }}" id="{{ $field }}" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $attributes->merge(["class" => "rounded-md " . ($errors->get($field) ? 'border-red-600 focus:ring-red-600 focus:border-red-600' : '')])}}
  >
    {{ $slot }}
  </select>
</div>