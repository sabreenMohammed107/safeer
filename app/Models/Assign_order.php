<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assign_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_details_id',
        'user_id',

    ];
}
