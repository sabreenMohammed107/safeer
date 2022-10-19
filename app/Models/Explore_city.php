<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explore_city extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'subtitle_en',
        'subtitle_ar',
        'image',

    ];

    public function city()
    {
        return $this->belongsTo(City::class ,'city_id');
    }
}
