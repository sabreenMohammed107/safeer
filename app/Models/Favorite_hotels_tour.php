<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_hotels_tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'user_id',
        'tour_id',

    ];
}
