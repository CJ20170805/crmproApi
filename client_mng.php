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
    $client_address = $_POST['client_address'];
    $client_link = $_POST['client_link'];
    $link_date = $_POST['link_date'];
    $desc_info = $_POST['desc_info'];
    $write_man = $_POST['write_man'];
    $files = $_POST['files'];
    //intent client new add 1121
    $ww_name = $_POST['ww_name'];
    $shop_name = $_POST['shop_name'];
    $shop_grade = $_POST['shop_grade'];
    $shop_sort = $_POST['shop_sort'];
    $shop_url = $_POST['shop_url'];
//    echo $client_name.$sales_man;

    $client_add = "INSERT INTO client (client_name, client_address, client_link,
 link_date, desc_info, write_man, files, ww_name, shop_name, shop_grade, shop_industry, client_type, shop_url) VALUES ('$client_name',
 '$client_address', '$client_link', '$link_date', '$desc_info', '$write_man', '$files', '$ww_name', '$shop_name', '$shop_grade', '$shop_sort', 'intent', '$shop_url')";

    if (mysqli_query($conn, $client_add)) {
        echo "AddSUC";
    } else {
        echo "AddFAL".mysqli_error($conn);
    };

} elseif ($flag === 'fetch') {

//    $client_fetch = "SELECT * FROM client";
//    $clientRes = mysqli_query($conn, $client_fetch);
//    $data =array();
//    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
//        array_push($data, $row);
//    };
//    echo json_encode($data);

    $name = $_POST['name'];
    $depart = $_POST['depart'];
    $power = $_POST['power'];
//    $fetch_str = $_POST['fetch_str'];

    if ($power === "分公司总经理" || $power === "" || $power === "技术总监" || $power === "销售总监") {

        $order_fetch = "SELECT * FROM client WHERE client_type = 'reach'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $orderJson = json_encode($data);

        echo $orderJson;

    } elseif ($power === "BD经理" || $power === "AM") {

        $order_fetch = "SELECT * FROM client WHERE sales_apart = '$depart' AND client_type = 'reach'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };
        $orderJson = json_encode($data);
        echo $orderJson;

    } else {

        $order_fetch = "SELECT * FROM client WHERE sales_man = '$name' AND client_type = 'reach'";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $orderJson = json_encode($data);
        echo $orderJson;
    }
} elseif ($flag === 'delClient'){

    $delId = $_POST['delId'];

    $del_db = "DELETE FROM client WHERE id = '$delId'";

    if (mysqli_query($conn, $del_db)){

        echo "delClientSuc";

    } else {
        echo "Del false".mysqli_error($conn);
    };

} elseif($flag === 'fetchIntent'){

    $power = $_POST['power'];
    $writeM = $_POST['writeM'];
    // pagination
    $curPage = $_POST['cur_page'];
    $pageSize = $_POST['page_size'];
    $cur = ($curPage - 1) * $pageSize;
//    $fetch_str = $_POST['fetch_str']

//   @param (Boolean) f_flag  whether use the filter query?

    $filterFlag = $_POST['f_flag'];

    if ($power === "分公司总经理" || $power === "") {

        if ($filterFlag === 'true'){

            $count = "SELECT COUNT(*) FROM client WHERE client_type = 'intent' AND write_man = '$writeM'";
            $countRes = mysqli_query($conn, $count);
            $countData = mysqli_fetch_array($countRes);
            $countNum = $countData['COUNT(*)'];
//        print_r($countData);

            // 从开始位置 ， 查x条

            $order_fetch = "SELECT * FROM client WHERE client_type = 'intent' AND write_man = '$writeM' limit $cur,$pageSize";
            $orderRes = mysqli_query($conn, $order_fetch);
            $data =array();
            while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
                array_push($data, $orderRow);
            };
//
//        $orderJson = json_encode($data);

            $results = array(
                'total'=>$countNum,
                'data'=>$data
            );

            echo json_encode($results);

        } else{

            $count = "SELECT COUNT(*) FROM client WHERE client_type = 'intent'";
            $countRes = mysqli_query($conn, $count);
            $countData = mysqli_fetch_array($countRes);
            $countNum = $countData['COUNT(*)'];
//        print_r($countData);

            // 从开始位置 ， 查x条

            $order_fetch = "SELECT * FROM client WHERE client_type = 'intent' limit $cur,$pageSize";
            $orderRes = mysqli_query($conn, $order_fetch);
            $data =array();
            while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
                array_push($data, $orderRow);
            };
//
//        $orderJson = json_encode($data);

            $results = array(
                'total'=>$countNum,
                'data'=>$data
            );
            echo json_encode($results);
        }

    } else {
        $count = "SELECT COUNT(*) FROM client WHERE write_man = '$writeM' AND client_type = 'intent'";
        $countRes = mysqli_query($conn, $count);
        $countData = mysqli_fetch_array($countRes);
        $countNum = $countData['COUNT(*)'];

        $order_fetch = "SELECT * FROM client WHERE write_man = '$writeM' AND client_type = 'intent' limit $cur,$pageSize";
        $orderRes = mysqli_query($conn, $order_fetch);
        $data =array();
        while($orderRow = mysqli_fetch_array($orderRes, MYSQL_ASSOC)){
            array_push($data, $orderRow);
        };

        $results = array(
            'total'=>$countNum,
            'data'=>$data
        );
        echo json_encode($results);

//        $orderJson = json_encode($data);
//        echo $orderJson;
    }
} elseif ($flag === 'updateIntent') {
    $id = $_POST['id'];
    $client_name = $_POST['client_name'];
    $client_link = $_POST['client_link'];
    $link_date = $_POST['link_date'];
    $ww_name = $_POST['ww_name'];
    $client_address = $_POST['client_address'];
    $shop_name = $_POST['shop_name'];
    $shop_industry = $_POST['shop_industry'];
    $shop_grade = $_POST['shop_grade'];
    $desc = $_POST['desc'];
//    echo $id.$client_name.$shop_industry;

    $up = "UPDATE client SET client_name = '$client_name', client_link = '$client_link', link_date = '$link_date', ww_name = '$ww_name', client_address = '$client_address', shop_name = '$shop_name', shop_industry = '$shop_industry', shop_grade = '$shop_grade', desc_info = '$desc' WHERE id = '$id'";
    if(mysqli_query($conn, $up)){
        echo "upSuc";
    } else {
        echo "up fail".mysqli_error($conn);
    };
} else{
    echo "Unset client flag!";
};