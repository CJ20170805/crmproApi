<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 18:05
 */
include "./connect_db.php";

$flag = $_POST['flag'];

if ($flag === 'myClient') {

    $user_name = $_POST['user_name'];

    $client_fetch = "SELECT id FROM client WHERE sales_man = '$user_name'";

    $res = mysqli_query($conn, $client_fetch);
    $data =array();
    while($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
        array_push($data, $row);
    };
    echo json_encode($data);

} elseif ($flag === 'myOrder') {

    $user_name = $_POST['user_name'];

    $order_fetch = "SELECT id FROM orders WHERE sales_man = '$user_name'";

    $res = mysqli_query($conn, $order_fetch);
    $data =array();
    while($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
        array_push($data, $row);
    };
    echo json_encode($data);

} elseif ($flag === 'myPm') {

    $user_name = $_POST['user_name'];

    $pm_fetch = "SELECT pay_price FROM pm WHERE reach_name = '$user_name'";

    $res = mysqli_query($conn, $pm_fetch);
    $data =array();
    while($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
        array_push($data, $row);
    };
    echo json_encode($data);

} elseif ($flag === 'myPmDetail') {

    $pm_fetch = "SELECT reach_name,pay_price,reg_date FROM pm WHERE YEARWEEK(date_format(reg_date,'%Y-%m-%d')) = YEARWEEK(now())-1";
    $res = mysqli_query($conn, $pm_fetch);
    $data =array();
    while($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    echo json_encode($data);

} elseif ($flag === 'fetchUserInfo') {

    $pm_fetch = "SELECT st_name,st_departmentVal,best_reason,st_avatar FROM staff WHERE best_flag = 1";
    $res = mysqli_query($conn, $pm_fetch);
    $data =array();
    while($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    echo json_encode($data);
}