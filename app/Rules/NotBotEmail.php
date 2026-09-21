<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotBotEmail implements Rule
{
    /**
     * Well-known disposable/temporary-inbox domains abused by subscription bots.
     */
    protected array $disposableDomains = [
        'mailinator.com', 'tempmail.com', 'temp-mail.org', '10minutemail.com',
        'guerrillamail.com', 'guerrillamail.info', 'yopmail.com', 'trashmail.com',
        'throwawaymail.com', 'fakeinbox.com', 'getnada.com', 'dispostable.com',
        'sharklasers.com', 'maildrop.cc', 'mintemail.com', 'moakt.com',
        'emailondeck.com', 'discardmail.com', 'mailnesia.com', 'spam4.me',
    ];

    /**
     * Domains where dots in the local part are ignored by the mailbox provider
     * (a.b.c@gmail.com and abc@gmail.com deliver to the same inbox), which is
     * exactly what bots abuse to mint endless "unique-looking" addresses.
     */
    protected array $dotInsensitiveDomains = ['gmail.com', 'googlemail.com'];

    protected string $failureReason = 'invalid';

    public function passes($attribute, $value)
    {
        if (! is_string($value) || ! str_contains($value, '@')) {
            return true; // let the `email` rule handle basic format failures
        }

        [$local, $domain] = array_pad(explode('@', $value, 2), 2, '');
        $domain = strtolower($domain);

        if (in_array($domain, $this->disposableDomains, true)) {
            $this->failureReason = 'disposable';

            return false;
        }

        if (in_array($domain, $this->dotInsensitiveDomains, true)) {
            $dotCount = substr_count($local, '.');

            // Genuine gmail addresses very rarely use more than one or two dots
            // (e.g. "first.last"). Bot-generated dot-trick addresses like
            // "qa.h.ug.a.y.e.v.a8.33@gmail.com" pile up many single/double
            // character segments to look "unique" while landing in one inbox.
            if ($dotCount >= 3) {
                $this->failureReason = 'dot_trick';

                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return $this->failureReason === 'disposable'
            ? __('links.newsletter_disposable')
            : __('links.newsletter_invalid');
    }
}
