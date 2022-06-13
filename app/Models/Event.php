<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'userid',
        'title',
        'hosted_by',
        'startdate',
        'enddate',
        'start_time',
        'end_time',
        'description',
        'venue',
        'event_type',
        'offline_address',
        'online_address',
        'event_category',
        'addtional_details',
        'fb',
        'twitter',
        'whatsapp',
        'linkedin',
        'registration_text',
        'redirect_link',
        'contact_phone',
        'guest_signin',
        'guest_share',
        'guest_bring_guest',
        'email_reminder',
        'registration',
        'event_recommendation',
        'photo_url',
        'event_url'
    ];

}
