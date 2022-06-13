<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'interest_id',
        'sub_interest_name',
    ];
}
