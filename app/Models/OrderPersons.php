<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property boolean $person_type
 * @property string  $person_salutation
 * @property string  $person_name
 * @property string  $person_mobile
 * @property float   $person_cost
 * @property int     $created_at
 * @property int     $updated_at
 */
class OrderPersons extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_persons';

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
        'order_id', 'person_type', 'person_salutation', 'person_name', 'person_mobile', 'person_cost', 'created_at', 'updated_at'
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
        'person_type' => 'boolean', 'person_salutation' => 'string', 'person_name' => 'string', 'person_mobile' => 'string', 'person_cost' => 'double', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
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

    // Relations ...
}
