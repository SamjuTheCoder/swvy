<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardExchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'senderid',
        'receiverid',
        'cardid',
        'connection_code',
        'exchange_status'
    ];
}
