<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/17
 * Time: 14:46
 */
include './connect_db.php';

$flag = $_POST['flag'];

if ($flag === 'add') {
    $client_name = $_POST['client_name'];
    $client_type = $_POST['client_type'];
    $client_address = $_POST['client_address'];
    $client_link = $_POST['client_link'];
    $client_intent = $_POST['client_intent'];
    $sales_man = $_POST['sales_man'];
    $link_date = $_POST['link_date'];
    $link_channel = $_POST['link_channel'];
    $desc_info = $_POST['desc_info'];
    $write_man = $_POST['write_man'];
    $files = $_POST['files'];

//    echo $client_name.$sales_man;

    $client_add = "INSERT INTO client (client_name, client_type, client_address, client_link,
client_intent, sales_man, link_date, link_channel, desc_info, write_man, files) VALUES ('$client_name',
 '$client_type', '$client_address', '$client_link', '$client_intent', '$sales_man',
 '$link_date', '$link_channel', '$desc_info', '$write_man', '$files')";

    if (mysqli_query($conn, $client_add)) {
        echo "AddSUC";
    } else {
        echo "AddFAL".mysqli_error($conn);
    };

} elseif ($flag === 'fetch') {

    $client_fetch = "SELECT * FROM client";
    $clientRes = mysqli_query($conn, $client_fetch);
    $data =array();
    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    echo json_encode($data);;
};