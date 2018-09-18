<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 17:41
 */
 include "./connect_db.php";

 // 使用 sql 创建数据表
    $sql = "CREATE TABLE staff (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    st_name VARCHAR(30) NOT NULL,
    st_sex VARCHAR(30) NOT NULL,
    st_birth VARCHAR(30) NOT NULL,
    st_address VARCHAR(30) NOT NULL,
    st_password VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP
    )";

    if (mysqli_query($conn, $sql)) {
        echo "数据表 MyGuests 创建成功";
    } else {
        echo "create error staff".mysqli_error($conn);
    }

    $st_name = $_POST['st_name'];
    $st_sex = $_POST['st_sex'];
    $st_birth = $_POST['st_birth'];
    $st_address = $_POST['st_address'];
    $st_password = $_POST['st_word'];

//  插入数据
    $insert_db = "INSERT INTO staff (st_name, st_sex, st_birth, st_address, st_password) VALUES (
    '$st_name', '$st_sex',' $st_birth', '$st_address', '$st_password')";

    if (mysqli_query($conn, $insert_db)){
       header("location: ../index.php");
    } else {
      echo "Add false";
    };
