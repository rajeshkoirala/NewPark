<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/24/2017
 * Time: 4:02 PM
 */

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'news';
    protected $fillable = [
        'news_title', 'posted_date', 'description','course_id','course_typeid','news_image','short_description','thumb_image'
    ];

}