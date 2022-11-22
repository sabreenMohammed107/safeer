<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_city',
        'ar_city',
        'country_id'

    ];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }



}
