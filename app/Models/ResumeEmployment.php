<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeEmployment extends Model
{
    use HasFactory;

    protected $fillable = [
        'resumeid',
        'userid',
        'employer_name',
        'position_held',
        'date_from',
        'date_to',
    ];
}
