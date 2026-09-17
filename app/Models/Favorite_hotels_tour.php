<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite_hotels_tour extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'user_id',
        'tour_id',
        'transfer_id',
        'offer_id',
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }
    public function tour(){
        return $this->belongsTo(Tour::class,'tour_id');
    }
    public function transfer(){
        return $this->belongsTo(Transfer::class,'transfer_id');
    }
    public function offer(){
        return $this->belongsTo(Offer::class,'offer_id');
    }
    public function user(){
        return $this->belongsTo(SiteUser::class,'user_id');
    }
}
