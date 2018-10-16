<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/28
 * Time: 15:55
 */
include "./connect_db.php";

$flag = $_POST['flag'];

if ($flag === 'add') {
    // order add
    $shop_name = $_POST['shop_name'];
    $shop_url = $_POST['shop_url'];
    $shop_id = $_POST['shop_id'];
    $shop_type = $_POST['shop_type'];
    $link_man = $_POST['link_man'];
    $link_methods = $_POST['link_methods'];
    $combo_info = $_POST['combo_info'];
    $pay_price = $_POST['pay_price'];
    $pay_id = $_POST['pay_id'];
    $pay_methods = $_POST['pay_methods'];
    $pay_date = $_POST['pay_date'];
    $time_limit = $_POST['time_limit'];
    $desc_info = $_POST['desc_info'];
    $some_img = $_POST['some_img'];
    $sales_man = $_POST['sales_man'];

//$arr = array();
    // echo $shop_name.$shop_url.$shop_id.$shop_type.$link_methods.$time_limit;

    $order_add = "INSERT INTO orders (shop_name, shop_url, shop_id, shop_type,
link_man, link_methods, combo_info, pay_price, pay_id, pay_methods, pay_date, time_limit, desc_info, some_img, sales_man) VALUES ('$shop_name',
 '$shop_url', '$shop_id', '$shop_type', '$link_man', '$link_methods',
 '$combo_info', '$pay_price', '$pay_id', '$pay_methods', '$pay_date', '$time_limit', '$desc_info', '$some_img', '$sales_man')";

    if (mysqli_query($conn, $order_add)) {
        echo "AddSUC";
    } else {
        echo "AddFAL".mysqli_error($conn);
    };
} else if ($flag === 'fetch') {
//    echo "Begin Query!";
    $order_fetch = "SELECT * FROM orders";
    $orderRes = mysqli_query($conn, $order_fetch);
    $data =array();
    while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
        array_push($data, $orderRow);
    };

    $orderJson = json_encode($data);

    echo $orderJson;

} else if ($flag === 'dispense') {
    
     //  order dispense write in 
    $orderId = $_POST['orderId'];
    $id = $_POST['id'];
     
    // query before order's num
    
    $beforeOrderNum = mysqli_query($conn,"SELECT st_orders FROM staff WHERE id = '$id'");


    while ($row = mysqli_fetch_array($beforeOrderNum, MYSQL_ASSOC)) {
        // array_push($beforeOrderNumArr, $row);
        $orderId .= ",".$row[st_orders];
    };
    // echo $orderId;
  
    // $queryJson = json_encode($beforeOrderNumArr);

    // $orderWrite = "INSERT INTO staff (st_orders) VALUES ('$orderId') WHERE id=('$id')";
    // 
    $orderWrite = "UPDATE staff SET st_orders = '$orderId' WHERE id = '$id'";
    if(mysqli_query($conn, $orderWrite)){
      echo "orderWriteSuc";
    } else {
      echo "orderWrite fail".mysqli_error($conn);
    };
} else if ($flag === 'dispenseFetch') {
     
    //  order num fetch

    $userId = $_POST['userId'];

    $queryOrder = mysqli_query($conn,"SELECT st_orders FROM staff WHERE id = '$userId'");

    $queryOrderArr = array();

    while ($row = mysqli_fetch_array($queryOrder, MYSQL_ASSOC)) {
        array_push($queryOrderArr, $row);
    };
  
    $queryJson = json_encode($queryOrderArr);
    echo $queryJson;
} else if ($flag === 'dispenseDetail') {

    $orderNum = $_POST['orderNum'];
    $ordersItem = $_POST['ordersItem'];
    $ordersItemArr = explode(',', $ordersItem);
    $ordersDetailArr = array();
    foreach ($ordersItemArr as $key => $value) {
      // echo "aaa".$value;
      // 
      // 循环获取 对象 放置外部数组内 ， 并返回外部数组的json
      // 
      $order_fetch = "SELECT * FROM orders WHERE id = '$value'";
      $orderRes = mysqli_query($conn, $order_fetch);

       while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($ordersDetailArr, $orderRow);
        };

      // array_push($ordersDetailArr, $data);
    
    };

    $orderJson = json_encode($ordersDetailArr);

    echo $orderJson;

    
} else if ($flag === 'delOrder') {
     $del_id = $_POST['delId'];
    // $del_name = $_POST['del_name'];
    //  // echo $del_name;
    $del_db = "DELETE FROM orders WHERE id = '$del_id'";

    if (mysqli_query($conn, $del_db)){
       echo "DelOrderSuc";
    } else {
      echo "Del false".mysqli_error($conn);
    };
} else {
    echo "Order Error(No set flag?)";
};
