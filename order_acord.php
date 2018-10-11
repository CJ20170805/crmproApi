<?php
include "./connect_db.php";
 $flag = $_POST['flag'];

 if ($flag === 'addAcord') {
     $order_id = $_POST['order_id'];
     $acord_title = $_POST['acord_title'];
     $acord_content = $_POST['acord_content'];
     $acord_man = $_POST['acord_man'];
     $acord_img = $_POST['acord_img'];

//  echo $order_id.$acord_title.$acord_content.$acord_man.$acord_img;

     $acord_add = "INSERT INTO acord (order_id, acord_title, acord_content, acord_man, acord_img) 
VALUES ('$order_id', '$acord_title', '$acord_content', '$acord_man', '$acord_img')";

     if (mysqli_query($conn, $acord_add)) {
         echo "addAcordSuc";
     } else {
         echo "AddFAL".mysqli_error($conn);
     };
 } elseif ($flag === 'fetchAcord') {

     //  order num fetch

     $order_id = $_POST['order_id'];
//
//     $queryRes = mysqli_query($conn,"SELECT * FROM acord WHERE order_id = '$order_id'");

     $queryRes = mysqli_query($conn, "SELECT * FROM acord WHERE order_id = '$order_id'");

     $queryAcordArr = array();

     while($row = mysqli_fetch_array($queryRes, MYSQL_ASSOC)) {

         array_push($queryAcordArr, $row);

     };

     $queryJson = json_encode($queryAcordArr);

     echo $queryJson;
 };