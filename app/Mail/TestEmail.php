<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use MailerSend\LaravelDriver\MailerSendTrait;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels, MailerSendTrait;

    public function build()
    {
        return $this->subject('Test Email via MailerSend')
            ->view('emails.test_html')
            ->text('emails.test_text');
    }
}
