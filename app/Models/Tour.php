<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_overview',
        'ar_overview',
        'banner',
        'city_id',
        'active',

        'en_name',
        'ar_name',
        'tour_type_id',
        'thumbnail',
        'tour_vedio',
        'duration',
        'tour_en_language',
        'tour_ar_language',
        'tour_en_days',
        'tour_ar_days',
        'tour_person_cost',
        'currency_id',
        'en_notes',
        'ar_notes'

    ];


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'tour_features');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tour_tags','tour_id','tag_id');
    }
}
