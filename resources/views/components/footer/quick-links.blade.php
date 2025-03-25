<div>
    <h3 class="font-bold mb-3">{{ __('Quick Links') }}</h3>
    <ul class="space-y-2 text-sm">
        <li><a href="{{ url('about') }}" class="hover:underline" wire:navigate>{{ __('About Us') }}</a></li>
        <li><a href="{{ url('contact') }}" class="hover:underline" wire:navigate>{{ __('Contact Us') }}</a></li>
        <li><a href="{{ url('privacy') }}" class="hover:underline" wire:navigate>{{ __('Privacy Policy') }}</a></li>
        <li><a href="{{ url('terms') }}" class="hover:underline" wire:navigate>{{ __('Terms & Conditions') }}</a></li>
    </ul>
</div>
