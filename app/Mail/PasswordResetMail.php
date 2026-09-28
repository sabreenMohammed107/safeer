<?php

namespace App\Mail;

use App\Models\SiteUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $token;
    protected SiteUser $user;

    public function __construct(string $token, SiteUser $user)
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
        return $this->subject('Reset Your Safer Travel Password')
            ->view('emails.password_reset')
            ->with([
                'token' => $this->token,
                'user' => $this->user,
            ]);
    }
}
