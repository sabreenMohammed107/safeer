<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourDetails extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tours_details';

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
        'tour_id',
        'tour_name',
        'tour_banner',
        'tour_type', // [0 => Individual, 1 => Group]
        'tour_cost',
        'total_cost',
        'tour_date',
        'adults_count',
        'children_count',
        'created_at',
        'updated_at'
    ];


    public function tour()
    {
        return $this->belongsTo(Tour::class,'tour_id');
    }
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


}
