<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardPhotoGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardid',
        'userid',
        'photo_title',
        'photo_url',
    ];
}
