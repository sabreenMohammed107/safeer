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

        // Must be set here, not in build(): Mailable::render()/send() read
        // $this->locale to decide the active locale *before* build() runs,
        // so calling ->locale() inside build() is always one step too late.
        $this->locale(app()->getLocale());
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('emails.password_reset_subject'))
            ->view('emails.password_reset')
            ->with([
                'token' => $this->token,
                'user' => $this->user,
            ]);
    }
}
