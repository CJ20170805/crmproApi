<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 11:06
 */
header("Content-type: text/html; charset=utf-8");

$db_server = "localhost";
$db_name = "root";
$db_word = "root";

// 创建连接
$conn = mysqli_connect($db_server, $db_name, $db_word);
// 检测连接
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
};

// 创建数据库
$createBase = "CREATE DATABASE db_managesy";
if (mysqli_query($conn, $createBase)) {
    echo "数据库创建成功";
}
// mysqli_close($conn);
mysqli_select_db($conn, "db_managesy");
mysqli_query($conn,"set names 'utf8'");