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
    $shop_grade = $_POST['shop_grade'];
    $shop_industry = $_POST['shop_industry'];
    $shop_address = $_POST['shop_address'];
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
    $sales_id = $_POST['sales_id'];
    $sales_apart = $_POST['sales_apart'];
    $buy_type = $_POST['buy_type'];
    $rec_id = $_POST['rec_id'];
    $price_id = $_POST['price_id'];
    $write_man = $_POST['write_man'];

//$arr = array();
    // echo $shop_name.$shop_url.$shop_id.$shop_type.$link_methods.$time_limit;

    $order_add = "INSERT INTO orders (shop_name, shop_url, shop_id, shop_type,
link_man, link_methods, combo_info, pay_price, pay_id, pay_methods, pay_date, time_limit, desc_info, some_img, sales_man, buy_type, rec_id, price_id, sales_id, sales_apart) VALUES ('$shop_name',
 '$shop_url', '$shop_id', '$shop_type', '$link_man', '$link_methods',
 '$combo_info', '$pay_price', '$pay_id', '$pay_methods', '$pay_date', '$time_limit', '$desc_info', '$some_img', '$sales_man', '$buy_type', '$rec_id', '$price_id', '$sales_id', '$sales_apart')";

    if (mysqli_query($conn, $order_add)) {
        echo "AddSUC";
    } else {
        echo "AddFAL".mysqli_error($conn);
    };


//    // pm _ ADD
//
    $pm_add = "INSERT INTO pm (reach_id, reach_apart, reach_name, reach_date,
client_name, buy_serv, serv_price, time_limit, pay_price, pay_id, rec_id, deal_id, else_desc, upload_imgs, buy_type, $buy_type) VALUES ('$sales_id',
 '$sales_apart', '$sales_man', '$pay_date', '$link_man', '$combo_info',
 '$pay_price', '$time_limit', '$pay_price', '$pay_id', '$rec_id', '$price_id', '$desc_info', '$some_img', '$buy_type', '$pay_price')";

  mysqli_query($conn, $pm_add);
//
//   // client ADD

    $client_add = "INSERT INTO client (client_name, client_address, client_link,
sales_man, write_man, shop_name, shop_url, shop_id, shop_grade, shop_industry, shop_type, files, combo_type) VALUES ('$link_man',
 '$shop_address', '$link_methods', '$sales_man', '$write_man', '$shop_name',
 '$shop_url', '$shop_id', '$shop_grade', '$shop_industry', '$shop_type', '$some_img', '$combo_info')";

    mysqli_query($conn, $client_add);

} else if ($flag === 'fetch') {
//    echo "Begin Query!";
    $name = $_POST['name'];
    $depart = $_POST['depart'];
    $power = $_POST['power'];

    if ($power === "分公司总经理" || $power === "" || $power === "技术总监" || $power === "销售总监") {

        $order_fetch = "SELECT * FROM orders";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $orderJson = json_encode($data);

        echo $orderJson;

    } elseif ($power === "BD经理" || $power === "AM") {

        $order_fetch = "SELECT * FROM orders WHERE sales_apart = '$depart'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $orderJson = json_encode($data);
        echo $orderJson;
    } else {

        $order_fetch = "SELECT * FROM orders WHERE sales_man = '$name'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $orderJson = json_encode($data);
        echo $orderJson;
    }


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
} else if ($flag === 'auditOrderFetch') {

    $order_id = $_POST['order_id'];
    $order_arr = explode(';', $order_id);
    $ordersDetailArr = array();
    foreach ($order_arr as $key => $value) {
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

} else if ($flag === 'changeStu') {

    $order_id = $_POST['order_id'];
    $where_audit = $_POST['where_audit'];
    $audit_code = $_POST['audit_code'];
    $staff_id = $_POST['staff_id'];

    $sales_man = $_POST['sales_man'];
    $pay_price = $_POST['pay_price'];
    $link_man = $_POST['link_man'];



    $sql = "UPDATE orders SET $where_audit = '$audit_code' WHERE id = '$order_id'";

    if(mysqli_query($conn, $sql)){
        echo "auditChangeSuc";
    } else {
        echo "auditChange fail".mysqli_error($conn);
    };

    // audit the PM
    $sql66 = "UPDATE pm SET stu = '1' WHERE reach_name = '$sales_man' AND pay_price = '$pay_price' AND client_name = '$link_man'";

    mysqli_query($conn, $sql66);

    if ($audit_code === '2' || $audit_code === '3') {

        //fetch had no audit orders
        $rd = "SELECT audit_content FROM staff WHERE id = '$staff_id'";
        $res = mysqli_query($conn, $rd);
        $row = mysqli_fetch_array($res, MYSQL_ASSOC);

          $noAudit = $row['audit_content'];

        // fetch alAudit orders
        $rd2 = "SELECT audit_content2 FROM staff WHERE id = '$staff_id'";
        $res2 = mysqli_query($conn, $rd2);
        $row2 = mysqli_fetch_array($res2, MYSQL_ASSOC);

          $alAudit = $row2['audit_content2'];

          $alAudit .= $order_id.";";

        // write in alAudit's place

            $sql = "UPDATE staff SET audit_content2 = '$alAudit' WHERE id = '$staff_id'";

            mysqli_query($conn, $sql);

            //   10;20;30   =>  0
            //   10;        =>  0;20;30;

        // change init value
//        $begin = strpos($noAudit, $order_id);
//          $stRes =substr($noAudit, $begin, 3);
          $strs = explode(';', $noAudit);
          $strs_new = "";

          foreach ($strs as $key => $value) {
//              echo $value;
              if ($value !== ""){
                  if (strpos($value, $order_id) === false) {
//                  array_push($str_arr, $value);
                      $strs_new .= $value.";";
                  }
              }
          }
        //  echo "strsNew".$strs_new;
        $sql2 = "UPDATE staff SET audit_content = '$strs_new' WHERE id = '$staff_id'";

        mysqli_query($conn, $sql2);

//          print_r($str_arr);
//        echo $noAudit."!!!".$alAudit."!!!";
    };

} else if ($flag === 'changeBtnText') {
   // echo "changeText";
   $order_id = $_POST['order_id'];
   $btn_text = $_POST['btn_text'];
   $sql = "UPDATE orders SET order_status = '$btn_text' WHERE id = '$order_id'";

    if(mysqli_query($conn, $sql)){
        echo "auditBtnChangeSuc";
    } else {
        echo "auditChange fail".mysqli_error($conn);
    };

    if ($btn_text === '已通过审核') {

        $sql3 = "UPDATE orders SET order_code = '2' WHERE id = '$order_id'";
        if(mysqli_query($conn, $sql3)){
            echo "auditBtnChangeSuc3";
        } else {
            echo "auditChange fail3".mysqli_error($conn);
        };

    } else {

        $sql2 = "UPDATE orders SET order_code = '1' WHERE id = '$order_id'";
        if(mysqli_query($conn, $sql2)){
            echo "auditBtnChangeSuc2";
        } else {
            echo "auditChange fail2".mysqli_error($conn);
        };
    }
} else {
    echo "Order Error(No set flag?)";
};
