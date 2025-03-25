@props(['icon', 'count', 'label'])

<div class="counter-box">
    <i class="{{ $icon }} text-4xl mb-4"></i>
    <h1 class="text-3xl font-bold">{{ $count }}</h1>
    <h5 class="text-lg">{{ $label }}</h5>
</div>
