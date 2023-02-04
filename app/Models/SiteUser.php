<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */

    protected $table = "site_users";

    protected $fillable = [
        'image',
        'first_name',
        'last_name',
        'phone',
        'address',
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function favorites()
    {
        return $this->belongsToMany(Hotel::class, 'favorite_hotels_tours','user_id','hotel_id');
    }
}
