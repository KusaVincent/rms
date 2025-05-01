<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact as ModelsContact;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class Contact extends Component
{
    public ContactForm $form;

    public function save()
    {
        $this->form->store();

        session()->flash('message', 'Your message has been sent successfully!');
        ToastMagic::success('Your message has been sent successfully!');

        return $this->redirect('/contact');
    }

    public function render(): View
    {
        return view('livewire.contact', [
            'contacts' => ModelsContact::where('section', '!=', 'footer')->get(),
        ]);
    }
}
