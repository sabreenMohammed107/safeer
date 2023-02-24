<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_trpe_enname',
        'visa_trpe_arname',
        'country_id',
        'cost',
        'currency_id',
        'en_notes',
        'ar_notes',

    ];

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
}
