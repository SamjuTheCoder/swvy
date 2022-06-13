<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'firstname',
        'middlename',
        'lastname',
        'email',
        'headline',
        'phone_number',
        'address',
        'city',
        'dob',
        'pob',
        'gender',
        'nationality',
        'website',
        'linkedin',
        'driver_license_no',
    ];
}
