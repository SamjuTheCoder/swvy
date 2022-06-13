<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSocial extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardid',
        'userid',
        'social_media',
    ];
}
