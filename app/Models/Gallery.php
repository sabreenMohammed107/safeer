<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [

        'img',
        'hotel_id',
        'tour_id',
        'active',

    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
