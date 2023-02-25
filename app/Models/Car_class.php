<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_class extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_enname',
        'class_arname',

    ];
}
