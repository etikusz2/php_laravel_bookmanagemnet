@props(['name', 'label' => ''])

<label for="{{ $name }}" class="block mb-2 uppercase font-bold text-xs text-gray-700">
    {{ $label ?: ucwords(str_replace('_', ' ', $name)) }}
</label>
