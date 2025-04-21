<div>
    <h3 class="font-bold mb-3">{{ __('Resources') }}</h3>
    <ul class="space-y-2 text-sm">
        <li><a href="{{ url('faq') }}" class="hover:underline" wire:navigate>{{ __('FAQs') }}</a></li>
        <li><a href="{{ url('blogs') }}" class="hover:underline" wire:navigate>{{ __('Blog') }}</a></li>
        <li><a href="{{ url('contact') }}" class="hover:underline" wire:navigate>{{ __('Support') }}</a></li>
        <li><a href="{{ url('guides') }}" class="hover:underline" wire:navigate>{{ __('Property Guides') }}</a></li>
    </ul>
</div>
