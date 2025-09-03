@component('mail::message')
    {{-- Logo --}}
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('storage/logo/logo.png') }}" alt="{{ config('app.name') }} Logo" style="height: 60px;">
    </div>

    # Hello {{ $support->name }},

    Thank you for contacting us. We’ve received your request and here’s a summary:
    **Subject:** {{ $support->subject }}
    **Message:** {{ $support->message }}
    **Phone number on file:** {{ $support->phone_number }}
    --- Our support team will reach out to you at **{{ $support->email }}** within 24 hours.

    @component('mail::button', ['url' => config('app.url')])
        Visit Our Website
    @endcomponent

    Thanks, The Support Team
@endcomponent
