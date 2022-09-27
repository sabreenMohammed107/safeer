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

    ];


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
