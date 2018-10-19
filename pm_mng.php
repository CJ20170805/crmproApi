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

//    echo $pay_price.$pay_id.$rec_id.$deal_id.$else_desc.$upload_imgs;
//    echo $client_name.$sales_man;

    $pm_add = "INSERT INTO pm (reach_id, reach_apart, reach_name, reach_date,
client_name, buy_serv, serv_price, time_limit, pay_price, pay_id, rec_id, deal_id, else_desc, upload_imgs) VALUES ('$id',
 '$apart', '$name', '$reach_date', '$client_name', '$buy_serv',
 '$serv_price', '$time_limit', '$pay_price', '$pay_id', '$rec_id', '$deal_id', '$else_desc', '$upload_imgs')";

    if (mysqli_query($conn, $pm_add)) {
        echo "AddSUC";
    } else {
        echo "AddFAL" . mysqli_error($conn);
    };

} elseif ($flag === 'fetch') {

    $client_fetch = "SELECT * FROM pm";
    $clientRes = mysqli_query($conn, $client_fetch);
    $data =array();
    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    echo json_encode($data);;
} elseif ($flag === 'delPm'){

    $delId = $_POST['delId'];

    $del_db = "DELETE FROM pm WHERE id = '$delId'";

    if (mysqli_query($conn, $del_db)){

        echo "delPmSuc";

    } else {
        echo "Del false".mysqli_error($conn);
    };

} else{
    echo "Unset PM flag!";
};