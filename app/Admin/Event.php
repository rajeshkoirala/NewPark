<?php

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;


class Event extends Model
{

    protected $table = 'events';
    protected $fillable = [
        'id', 'course_id', 'event_name', 'start_date', 'end_date','event_time_start','event_time_end', 'no_of_seat', 'created_by', 'status', 'repeat_event', 'event_desc'
    ];
}