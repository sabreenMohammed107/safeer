<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer_location extends Model
{
    use HasFactory;
    protected $fillable = [
        'location_enname',
        'location_arname',
        'city_id',

    ];

    public function transfers()
    {
        return $this->hasMany(Transfer::class, 'from_location_id')
            ->orWhereHas('locationTo');
    }
}
