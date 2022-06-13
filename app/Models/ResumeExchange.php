<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeExchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'senderid',
        'receiverid',
        'resumeid',
        'connection_code',
        'exchange_status'
    ];
}
