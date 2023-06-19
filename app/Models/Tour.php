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
        'ar_notes',
        'en_tours_details',
        'ar_tours_details'

    ];
// this is a recommended way to declare event handlers
public static function boot() {
    parent::boot();

    static::deleting(function($tour) { // before delete() method call this
         $tour->galleries()->delete();
         // do the rest of the cleanup...
    });

    static::deleting(function($tour) { // before delete() method call this
        $tour->reviews()->delete();
        // do the rest of the cleanup...
   });

   static::deleting(function($tour) { // before delete() method call this
    $tour->details()->delete();
    // do the rest of the cleanup...
});


static::deleting(function($tour) { // before delete() method call this
    $tour->carts()->delete();
    // do the rest of the cleanup...
});
}

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class,'tour_id','id');
    }

    public function type()
    {
        return $this->belongsTo(Tour_type::class,'tour_type_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'tour_features');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tour_tags','tour_id','tag_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function details()
    {
        return $this->hasMany(TourDetails::class,'tour_id','id');
    }

    public function carts(){
        return $this->hasMany(Cart::class,'tour_id','id');
    }



    public function getSlugAttribute(): string
    {


        return str_slug($this->en_name);
    }
}
