<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_type',
        'ar_type',
        'country_id',


    ];
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
