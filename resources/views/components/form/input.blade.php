@props(['type' => 'text', 'name' => '', 'value' => '', 'placeholder' => ''])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $slot }}
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400']) }}
    />
</label>
