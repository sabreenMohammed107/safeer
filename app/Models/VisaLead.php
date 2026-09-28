<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'visa_type_id',
        'nationality_id',
        'visa_id',
        'passenger_name',
        'mobile_number',
        'email',
        'passport_image',
        'personal_image',
        'status',
        'notes',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function visaType()
    {
        return $this->belongsTo(Visa_type::class, 'visa_type_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function visa()
    {
        return $this->belongsTo(Visa::class, 'visa_id');
    }
}
