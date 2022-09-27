<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_feature',
        'ar_feature',
        'icon',
        'feature_category_id',

    ];

    public function category()
    {
        return $this->belongsTo(Features_category::class,'feature_category_id');
    }

}
