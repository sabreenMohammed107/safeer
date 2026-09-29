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
    protected ?string $heading;

    /**
     * @param  \App\Models\Newsletter|\App\Models\Contact  $letter  Any model with at least an
     *         `email` and `created_at`; `emails.newsLetter` shows any of
     *         `name`, `phone`, `message` it additionally finds on it.
     * @param  string|null  $heading  Overrides the view heading/subject; defaults to the
     *         translated "New Newsletter Subscription" string.
     */
    public function __construct($letter, ?string $heading = null)
    {
        $this->letter = $letter;
        $this->heading = $heading;

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
        return $this->subject($this->heading ?? __('emails.newsletter_subject'))
            ->view('emails.newsLetter')
            ->with([
                'letter' => $this->letter,
                'heading' => $this->heading,
            ]);
    }
}
