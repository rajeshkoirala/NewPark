<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/6/2017
 * Time: 5:24 PM
 */

namespace App\Repositories;

use DB;

class UserManagementRepository
{
    public function getUsers($idsArray)
    {
        $courseIds = implode(',', $idsArray['user']);

        $sql = "SELECT * FROM users WHERE id in ($courseIds)";
        $course = DB::select($sql);

        return $course;
    }
    public function getCustomerDetail($userID)
    {
         $sql = "SELECT last_4,id, expire FROM customer_details WHERE user_id= $userID";
        $customerDetail = DB::select($sql);

        return $customerDetail;
    }

    public function getPaymentHistory($offset, $limit,$userID)
    {

        /*SELECT course_name,paid_amount ,(SELECT no_seats FROM booking
WHERE created_at=payment_history.created_at) AS no_seats
FROM payment_history WHERE user_id= 173
GROUP BY course_id, DATE(created_at), paid_amount LIMIT 0, 10  */

        $sql = "SELECT *, (SELECT no_seats FROM booking
WHERE created_at=payment_history.created_at) AS qty FROM payment_history WHERE user_id= $userID GROUP BY course_name, DATE(created_at), paid_amount LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(qty) AS rowCount
                FROM
                (
                SELECT COUNT(*) AS Qty FROM payment_history WHERE user_id= $userID GROUP BY course_name, DATE(created_at), paid_amount
                )T";

        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function  getBooking($offset, $limit, $userID){

        $sql = "SELECT * FROM booking JOIN users ON  booking.user_id = users.id JOIN course ON course.id = booking.course_id WHERE booking.user_id = $userID ORDER BY booking.created_at DESC LIMIT  $offset, $limit";


        $packet["data"] = DB::select($sql);



        $sql = "SELECT COUNT(*) as rowCount FROM booking JOIN users ON  booking.user_id = users.id JOIN course ON course.id = booking.course_id WHERE booking.user_id = $userID";

        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;




    }




    public function findAll($offset, $limit,$filter)
    {
        $extra_sql = "";

        if ($filter) {

            $search_text = @$filter['user_name'];

            if ($search_text != "" && $search_text != null) {
                $extra_sql .= " WHERE username LIKE '%" . $search_text . "%'";
            }

        }
        $sql = "SELECT * FROM users $extra_sql LIMIT $offset, $limit";

        $packet["data"] = DB::select($sql);

        $sql = "SELECT COUNT(*) AS rowCount FROM users $extra_sql";
        $count = DB::select($sql);

        $packet["count"] = $count[0]->rowCount;

        return $packet;
    }

    public function check_user_already_exists($username)
    {
        $sql = "SELECT COUNT(*) as row_count FROM users WHERE username = '$username'";
        $result = DB::select($sql);
         return $result[0]->row_count > 0 ? false : true;

    }
}