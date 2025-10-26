<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPasswordSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;

    public function __construct($name, $email)
    {
        $this->name  = $name;
        $this->email = $email;
    }

    public function build()
    {
        return $this->subject('Konfirmasi: Password Anda Berhasil Diperbarui')
            ->view('emails.password-success');
    }
}
