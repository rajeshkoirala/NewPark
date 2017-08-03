<?php

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'news_id', 'commentator_name', 'commentator_email','commentator_phone','commentator_website','comment','parent_id'
    ];

}