<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_model extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_enname',
        'model_arname',
        'image',
        'capacity',
        'active',

    ];
}
