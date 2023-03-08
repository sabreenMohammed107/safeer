<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class TransferDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transfer_details';

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
        'transfer_id',
        'order_details_id',
        'transfer_date',
        'transfer_from',
        'transfer_to',
        'car_model',
        'return_date',
        'is_return',
        'hotel_name',
        'car_class',
        'car_image',
        'car_capacity',
        'transfer_person_price',
        'transfer_total_cost',
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

}
