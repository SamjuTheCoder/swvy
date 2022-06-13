<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'connect_id',
        'connection_code',
        'connection_status',

    ];
}
