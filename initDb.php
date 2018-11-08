<?php
include "./connect_db.php";

// // 使用 sql 创建数据表
//    $sql1 = "CREATE TABLE staff (
//    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//    st_name VARCHAR(30) NOT NULL,
//    st_sex VARCHAR(30) NOT NULL,
//    st_joinDate VARCHAR(30) NOT NULL,
//    st_cardNum VARCHAR(30) NOT NULL,
//    st_address VARCHAR(30) NOT NULL,
//    st_nowAddress VARCHAR(30) NOT NULL,
//    st_staffPhone VARCHAR(30) NOT NULL,
//    st_staffPhone2 VARCHAR(30) NOT NULL,
//    st_departmentVal VARCHAR(30) NOT NULL,
//    st_jobVal VARCHAR(30) NOT NULL,
//    st_elseInfo VARCHAR(30) NOT NULL,
//    st_word VARCHAR(30) NOT NULL DEFAULT '12321',
//    st_power VARCHAR(30) NOT NULL,
//    st_avatar VARCHAR(255),
//    st_orders VARCHAR(255),
//    best_flag INT(2),
//    best_reason VARCHAR(255),
//    audit_content VARCHAR(255),
//    reg_date TIMESTAMP
//    )";
//
//    if (mysqli_query($conn, $sql1)) {
//        echo "staff数据表创建成功";
//    } else {
//        echo "create error staff".mysqli_error($conn);
//    };
////
//     // 使用 sql 创建数据表
//    $sql2 = "CREATE TABLE loginform (
//    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//    st_name VARCHAR(30) NOT NULL,
//    st_word VARCHAR(30) NOT NULL DEFAULT '12321',
//    reg_date TIMESTAMP
//    )";
//
//   if (mysqli_query($conn, $sql2)) {
//        echo "loginform数据表创建成功";
//    } else {
//        echo "create error staff".mysqli_error($conn);
//    };
//
//// 使用 sql 创建数据表

 $sql2 = "CREATE TABLE orders (
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     shop_name VARCHAR(255) NOT NULL,
     shop_url VARCHAR(255) NOT NULL,
     shop_id VARCHAR(30) NOT NULL,
     shop_type VARCHAR(30) NOT NULL,
     link_man VARCHAR(30) NOT NULL,
     link_methods VARCHAR(255) NOT NULL,
     combo_info VARCHAR(255) NOT NULL,
     pay_price VARCHAR(30) NOT NULL,
     pay_id VARCHAR(30) NOT NULL,
     pay_methods VARCHAR(30) NOT NULL,
     pay_date VARCHAR(30) NOT NULL,
     time_limit VARCHAR(30) NOT NULL,
     desc_info VARCHAR(500) NOT NULL,
     some_img VARCHAR(1000),
     sales_man VARCHAR(255),
     buy_type VARCHAR(30),
     rec_id VARCHAR(30),
     price_id VARCHAR(30),
     jl_audit VARCHAR(2) NOT NULL DEFAULT '1',
     zjl_audit VARCHAR(2) NOT NULL DEFAULT '1',
     order_status VARCHAR(30) NOT NULL DEFAULT '发起审核',
     order_code VARCHAR(2) NOT NULL DEFAULT '0',
     reg_date TIMESTAMP
     )";

 if (mysqli_query($conn, $sql2)) {
     echo "orders数据表创建成功";
 } else {
     echo "create error staff".mysqli_error($conn);
 };

 if (mysqli_query($conn, "ALTER TABLE orders AUTO_INCREMENT = 10000")) {
     echo "Orders Primary Changed!";
 } else {
     echo "Primary change error".mysqli_error($conn);
 };
////
// // 使用 sql 创建数据表
//   $sql = "CREATE TABLE acord (
//   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   order_id VARCHAR(30) NOT NULL,
//   acord_title VARCHAR(255) NOT NULL,
//   acord_content VARCHAR(1000) NOT NULL,
//   acord_man VARCHAR(30) NOT NULL,
//   acord_img VARCHAR(1000) NOT NULL,
//   reg_date TIMESTAMP
//   )";
//
//   if (mysqli_query($conn, $sql)) {
//       echo "acord数据表创建成功";
//   } else {
//       echo "create error staff".mysqli_error($conn);
//   };

 // 使用 sql 创建数据表
//   $sql3 = "CREATE TABLE client (
//   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   client_name VARCHAR(30) NOT NULL,
//   client_address VARCHAR(255) NOT NULL,
//   client_link VARCHAR(30) NOT NULL,
//   sales_man VARCHAR(30) NOT NULL,
//   write_man VARCHAR(30) NOT NULL,
//   shop_name VARCHAR(30) NOT NULL,
//   shop_url VARCHAR(30) NOT NULL,
//   shop_id VARCHAR(30) NOT NULL,
//   shop_grade VARCHAR(30) NOT NULL,
//   shop_industry VARCHAR(30) NOT NULL,
//   shop_type VARCHAR(30) NOT NULL,
//   combo_type VARCHAR(30) NOT NULL,
//   files VARCHAR (1000),
//   reg_date TIMESTAMP
//   )";
//
//   if (mysqli_query($conn, $sql3)) {
//       echo "client数据表创建成功";
//   } else {
//       echo "create error client".mysqli_error($conn);
//   };
//
// if (mysqli_query($conn, "ALTER TABLE client AUTO_INCREMENT = 20000")) {
//     echo "Client Primary Changed!";
// } else {
//     echo "Primary change error".mysqli_error($conn);
// };
//
//$sql4 = "CREATE TABLE pm (
//   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   reach_id VARCHAR(30) NOT NULL,
//   reach_apart VARCHAR(30) NOT NULL,
//   reach_name VARCHAR(30) NOT NULL,
//   reach_date VARCHAR(30) NOT NULL,
//   client_name VARCHAR(30) NOT NULL,
//   buy_serv VARCHAR(60) NOT NULL,
//   serv_price VARCHAR(30) NOT NULL,
//   time_limit VARCHAR(30) NOT NULL,
//   pay_price VARCHAR(30) NOT NULL,
//   pay_id VARCHAR(30) NOT NULL,
//   rec_id VARCHAR(30) NOT NULL,
//   deal_id VARCHAR(30) NOT NULL,
//   else_desc VARCHAR(300) NOT NULL,
//   upload_imgs VARCHAR (1000),
//   buy_type VARCHAR(30) NOT NULL,
//   zuanzhan VARCHAR(30) NOT NULL,
//   zhitongche VARCHAR(30) NOT NULL,
//   tuoguan VARCHAR(30) NOT NULL,
//   zhuangxiu VARCHAR(30) NOT NULL,
//   yongjin VARCHAR(30) NOT NULL,
//   qita VARCHAR(30) NOT NULL,
//   reg_date TIMESTAMP
//   )";
//
//if (mysqli_query($conn, $sql4)) {
//    echo "PM数据表创建成功";
//} else {
//    echo "create error pm".mysqli_error($conn);
//};
//
//if (mysqli_query($conn, "ALTER TABLE pm AUTO_INCREMENT = 30000")) {
//    echo "pm Primary Changed!";
//} else {
//    echo "Primary change error".mysqli_error($conn);
//};