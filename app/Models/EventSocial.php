<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'eventid',
        'userid',
        'social_media',
    ];
}
