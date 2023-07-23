<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $room_type
 * @property string $room_view
 * @property string $food_bev_type
 * @property float  $room_cost
 * @property float  $total_cost
 * @property int    $created_at
 * @property int    $updated_at
 */


class OrderDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_details';

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
        'order_id',
        'holder_salutation',
        'holder_name',
        'holder_mobile',
        'holder_email',
        'holder_job',
        'notes',
        'detail_type', //0 >> roomdetails - 1>>tourdetails - 2 >>transdetails - 3 >> visadetails
        'pickup_point',
        'oder_status',
        // 'room_type',
        // 'room_view',
        // 'food_bev_type',
        // 'room_cost',
        // 'total_cost',
        // 'hotel_id',
        'receipt_image',
        'receipt_notes',

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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_type' => 'string', 'room_view' => 'string', 'food_bev_type' => 'string', 'room_cost' => 'double', 'total_cost' => 'double', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...
    public function getTotalCostAttribute($total_cost)
    {
        return number_format($total_cost, 2);
    }
    public function getRoomCostAttribute($room_cost)
    {
        return number_format($room_cost, 2);
    }
    // Relations ...

    public function order(){
        return $this->belongsTo(Orders::class,'order_id');
    }
    public function status(){
        return $this->belongsTo(Status::class,'status_id');
    }

    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id');
    }

    public function room_details()
    {
        return $this->hasMany(RoomDetails::class, 'order_details_id');
    }

    public function tours_details()
    {
        return $this->hasMany(TourDetails::class, 'order_details_id');
    }
    public function transfer_details()
    {
        return $this->hasMany(TransferDetails::class, 'order_details_id');
    }

    public function visa_details()
    {
        return $this->hasMany(VisaDetails::class, 'order_details_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'assign_orders');
    }
}
