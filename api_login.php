<?php
include "./connect_db.php";

$un = $_GET['un'];
$pw = $_GET['pw'];

$query_res = '';
// 检测用户名及密码是否正确
$form_sql = "select * from loginform where st_name = '$un' and st_word = '$pw' limit 1";

$form_sql2 = "select * from staff where st_name = '$un' and st_word = '$pw' limit 1";

$login_result = mysqli_query($conn, $form_sql);
$login_result2 = mysqli_query($conn, $form_sql2);

$row = mysqli_fetch_array($login_result);

$row2 = mysqli_fetch_array($login_result2);

// if (!$row2 || !$row) {
//  printf("Error: %s\n", mysqli_error($conn));
//  exit();
// }

if($row > 0 || $row2 > 0){
  $query_res = '10000';
} else {
  $query_res = '10001';
};

$login_arr = array("userName"=>$un,"loginCode"=>$query_res);


$json_rs = json_encode($login_arr);

echo $json_rs;