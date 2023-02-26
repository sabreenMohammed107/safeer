<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_type_id',
        'nationality_id',
        'cost',
        'currency_id',
        'en_notes',
        'ar_notes',

    ];



    public function type()
    {
        return $this->belongsTo(Visa_type::class,'visa_type_id');
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class,'nationality_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
}
