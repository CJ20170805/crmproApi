<?php
include "./connect_db.php";

 // 使用 sql 创建数据表
    $sql = "CREATE TABLE staff (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    st_name VARCHAR(30) NOT NULL,
    st_sex VARCHAR(30) NOT NULL,
    st_joinDate VARCHAR(30) NOT NULL,
    st_cardNum VARCHAR(30) NOT NULL,
    st_address VARCHAR(30) NOT NULL,
    st_nowAddress VARCHAR(30) NOT NULL,
    st_staffPhone VARCHAR(30) NOT NULL,
    st_staffPhone2 VARCHAR(30) NOT NULL,
    st_departmentVal VARCHAR(30) NOT NULL,
    st_jobVal VARCHAR(30) NOT NULL,
    st_elseInfo VARCHAR(30) NOT NULL,
    st_word VARCHAR(30) NOT NULL DEFAULT '12321',
    st_avatar VARCHAR(255),
    reg_date TIMESTAMP
    )";

    if (mysqli_query($conn, $sql)) {
        echo "staff数据表创建成功";
    } else {
        echo "create error staff".mysqli_error($conn);
    };

     // 使用 sql 创建数据表
    $sql2 = "CREATE TABLE loginform (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    st_name VARCHAR(30) NOT NULL,
    st_word VARCHAR(30) NOT NULL DEFAULT '12321',
    reg_date TIMESTAMP
    )";

   if (mysqli_query($conn, $sql2)) {
        echo "loginform数据表创建成功";
    } else {
        echo "create error staff".mysqli_error($conn);
    };