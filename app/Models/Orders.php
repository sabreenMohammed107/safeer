<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int      $order_no
 * @property int      $payway
 * @property int      $payment_id
 * @property int      $status
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $order_no
 * @property int      $payway
 * @property int      $payment_id
 * @property int      $status
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $created_at
 * @property int      $updated_at
 * @property int      $nights
 * @property int      $adults_count
 * @property int      $children_count
 * @property int      $rooms_count
 * @property int      $created_at
 * @property int      $updated_at
 * @property DateTime $order_date
 * @property DateTime $order_date
 * @property DateTime $order_date
 * @property float    $subtotally
 * @property float    $tax
 * @property float    $delivery_cost
 * @property float    $total
 * @property float    $booked_quantity
 * @property float    $ticket_net_fees
 * @property float    $subtotally
 * @property float    $tax
 * @property float    $delivery_cost
 * @property float    $total
 * @property Date     $order_date
 * @property Date     $from_date
 * @property Date     $to_date
 * @property string   $name
 * @property string   $email
 * @property string   $phone
 * @property string   $notes
 * @property string   $address
 * @property string   $copoun
 * @property string   $notes
 * @property string   $holder_salutation
 * @property string   $holder_name
 * @property string   $holder_mobile
 * @property string   $notes
 */
class Orders extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
        'order_no', 'user_id', 'address_id', 'payway', 'payment_id', 'order_date', 'copoun', 'subtotally', 'tax', 'delivery_cost', 'total', 'status', 'created_at', 'updated_at', 'order_date', 'order_status_id', 'doctor_id', 'event_id', 'payment_method_id', 'name', 'email', 'country_id', 'phone', 'ticket_id', 'booked_quantity', 'copoun_id', 'discount_id', 'ticket_net_fees', 'notes', 'created_at', 'updated_at', 'order_no', 'user_id', 'address', 'payway', 'payment_id', 'order_date', 'copoun', 'subtotally', 'tax', 'delivery_cost', 'total', 'status', 'created_at', 'updated_at', 'order_date', 'status_id', 'user_id', 'notes', 'created_at', 'updated_at', 'user_id', 'holder_salutation', 'holder_name', 'holder_mobile', 'notes', 'from_date', 'to_date', 'nights', 'adults_count', 'children_count', 'rooms_count', 'created_at', 'updated_at'
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
        'order_no' => 'int', 'payway' => 'int', 'payment_id' => 'int', 'order_date' => 'datetime', 'subtotally' => 'double', 'tax' => 'double', 'delivery_cost' => 'double', 'total' => 'double', 'status' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'order_date' => 'date', 'name' => 'string', 'email' => 'string', 'phone' => 'string', 'booked_quantity' => 'double', 'ticket_net_fees' => 'double', 'notes' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'order_no' => 'int', 'address' => 'string', 'payway' => 'int', 'payment_id' => 'int', 'order_date' => 'datetime', 'copoun' => 'string', 'subtotally' => 'double', 'tax' => 'double', 'delivery_cost' => 'double', 'total' => 'double', 'status' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'order_date' => 'datetime', 'notes' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp', 'holder_salutation' => 'string', 'holder_name' => 'string', 'holder_mobile' => 'string', 'notes' => 'string', 'from_date' => 'date', 'to_date' => 'date', 'nights' => 'int', 'adults_count' => 'int', 'children_count' => 'int', 'rooms_count' => 'int', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'order_date', 'created_at', 'updated_at', 'order_date', 'created_at', 'updated_at', 'order_date', 'created_at', 'updated_at', 'order_date', 'created_at', 'updated_at', 'from_date', 'to_date', 'created_at', 'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
}
