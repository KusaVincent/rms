<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\ContactSection;
use App\Helpers\LogHelper;
use App\Livewire\Forms\ContactForm;
use App\Models\Contact as ModelsContact;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Throwable;

final class Contact extends Component
{
    public ContactForm $form;

    public function save(): RedirectResponse
    {
        $sessionId = session()->getId();
        $user = auth()->user();
        $start = microtime(true);

        try {
            $this->form->store();

            $duration = round((microtime(true) - $start) * 1000, 2);

            LogHelper::success(
                message: 'Contact form submitted successfully.',
                request: request(),
                additionalData: [
                    'component' => 'Contact Livewire Component',
                    'duration_ms' => $duration,
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'session_id' => $sessionId,
                    'form_data' => $this->form->except(['email', 'phone_number']),
                ]
            );
            $this->form->resetForm();

            ToastMagic::success('Your message has been sent successfully!');

            return redirect()->back()->with('message', 'Your message has been sent successfully!');
        } catch (ValidationException $e) {
            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'Contact Livewire Component',
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'session_id' => $sessionId,
                    'form_data' => $this->form->except(['email', 'phone_number']),
                ]
            );

            throw $e;
        } catch (Throwable $e) {
            LogHelper::exception(
                $e,
                request: request(),
                additionalData: [
                    'component' => 'Contact Livewire Component',
                    'user_id' => $user?->id,
                    'user_email' => $user?->email,
                    'session_id' => $sessionId,
                    'form_data' => $this->form->except(['email', 'phone_number']),
                ]
            );

            ToastMagic::error('Failed to send message. Please try again.');

            return redirect()->back()->withErrors(['message' => 'Something went wrong.']);
        }
    }

    public function render(): View
    {
        return view('livewire.contact', [
            'contacts' => ModelsContact::whereNot('section', ContactSection::FOOTER)->get(),
        ]);
    }
}
