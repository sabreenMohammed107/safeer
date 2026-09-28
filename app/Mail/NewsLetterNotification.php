<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsLetterNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $letter;
    protected string $heading;
    protected string $emailSubject;

    /**
     * @param  \App\Models\Newsletter|\App\Models\Contact  $letter  Any model with at least an
     *         `email` and `created_at`; `emails.newsLetter` shows any of
     *         `name`, `phone`, `message` it additionally finds on it.
     */
    public function __construct($letter, string $heading = 'New Newsletter Subscription', string $emailSubject = 'New Newsletter Subscription')
    {
        $this->letter = $letter;
        $this->heading = $heading;
        $this->emailSubject = $emailSubject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->emailSubject)
            ->view('emails.newsLetter')
            ->with([
                'letter' => $this->letter,
                'heading' => $this->heading,
            ]);
    }
}
