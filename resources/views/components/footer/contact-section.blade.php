@props(['contacts'])

<div>
    <h3 class="font-bold mb-3">{{ __('Contact Us') }}</h3>
    @foreach($contacts as $contact)
        @if($contact->icon === 'phone')
            <p class="text-sm">
                {{ __('Phone') }}: <a href="{{ $contact->link }}" class="hover:underline">{{ $contact->link_text }}</a>
            </p>
        @endif

        @if($contact->icon === 'envelope')
            <p class="text-sm">
                {{ __('Email') }}: <a href="{{ $contact->link }}" class="hover:underline">{{ $contact->link_text }}</a>
            </p>
        @endif
    @endforeach
    <div class="mt-3">
        <h3 class="font-bold mb-2">{{ __('Follow Us') }}</h3>
        <div class="flex space-x-4">
            @foreach($contacts as $contact)
                @if($contact->icon !== 'phone' && $contact->icon !== 'whatsapp' && $contact->icon !== 'envelope')
                    <a href="{{ $contact->link }}" target="_blank" class="text-gray-400 hover:text-white" wire:navigate>
                        <i class="fab fa-{{ $contact->icon }}"></i>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
