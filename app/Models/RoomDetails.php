<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class RoomDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'rooms_details';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_details_id',
        'room_type',
        'room_view',
        'food_bev_type',
        'room_cost',
        'total_cost',
        'hotel_id',
        'from_date',
        'to_date',
        'nights',
        'adults_count',
        'children_count',
        'rooms_count',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;


    public function order_detail()
    {
        return $this->belongsTo(OrderDetails::class, 'order_details_id');
    }
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

}
