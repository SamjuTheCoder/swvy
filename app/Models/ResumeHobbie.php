<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeHobbie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'resumeid',
        'userid',
        'hobby',
    ];
}
