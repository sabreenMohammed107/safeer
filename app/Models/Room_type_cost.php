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
    ];
    public function hotelRooms()
    {
        return $this->belongsTo(Hotel_room::class,'hotel_room_id');
    }

}
