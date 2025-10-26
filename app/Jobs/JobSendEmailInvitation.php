<?php

namespace App\Jobs;

use App\Mail\PasswordInvitationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobSendEmailInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name;
    protected $email;
    protected $plainPassword;
    protected $role;

    public function __construct($name, $email, $plainPassword, $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->plainPassword = $plainPassword;
        $this->role = $role;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new PasswordInvitationMail(
            $this->name,
            $this->email,
            $this->plainPassword,
            $this->role
        ));
    }
}
