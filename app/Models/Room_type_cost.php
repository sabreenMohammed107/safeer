<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_type_cost extends Model
{
    use HasFactory;
    protected $fillable = [

        'from_date',
    'end_date',
    'cost',
    'hotel_room_id',
    'created_at',
    'updated_at',
    'currency_id',
    'food_beverage_id',
    'single_cost',
    'double_cost',
    'triple_cost',
    'extra_bed_cost',
    'child_free_age_from',
    'child_free_age_to',
    'child_age_from',
    'child_age_to',
    'child_age_cost',
    'room_type_id',
    'hotel_id'
    ];


    public static function boot() {
        parent::boot();

        static::deleting(function($room) {



             foreach ($room->carts as $cart) {
                $cart->delete();
            }
        });
    }
    public function carts(){
        return $this->hasMany(Cart::class,'room_type_cost_id','id');
    }
    public function hotelRooms()
    {
        return $this->belongsTo(Hotel_room::class,'hotel_room_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class,'hotel_id');
    }

    public function hotel_sortedByDesc(){
        return $this->belongsTo(Hotel::class)->sortByAsc('hotel_enname');
     }

}
