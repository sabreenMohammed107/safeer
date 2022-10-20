<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_enname',
    'branch_arname',
    'detailed_address_en',
    'detailed_address_ar',
    'phone',
    'fax',
    'email',
    'google_map',
    'master_flag',

    ];
}
