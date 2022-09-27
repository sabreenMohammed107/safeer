<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_room_type',
        'ar_room_type',

    ];
}
