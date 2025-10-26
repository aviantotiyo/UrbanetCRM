<?php

namespace App\Jobs;

use App\Mail\NewPasswordSuccessMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class JobNewPasswordSuccess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userName;
    protected $userEmail;

    /**
     * Create a new job instance.
     */
    public function __construct($userName, $userEmail)
    {
        $this->userName  = $userName;
        $this->userEmail = $userEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->userEmail)->send(new NewPasswordSuccessMail(
            $this->userName,
            $this->userEmail
        ));
    }
}
