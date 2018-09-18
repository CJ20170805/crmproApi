<?php
 include "./connect_db.php";
 header('Content-Type:application/json');

 $code = $_GET['code'];

 

 if($code == 1){
    //  查询数据库
    $query_staff = "SELECT * FROM staff";
    $qs_result = mysqli_query($conn, $query_staff);
    $qs_arr = array();
    while($row = mysqli_fetch_array($qs_result)){
       array_push($qs_arr, $row);
    }

    $json_rs = json_encode($qs_arr);
    echo $json_rs;
 } else if ($code == 2){
    $st_name=$_POST['st_name'];
    $st_sex=$_POST['st_sex'];
    $st_birth=$_POST['st_birth'];
    $st_address=$_POST['st_address'];
    $st_password=$_POST['st_password'];
    $insert_staff = "INSERT INTO staff (st_name, st_sex) VALUES ('$st_name', '$st_sex')";
   if( mysqli_query($conn, $insert_staff)) {
       echo "add suc";
   } else {
       echo "add false";
   }
 } else {
     echo "nononono";
 }

 //     print_r($json_rs);
 //    if($qs_result){
 //      echo 'quer1';
 //    } else {
 //      echo 'quer2';
 //    }