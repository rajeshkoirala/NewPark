<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/7/2017
 * Time: 11:37 AM
 */

namespace App\Admin;


class Settings extends Model
{
    protected $table = "";
    protected $fillable = ['username','full_name','email','password','user_type','remember_token'];


}