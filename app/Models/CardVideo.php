<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardid',
        'userid',
        'video_title',
        'video_url',
    ];
}
