<?php

namespace App\Repositories;
use DB;

class VoucherRepository
{
    public function findAll($offset, $limit)
    {
        $sql = "SELECT * FROM voucher WHERE is_deleted = '0' LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM voucher WHERE is_deleted = '0'";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function voucherCheck($code)
    {
        $sql = "SELECT * FROM voucher WHERE 1 = 1  AND code = '$code' AND is_deleted = '0' AND is_active = '1' AND usage_limit >= used_times";

        $result = DB::select($sql);

        $packet = array(
            'status' => false,
            'code' => $code,
            'amount' => 0,
            'type' => '',
            'unit' => ''
        );

        if (isset($result[0])) {

            $unit = kmGetData('payment-setting', 'price_unit');
            if ($result[0]->type == "PERCENTAGE") {
                $unit = "%";
            }

            $packet = array(
                'status' => true,
                'code' => $result[0]->code,
                'amount' => $result[0]->amount,
                'type' => $result[0]->type,
                'unit' => $unit
            );
        }

        return $packet;
    }

    public function getDiscount($code, $amount)
    {
        $sql = "SELECT * FROM voucher WHERE code = '$code' AND is_deleted = '0' AND is_active = '1' AND usage_limit >= used_times";
        $result = DB::select($sql);

        $discount = 0;

        if(isset($result[0])) {

            $discount = $result[0]->amount;
            if($result[0]->type == "PERCENTAGE") {
                $discount = $amount*$result[0]->amount/100;
            }

        }

        return $discount;

    }

    public function incrementVoucherUsedCount($code)
    {
        $sql = "SELECT * FROM voucher WHERE code = '$code' AND is_deleted = '0' AND is_active = '1' AND usage_limit >= used_times";
        $result = DB::select($sql);

        if(isset($result[0])) {
            $inc = $result[0]->used_times + 1;

            $sql = "UPDATE voucher SET used_times = '$inc' WHERE code = '$code'";
            DB::statement($sql);
        }

    }

}