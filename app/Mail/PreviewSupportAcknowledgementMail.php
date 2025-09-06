<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\CustomerSupport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

final class PreviewSupportAcknowledgementMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public CustomerSupport $support) {}

    public function build(): self
    {
        return $this->subject('We’ve received your request: '.$this->support->subject)
            ->markdown('emails.customer_support_ack', ['support' => $this->support]);
    }
}
