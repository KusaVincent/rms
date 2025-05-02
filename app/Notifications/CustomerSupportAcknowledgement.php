<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\CustomerSupport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class CustomerSupportAcknowledgement extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        /**
         * The support request instance.
         */
        private CustomerSupport $support
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            // set a dynamic subject line
            ->subject('We’ve received your request: '.$this->support->subject)
            // greet by their name
            ->greeting('Hello '.$this->support->name.',')
            // repurpose their message back to them
            ->line('Thank you for contacting us. Here’s what we got from you:')
            ->line('**Subject:** '.$this->support->subject)
            ->line('**Message:** '.$this->support->message)
            ->line('**Phone number on file:** '.$this->support->phone_number)
            // give them next steps
            ->line('Our support team will reach out to you at '.$this->support->email.' within 24 hours.')
            ->salutation('Kind regards,')
            ->line('The Support Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'support_id' => $this->support->id,
            'subject' => $this->support->subject,
            'email' => $this->support->email,
            'phone_number' => $this->support->phone_number,
        ];
    }
}
