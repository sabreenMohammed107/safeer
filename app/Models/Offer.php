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

    ];

    protected $casts = [
        'offer_date' => 'date',
    ];

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

    public function getSlugAttribute(): string
    {


        return str_slug($this->subtitle_en);
    }

    public function city()
    {
        return $this->belongsTo(City::class ,'city_id');
    }
}
