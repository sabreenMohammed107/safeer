<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class VisaDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'visa_details';

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
        'visa_id',
        'visa_date',
        'visa_cost',
        'order_details_id',
        'visa_personal_photo',
        'visa_passport_photo'
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
    public function visa()
    {
        return $this->belongsTo(Visa::class, 'visa_id');
    }

}
