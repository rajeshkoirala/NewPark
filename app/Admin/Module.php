<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/8/2017
 * Time: 12:31 PM
 */

namespace App\Admin;
use Illuminate\Database\Eloquent\Model;


class Module extends Model
{

    protected $table = 'module';
    protected $fillable = [
        'name', 'course_id', 'description'
    ];
}