<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\CustomerSupport;
use App\Notifications\CustomerSupportAcknowledgement;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class ContactForm extends Form
{
    #[Validate('required|string|min:3')]
    public string $name;

    #[Validate('required|email')]
    public string $email;

    #[Validate('required|string')]
    public string $subject;

    #[Validate('required|string')]
    public string $message;

    #[Validate('required|string|min:10|max:12')]
    public string $phone_number;

    /**
     * @throws ValidationException
     */
    public function store(): void
    {
        $this->validate();

        $support = CustomerSupport::create($this->all());

        Notification::route('mail', $this->email)
            ->notify(new CustomerSupportAcknowledgement($support));
    }
}
