<?php

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    protected $table = 'booking';
    protected $fillable = [
        'user_id', 'course_id', 'booked_date', 'no_seats'
    ];
}