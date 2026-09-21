<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoUrl implements Rule
{
    /**
     * Patterns that indicate a link/domain was submitted (used by spam bots
     * to inject promotional URLs into free-text fields).
     */
    protected array $patterns = [
        '/https?:\/\//i',
        '/www\./i',
        '/\[url=/i',
        '/<a\s+href/i',
        '/\b[a-z0-9-]+\.(ru|com|net|org|info|biz|xyz|top|site|online|club|shop|link|icu|cn|su)\b/i',
    ];

    public function passes($attribute, $value)
    {
        if (! is_string($value)) {
            return true;
        }

        foreach ($this->patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return __('links.no_url_allowed');
    }
}
