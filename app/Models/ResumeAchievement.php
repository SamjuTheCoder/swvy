<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'resumeid',
        'userid',
        'achievements',
    ];
}
