<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'subtitle_en',
        'subtitle_ar',
        'image',
        'active',
        'cost',
        'offer_enoverview',
        'offer_aroverview',
        'status',
        'poster',
        'poster_image',
        'offer_date',
        'start_date',
        'end_date',

    ];

    protected $casts = [
        'offer_date' => 'date',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /** Display format for start_date / end_date, shared by admin and site. */
    public const PERIOD_FORMAT = 'Y-m-d H:i';

    protected static function booted()
    {
        // offer_date is optional in the admin form: when left empty it falls
        // back to the day the offer was created.
        static::saving(function (Offer $offer) {
            if (blank($offer->offer_date)) {
                if (!$offer->created_at) {
                    // Set created_at now so both columns share the exact same
                    // timestamp; updateTimestamps() keeps a dirty created_at.
                    $offer->setCreatedAt($offer->freshTimestamp());
                }
                $offer->offer_date = $offer->created_at->toDateString();
            }
        });
    }

    /**
     * Active offers running right now: start_date <= now <= end_date. A missing
     * start/end leaves that side open (legacy rows the backfill couldn't date).
     */
    public function scopeCurrent($query)
    {
        $now = now();

        return $query->where('active', 1)
            ->where(function ($query) use ($now) {
                $query->whereNull('start_date')->orWhere('start_date', '<=', $now);
            })
            ->where(function ($query) use ($now) {
                $query->whereNull('end_date')->orWhere('end_date', '>=', $now);
            });
    }

    /**
     * start_date / end_date as a date only, with the month named in the
     * site's current language (e.g. "5 Oct 2026" / "5 أكتوبر 2026").
     */
    public function periodDate(string $field, string $format = 'j M Y'): ?string
    {
        return $this->$field?->locale(app()->getLocale())->translatedFormat($format);
    }

    /**
     * Where now falls in the offer's period: 'upcoming', 'expired' or 'active'.
     */
    public function getPeriodStatusAttribute(): string
    {
        $now = now();

        if ($this->start_date && $this->start_date->gt($now)) {
            return 'upcoming';
        }
        if ($this->end_date && $this->end_date->lt($now)) {
            return 'expired';
        }

        return 'active';
    }

    public function getSlugAttribute(): string
    {


        return str_slug($this->subtitle_en);
    }

    public function city()
    {
        return $this->belongsTo(City::class ,'city_id');
    }
}
