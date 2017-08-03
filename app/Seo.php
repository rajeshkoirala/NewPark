<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends \Eloquent
{
    protected $table = 'seo';
    protected $fillable = [
        'type',
        'type_id',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_language',
        'meta_publisher',
        'meta_author',
        'created_at',
        'updated_at',
    ];

}
