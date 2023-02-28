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
        'user_id',
        'tax_percentage',
        // 'from_date',
        // 'to_date',
        // 'nights',
        // 'adults_count',
        // 'children_count',
        // 'rooms_count',
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
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;

    // Scopes...

    // Functions ...

    // Relations ...
    public function user(){
        return $this->belongsTo(SiteUser::class,'user_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetails::class, 'order_id');
    }
}
