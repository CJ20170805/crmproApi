<?php
include "./connect_db.php";

$un = $_GET['un'];
$pe = $_GET['pw'];

$query_res = '';
// 检测用户名及密码是否正确
$form_sql = "select * from loginform where username = '$un' and password = '$pw' limit 1";

$login_result = mysqli_query($conn, $form_sql);
$row = mysqli_fetch_array($login_result);

if($row > 0){
  $query_res = '10000';
} else {
  $query_res = '10001';
};

$login_arr = array("userName"=>$un,"loginCode"=>$query_res);


$json_rs = json_encode($login_arr);

echo $json_rs;