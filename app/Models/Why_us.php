<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Why_us extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
    'en_title',
    'ar_title',
    'en_text',
    'ar_artext',

    ];

}
