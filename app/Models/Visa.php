<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable = [
        'visa_type_id','country_id',
        'nationality_id',
        'cost',
        'currency_id',
        'en_notes',
        'ar_notes',
        'active',

    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($visa) {

             foreach ($visa->details as $detail) {
                 $detail->delete();
             }

             foreach ($visa->carts as $cart) {
                $cart->delete();
            }
        });
    }
    public function carts(){
        return $this->hasMany(Cart::class,'visa_id','id');
    }
    public function details(){
        return $this->hasMany(VisaDetails::class,'visa_id','id');
    }

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
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
