@props(['name', 'placeholder'])

@php
    $model_name = $error_name = 'form.' . $name;
@endphp

<div>
    <x-form.input name="{{ $name }}" type="text" value="{{ old($name) }}" placeholder="{{ $placeholder }}" wire:model="{{ $model_name }}">
        {{ $placeholder }}
    </x-form.input>

    @error($error_name)
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>
