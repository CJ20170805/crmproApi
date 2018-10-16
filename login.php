<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 10:44
 */

//包含数据库连接文件
include "./connect_db.php";

// 使用 sql 创建数据表
//   $sql = "CREATE TABLE loginform (
//   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   username VARCHAR(30) NOT NULL,
//   password VARCHAR(30) NOT NULL,
//   reg_date TIMESTAMP
//   )";
//
//   if (mysqli_query($conn, $sql)) {
//       echo "数据表 MyGuests 创建成功";
//   }
//  登录

//if(!isset($_POST['username'])){
//    exit('非法访问!');
//}
//$username = $_POST['username'];
//$password = $_POST['password'];
//
////检测用户名及密码是否正确
//$form_sql = "select * from loginform where st_name = '$username' and st_word = '$password' limit 1";
//$result = mysqli_query($conn, $form_sql);
//
//if($row = mysqli_fetch_array($result)){
//   // 登录成功
//    session_start();
//    $_SESSION['username'] = $row['username'];
//    $_SESSION['password'] = $row['password'];
//
//    header('Location: ../index.php');
//    exit;
//} else {
//    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
//};

header('Location: ../index.php');

//while($row = mysqli_fetch_array($result))
//{
//    echo $row['username'] . " " . $row['password'];
//    echo "<br>";
//}
//session_start();
//
//if(empty($_SESSION['abv'])){
//    header("Location: ../login.html");
//}

//include "./connect_db.php";
//
//$username = $_POST['username'];
//$password = $_POST['password'];
//
//$query_up = "SELECT * FROM loginform WHERE username='$username' AND password='$password'";
//    // $sql = "SELECT * FROM loginform WHERE username='$username' AND f_password='$pwd'";
//
////检测用户名及密码是否正确
//
//if(mysqli_query($conn, $query_up)){
//    //登录成功
////    session_start();
////    $_SESSION['username'] = $username;
//////    $_SESSION['userid'] = $result['userid'];
//
//    echo $username;
//
////    exit;
//} else {
//    echo "Query error!";
////    exit('登录失败！点击此处 <a href="javascript:history.back(-1);">返回</a> 重试');
//}



//if(!isset($username)){
//    echo 1;
//} else {
//    echo 2;
//}


//if($username === 'admin1' && $password === 'admin1'){
//    header("location: ../index.php");
//} else {
//    echo "Error!";
//    return false;
//}
//

//
//$sql = "INSERT INTO loginform (username, password)
////VALUES ('$username', '$password')";
//
//if (mysqli_query($conn, $sql)) {
//    echo "新记录插入成功";
//} else {
//    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//}

