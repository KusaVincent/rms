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

        //        ToastMagic::success('Your message has been sent successfully!');

        return redirect()->back()->with('message', 'Your message has been sent successfully!');
    }

    public function render(): View
    {
        return view('livewire.contact', [
            'contacts' => ModelsContact::whereNot('section', 'footer')->get(),
        ]);
    }
}
