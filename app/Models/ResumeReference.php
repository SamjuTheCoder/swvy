<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeReference extends Model
{
    use HasFactory;

    protected $fillable = [
        'resumeid',
        'userid',
        'ref_name',
        'ref_position',
        'ref_phone',
        'ref_email',
    ];
}
