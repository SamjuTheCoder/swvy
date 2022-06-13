<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'firstname',
        'middlename',
        'lastname',
        'title_designation',
        'company_name',
        'business_address',
        'phone_number',
        'email',
        'description',
        'background_color',
        'card_width',
        'card_height',
        'text_color',
        'text_size',
        'photo_url',
    ];
}
