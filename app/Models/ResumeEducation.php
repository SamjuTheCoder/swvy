<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'resumeid',
        'userid',
        'school_attended',
        'qualification',
        'qualification_url',
        'date_from',
        'date_to',
    ];
}
