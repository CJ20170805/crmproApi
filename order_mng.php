<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/28
 * Time: 15:55
 */
include "./connect_db.php";

// order add
$shop_name = $_POST['shop_name'];
$shop_url = $_POST['shop_url'];
$shop_id = $_POST['shop_id'];
$shop_type = $_POST['shop_type'];
$link_man = $_POST['link_man'];
$link_methods = $_POST['link_methods'];
$combo_info = $_POST['combo_info'];
$pay_price = $_POST['pay_price'];
$time_limit = $_POST['time_limit'];
$desc_info = $_POST['desc_info'];

//$arr = array();
echo $shop_name.$shop_url.$shop_id.$shop_type.$link_methods.$time_limit;

$order_add = "INSERT INTO orders (shop_name, shop_url, shop_id, shop_type,
link_man, link_methods, combo_info, pay_price, time_limit, desc_info) VALUES ('$shop_name',
 '$shop_url', '$shop_id', '$shop_type', '$link_man', '$link_methods',
 '$combo_info', '$pay_price', '$time_limit', '$desc_info')";

if (mysqli_query($conn, $order_add)) {
    echo "Add order suc!";
} else {
    echo "Add false".mysqli_error($conn);
};

