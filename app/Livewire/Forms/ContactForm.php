<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\CustomerSupport;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class ContactForm extends Form
{
    #[Validate('required')]
    public string $name;

    #[Validate('required|email')]
    public string $email;

    #[Validate('required')]
    public string $subject;

    #[Validate('required')]
    public string $message;

    #[Validate('required|min:10|max:12')]
    public string $phone_number;

    public function store(): void
    {
        $this->validate();

        CustomerSupport::create($this->all());
    }
}
