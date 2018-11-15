<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/18
 * Time: 17:00
 */

include './connect_db.php';

$flag = $_POST['flag'];

if ($flag === 'add') {
    $id = $_POST['id'];
    $apart = $_POST['apart'];
    $name = $_POST['name'];
    $reach_date = $_POST['reach_date'];
    $client_name = $_POST['client_name'];
    $buy_serv = $_POST['buy_serv'];
    $serv_price = $_POST['serv_price'];
    $time_limit = $_POST['time_limit'];

    $pay_price = $_POST['pay_price'];
    $pay_id = $_POST['pay_id'];
    $rec_id = $_POST['rec_id'];
    $deal_id = $_POST['deal_id'];
    $else_desc = $_POST['else_desc'];
    $upload_imgs = $_POST['upload_imgs'];
    $buy_type = $_POST['buy_type'];

//    echo $pay_price.$pay_id.$rec_id.$deal_id.$else_desc.$upload_imgs;
//    echo $client_name.$sales_man;

    $pm_add = "INSERT INTO pm (reach_id, reach_apart, reach_name, reach_date,
client_name, buy_serv, serv_price, time_limit, pay_price, pay_id, rec_id, deal_id, else_desc, upload_imgs, buy_type, $buy_type, stu) VALUES ('$id',
 '$apart', '$name', '$reach_date', '$client_name', '$buy_serv',
 '$serv_price', '$time_limit', '$pay_price', '$pay_id', '$rec_id', '$deal_id', '$else_desc', '$upload_imgs', '$buy_type', '$pay_price', '1')";

    if (mysqli_query($conn, $pm_add)) {
        echo "AddSUC";
    } else {
        echo "AddFAL" . mysqli_error($conn);
    };

} elseif ($flag === 'fetch') {

//    $client_fetch = "SELECT * FROM pm WHERE stu = '1'";
//    $clientRes = mysqli_query($conn, $client_fetch);
//    $data =array();
//    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
//        array_push($data, $row);
//    };
//    echo json_encode($data);

    $name = $_POST['name'];
    $depart = $_POST['depart'];
    $power = $_POST['power'];

    if ($power === "分公司总经理" || $power === "" || $power === "技术总监" || $power === "销售总监") {

        $order_fetch = "SELECT * FROM pm WHERE stu = '1'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $orderJson = json_encode($data);

        echo $orderJson;

    } elseif ($power === "BD经理" || $power === "AM") {

        $order_fetch = "SELECT * FROM pm WHERE reach_apart = '$depart' AND stu = '1'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };
        $orderJson = json_encode($data);
        echo $orderJson;

    } else {

        $order_fetch = "SELECT * FROM pm WHERE reach_name = '$name' AND stu = '1'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $orderJson = json_encode($data);
        echo $orderJson;
    }

} elseif ($flag === 'delPm'){

    $delId = $_POST['delId'];

    $del_db = "DELETE FROM pm WHERE id = '$delId'";

    if (mysqli_query($conn, $del_db)){

        echo "delPmSuc";

    } else {
        echo "Del false".mysqli_error($conn);
    };
} elseif ($flag === 'conditionFetch') {

    $begin = $_POST['begin'];

    $end = $_POST['end'];

//    echo $end."ConditionFetch!!!!".$begin;

    $client_fetch = "SELECT * FROM pm WHERE reg_date BETWEEN '$begin' AND '$end' AND stu = '1'";
    $clientRes = mysqli_query($conn, $client_fetch);
    $data =array();
    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    echo json_encode($data);


} elseif ($flag === 'conditionFetchToday') {

    $begin = $_POST['begin'];

//    echo $end."ConditionFetch!!!!".$begin;

    $client_fetch = "SELECT * FROM pm WHERE reg_date LIKE '$begin%' AND stu = '1'";
    $clientRes = mysqli_query($conn, $client_fetch);
    $data =array();
    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    echo json_encode($data);

} elseif ($flag === 'conditionFetchLastWeek') {

//    echo $end."ConditionFetch!!!!".$begin;

//    $client_fetch = "SELECT * FROM pm WHERE reg_date BETWEEN '$begin' AND '$end'";
    // $client_fetch = "select * from pm where DATEDIFF(now(),reg_date) = 0";

    $client_fetch = "SELECT * FROM pm WHERE YEARWEEK(date_format(reg_date,'%Y-%m-%d')) = YEARWEEK(now())-1 AND stu = '1'";
    $clientRes = mysqli_query($conn, $client_fetch);
    $data =array();
    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    echo json_encode($data);

}else{
    echo "Unset PM flag!";
};