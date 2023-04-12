<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_location_id',
        'to_location_id',
        'car_model_id',
        'class_id',
        'duration',
        'person_price',
        'currency_id',

    ];
    public static function boot() {
        parent::boot();

        static::deleting(function($transfer) {

             foreach ($transfer->details as $detail) {
                 $detail->delete();
             }

             foreach ($transfer->carts as $cart) {
                $cart->delete();
            }
        });
    }
    public function carts(){
        return $this->hasMany(Cart::class,'transfer_id','id');
    }
    public function details(){
        return $this->hasMany(TransferDetails::class,'transfer_id','id');
    }
    public function locationFrom()
    {
        return $this->belongsTo(Transfer_location::class,'from_location_id');
    }
    public function locationTo()
    {
        return $this->belongsTo(Transfer_location::class,'to_location_id');
    }
    public function carModel()
    {
        return $this->belongsTo(Car_model::class,'car_model_id');
    }
    public function carClass()
    {
        return $this->belongsTo(Car_class::class,'class_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }

}
