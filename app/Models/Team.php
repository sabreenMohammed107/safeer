<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'en_name',
        'ar_name',
        'en_job',
        'ar_job',
        'en_description',
        'ar_description',
        'image',
        'featured',
        'active',
        'order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'active' => 'boolean',
    ];
}
