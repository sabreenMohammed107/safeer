<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_tag',
        'ar_tag',
        'hotel_id',
        'tour_id',

    ];


    public function hotel()
    {
        return $this->belongsTo(Hotel::class,'hotel_id');
    }


    public function tour()
    {
        return $this->belongsTo(Tour::class,'tour_id');
    }
}
