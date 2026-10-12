<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * The promotional banner shown on one public page (offers / visa / transport).
 * There is exactly one row per page; see the create migration.
 */
class PageAdvertisement extends Model
{
    /** page_type => admin label. */
    public const PAGES = [
        'offers' => 'Offers page',
        'visa' => 'Visa page',
        'transport' => 'Transport (transfers) page',
    ];

    public const MEDIA_TYPES = ['image', 'slider'];

    /** Folder under public/uploads. */
    public const FOLDER = 'ads';

    /** Recommended banner size, shown in the admin. */
    public const RECOMMENDED_SIZE = '700 × 1000';

    protected $fillable = [
        'page_type',
        'media_type',
        'image_path',
        'offer_id',
        'link_url',
        'is_active',
    ];

    protected $casts = [
        'image_path' => 'array',
        'is_active' => 'boolean',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    /**
     * The page's row, created on first use so the admin always has all three.
     */
    public static function forPage(string $page): self
    {
        return static::firstOrCreate(['page_type' => $page], [
            'media_type' => 'image',
            'image_path' => [],
            'is_active' => false,
        ]);
    }

    /**
     * The ad to show on a public page, or null when it's disabled or has no image.
     */
    public static function visibleOn(string $page): ?self
    {
        $ad = static::with('offer')->where('page_type', $page)->where('is_active', true)->first();

        return $ad && $ad->images() ? $ad : null;
    }

    /**
     * Filenames to show: just the first for "image", all of them for "slider".
     *
     * @return string[]
     */
    public function images(): array
    {
        $images = array_values(array_filter((array) $this->image_path));

        return $this->media_type === 'slider' ? $images : array_slice($images, 0, 1);
    }

    public function imageUrl(string $image): string
    {
        return asset('uploads/' . self::FOLDER . '/' . $image);
    }

    /**
     * Where clicking the ad goes: the linked offer (in the current language)
     * if there is one, otherwise the custom link, otherwise nowhere.
     */
    public function targetUrl(): ?string
    {
        if ($this->offer) {
            return LaravelLocalization::localizeUrl('/single-offer/' . $this->offer->id . '/' . $this->offer->slug);
        }

        return $this->link_url ?: null;
    }

    public function opensNewTab(): bool
    {
        $url = $this->targetUrl();

        return $url && !$this->offer && parse_url($url, PHP_URL_HOST) !== request()->getHost();
    }
}
