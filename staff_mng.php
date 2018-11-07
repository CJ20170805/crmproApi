<?php
 include "./connect_db.php";

$st_flag = $_POST['st_flag'];

if ($st_flag === 'add') {

 $st_name = $_POST['st_name'];
 $st_sex = $_POST['st_sex'];
 $st_joinDate = $_POST['st_joinDate'];
 $st_cardNum = $_POST['st_cardNum'];
 $st_address = $_POST['st_address'];
 $st_nowAddress = $_POST['st_nowAddress'];
 $st_staffPhone = $_POST['st_staffPhone'];
 $st_staffPhone2= $_POST['st_staffPhone2'];
 $st_departmentVal = $_POST['st_departmentVal'];
 $st_jobVal = $_POST['st_jobVal'];
 $st_elseInfo = $_POST['st_elseInfo'];

//  插入数据
$insert_db = "INSERT INTO staff (st_name, st_sex, st_joinDate, st_cardNum, st_address, st_nowAddress, st_staffPhone, st_staffPhone2, st_departmentVal, st_jobVal, st_elseInfo, st_power) VALUES (
'$st_name', '$st_sex', '$st_joinDate', '$st_cardNum', '$st_address', '$st_nowAddress', '$st_staffPhone', '$st_staffPhone2', '$st_departmentVal', '$st_jobVal', '$st_elseInfo', '$st_jobVal')";

if (mysqli_query($conn, $insert_db)){
  echo "AddSuccess";
} else {
  echo "AddFalse".mysqli_error($conn);
};
} else if($st_flag === 'del'){

	$del_id = $_POST['del_id'];
	$del_name = $_POST['del_name'];
     // echo $del_name;
	$del_db = "DELETE FROM staff WHERE id = '$del_id' AND st_name = '$del_name'";

	if (mysqli_query($conn, $del_db)){
	   echo "DelSuccess";
	} else {
	  echo "Del false".mysqli_error($conn);
	};
} else if($st_flag === 'update'){

	 $st_id = $_POST['st_id'];
	 $st_name = $_POST['st_name'];
	 $st_sex = $_POST['st_sex'];
	 $st_joinDate = $_POST['st_joinDate'];
	 $st_cardNum = $_POST['st_cardNum'];
	 $st_address = $_POST['st_address'];
	 $st_nowAddress = $_POST['st_nowAddress'];
	 $st_staffPhone = $_POST['st_staffPhone'];
	 $st_staffPhone2= $_POST['st_staffPhone2'];
	 $st_departmentVal = $_POST['st_departmentVal'];
	 $st_jobVal = $_POST['st_jobVal'];
	 $st_elseInfo = $_POST['st_elseInfo'];

	$ud = "UPDATE staff SET st_name = '$st_name', st_sex = '$st_sex', st_joinDate = '$st_joinDate', st_cardNum = '$st_cardNum', st_address = '$st_address', st_nowAddress = '$st_nowAddress', st_staffPhone = '$st_staffPhone', st_staffPhone2 = '$st_staffPhone2', st_departmentVal = '$st_departmentVal', st_jobVal = '$st_jobVal', st_elseInfo = '$st_elseInfo' WHERE id = '$st_id'";
	if (mysqli_query($conn, $ud)){
       echo "Set Successs!!!!!";     
	} else {
	  echo "Error".mysqli_error($conn);
	}
} else if($st_flag === 'audit') {

    $order_id = $_POST['order_id'];
    $staff_depart = $_POST['staff_depart'];

    $rd = "SELECT audit_content FROM staff WHERE st_departmentVal = '$staff_depart' AND st_jobVal = 'BD经理'";

    $res = mysqli_query($conn, $rd);

    $row = mysqli_fetch_array($res, MYSQL_ASSOC);

     $newVal = "";

    if (!empty($row)) {

        $newVal = $row['audit_content'].";".$order_id;
//        echo $newVal;

    } else {
        $newVal = $order_id;
    }

    // echo $newVal;

    $it = "UPDATE staff SET audit_content = '$newVal' WHERE st_departmentVal = '$staff_depart' AND st_jobVal = 'BD经理'";

    if (mysqli_query($conn, $it)) {
        echo "notiSuc";
    } else {
        echo "Err".mysqli_error($conn);
    };

} else if ($st_flag === 'auditFetch') {

    $staff_id = $_POST['staff_id'];

//    echo $staff_id;

    $rd = "SELECT audit_content FROM staff WHERE id = '$staff_id'";

    $res = mysqli_query($conn, $rd);

    $row = mysqli_fetch_array($res, MYSQL_ASSOC);

    echo $row['audit_content'];

} else {
    echo 'No sql command!!!';
};