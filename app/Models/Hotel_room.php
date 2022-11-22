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
    ];

    public function room(){
        return $this->belongsTo(Room_type::class, 'room_type_id');
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function room_costs()
    {
        return $this->hasMany(Room_type_cost::class,'hotel_room_id');
    }
}
