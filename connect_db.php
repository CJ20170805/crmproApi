<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 11:06
 */
header("Content-type: text/html; charset=utf-8");

 //  切换 =》 密码 + select_db;

$db_server = "localhost";
$db_name = "root";
$db_word = "root";

//$db_server = "bdm240853488.my3w.com";
//$db_name = "bdm240853488";
//$db_word = "a123456789";

// 创建连接
$conn = mysqli_connect($db_server, $db_name, $db_word);
// 检测连接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
};

// 创建数据库
// $createBase = "CREATE DATABASE db_managesy";
// if (mysqli_query($conn, $createBase)) {
//     echo "数据库创建成功";
// } else {
// 	die("创建失败: " . mysqli_error($conn));
// };
// mysqli_close($conn);

//mysqli_select_db($conn, "bdm240853488_db");

mysqli_select_db($conn, "db_managesy");

 mysqli_query($conn,"set names 'utf8'");