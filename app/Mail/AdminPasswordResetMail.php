<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $token;
    protected User $user;

    public function __construct(string $token, User $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Reset Your Safer Travel Admin Password')
            ->view('emails.admin_password_reset')
            ->with([
                'token' => $this->token,
                'user' => $this->user,
            ]);
    }
}
