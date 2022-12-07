<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = "cart";

    protected $fillable = [
        'user_id',
        'room_type_cost_id',
        'room_cap'
        //room_cap => {1:Single, 2:Double, 3:Triple}
    ];
}
