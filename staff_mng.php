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
$insert_db = "INSERT INTO staff (st_name, st_sex, st_joinDate, st_cardNum, st_address, st_nowAddress, st_staffPhone, st_staffPhone2, st_departmentVal, st_jobVal, st_elseInfo) VALUES (
'$st_name', '$st_sex', '$st_joinDate', '$st_cardNum', '$st_address', '$st_nowAddress', '$st_staffPhone', '$st_staffPhone2', '$st_departmentVal', '$st_jobVal', '$st_elseInfo')";

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
} else {
	echo 'No sql command!!!';
}