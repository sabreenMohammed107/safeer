<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_enname',
    'hotel_arname',
    'hotel_enoverview',
    'hotel_aroverview',
    'keywords',
    'hotel_type_id',
    'hotel_stars',
    'hotel_logo',
    'hotel_banner',
    'hotel_enbrief',
    'hotel_arbrief',
    'city_id',
    'zone_id',
    'details_enaddress',
    'details_araddress',
    'google_map',
    'hotel_vedio',
    'active',

    ];

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


    public function type()
    {
        return $this->belongsTo(Hotel_type::class,'hotel_type_id');
    }

    //features
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'hotels_features');
    }

    public function hotel_features()
    {
        return $this->hasMany(Hotels_feature::class, 'hotel_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}
