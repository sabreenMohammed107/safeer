<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel_room extends Model
{
    use HasFactory;
    protected $fillable = [

        'hotel_id',
    'room_type_id',
    'no_rooms',
    ];

    public function room(){
        return $this->belongsTo(Room_type::class, 'room_type_id');
    }
}
