<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_log';
    protected $fillable = [
        'action',
        'description',
        'ip_address',
        'user_agent',
        'updated_at',
        'created_at',
        'user_id',
    ];
}
