<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardProductService extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardid',
        'userid',
        'product_services',
    ];
}
