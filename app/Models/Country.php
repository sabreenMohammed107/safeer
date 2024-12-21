<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_country',
        'ar_country',
        'flag'

    ];
    public function cities()
    {
        return $this->hasMany(City::class);
    }

}
