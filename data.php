<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/17
 * Time: 11:31
 */
include './connect_db.php';

$count = "SELECT COUNT(*) FROM client";
$countRes = mysqli_query($conn, $count);
$countData = array();
$res = mysqli_fetch_array($countRes);
////        print_r($countData);
//echo $countData;
print_r($res);
echo $res['COUNT(*)'];