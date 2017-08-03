<?php

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;


class EventMultipleDuration extends Model
{
    protected $table = 'events_multiple_duration';
    protected $fillable = [
        'id', 'course_id', 'event_id', 'available_date', 'status'
    ];
}