<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiry';
    protected $fillable = [
        'name','email','phone','company_name','course_interested','heard_from','message','is_viewed'
    ];
}
