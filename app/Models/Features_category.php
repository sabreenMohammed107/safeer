<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Features_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_category',
        'ar_category',

    ];

}
