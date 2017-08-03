<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    protected $fillable = [
        'title', 'content', 'schedule_date','pdf_file'
    ];

}
