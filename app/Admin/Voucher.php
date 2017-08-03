<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $fillable = [
        'code', 'amount', 'usage_limit', 'is_active', 'is_deleted', 'used_times', 'type'
    ];
}
