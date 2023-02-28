<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_text',
    'review_date',
    'review_stars',
    'active',
    'hotel_id',
    'tour_id',


    ];

    public function user(){
        return $this->belongsTo(SiteUser::class,'user_id');
    }


}
