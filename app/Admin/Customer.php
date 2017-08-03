<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer_details';
    protected $fillable = [
        'email'
    ];
}
