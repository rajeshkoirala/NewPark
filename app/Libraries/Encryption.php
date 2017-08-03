<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/9/2017
 * Time: 1:26 PM
 */

namespace App\Libraries;


class Encryption
{
    private $string;

    public function __construct()
    {
        $this->string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    }

    public function getVoucherCode()
    {
        return substr(str_shuffle($this->string), 0, 4) . "-" . substr(str_shuffle($this->string), 0, 4) . "-" . substr(str_shuffle($this->string), 0, 4) . "-" . substr(str_shuffle($this->string), 0, 4);
    }

    public function getInvoiceCode()
    {
        return strtolower(substr(str_shuffle($this->string), 0, 4) . substr(str_shuffle($this->string), 0, 4) . substr(str_shuffle($this->string), 0, 4) . substr(str_shuffle($this->string), 0, 4));
    }

    public function getUsername($fullName)
    {
        return strtolower($fullName).rand(5000,50000);
    }

    public function getComplexPassword()
    {
        return strtolower(substr(str_shuffle($this->string), 0, 4) . substr(str_shuffle($this->string), 0, 4) . substr(str_shuffle($this->string), 0, 4) . substr(str_shuffle($this->string), 0, 4));
    }

}