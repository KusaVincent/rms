@props(['negotiable'])

@if($negotiable)
    <span class="italic inline-block ml-1 px-2 py-0.5 text-xs font-semibold text-blue-700 bg-blue-100 rounded">
        {{ __('Negotiable') }}
    </span>
@endif
