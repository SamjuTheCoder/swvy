<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeCourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'resumeid',
        'userid',
        'courses',
    ];
}
