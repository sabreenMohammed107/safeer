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

    ];
    public function getSlugAttribute(): string
    {


        return str_slug($this->subtitle_en);
    }

    public function city()
    {
        return $this->belongsTo(City::class ,'city_id');
    }
}
