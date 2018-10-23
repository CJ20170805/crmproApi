<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 18:05
 */
include "./connect_db.php";

$now_date = $_POST['now_date'];

$count_fetch = "SELECT * FROM pm WHERE reg_date LIKE '2018-10-19%'";
$countRes = mysqli_query($conn, $count_fetch);
$data =array();
while($row = mysqli_fetch_array($countRes, MYSQL_ASSOC)){
    array_push($data, $row);
};

echo json_encode($data);