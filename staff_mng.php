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
 $files = $_POST['files'];
 $whether_regular = $_POST['whether_regular'];
 $regular_date = $_POST['regular_date'];
 $nation = $_POST['nation'];
    $edu_back = $_POST['edu_back'];
    $school_name = $_POST['school_name'];
    $major = $_POST['major'];

//  插入数据
$insert_db = "INSERT INTO staff (st_name, st_sex, st_joinDate, st_cardNum, st_address, st_nowAddress, st_staffPhone, st_staffPhone2, st_departmentVal, st_jobVal, st_elseInfo, st_power, files, whether_regular, regular_date, nation, edu_back, school_name, major) VALUES (
'$st_name', '$st_sex', '$st_joinDate', '$st_cardNum', '$st_address', '$st_nowAddress', '$st_staffPhone', '$st_staffPhone2', '$st_departmentVal', '$st_jobVal', '$st_elseInfo', '$st_jobVal', '$files' , '$whether_regular', '$regular_date', '$nation', '$edu_back', '$school_name', '$major')";

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

    $whether_regular = $_POST['whether_regular'];
    $regular_date = $_POST['regular_date'];
    $nation = $_POST['nation'];
    $edu_back = $_POST['edu_back'];
    $school_name = $_POST['school_name'];
    $major = $_POST['major'];

	$ud = "UPDATE staff SET st_name = '$st_name', st_sex = '$st_sex',
 st_joinDate = '$st_joinDate', st_cardNum = '$st_cardNum', st_address = '$st_address',
  st_nowAddress = '$st_nowAddress', st_staffPhone = '$st_staffPhone', 
  st_staffPhone2 = '$st_staffPhone2', st_departmentVal = '$st_departmentVal',
   st_jobVal = '$st_jobVal',
    st_elseInfo = '$st_elseInfo', whether_regular = '$whether_regular', regular_date = '$regular_date', nation = '$nation', edu_back = '$edu_back', school_name = '$school_name', major = '$major' WHERE id = '$st_id'";
	if (mysqli_query($conn, $ud)){
       echo "Set Successs!!!!!";     
	} else {
	  echo "Error".mysqli_error($conn);
	}
} else if($st_flag === 'audit') {

    $order_id = $_POST['order_id'];         // order ID
    $staff_depart = $_POST['staff_depart']; // depart
    $staff_job = $_POST['staff_job'];       // job

    $rd = "SELECT audit_content FROM staff WHERE st_departmentVal = '$staff_depart' AND st_jobVal = '$staff_job'";

    $res = mysqli_query($conn, $rd);

    $row = mysqli_fetch_array($res, MYSQL_ASSOC);

     $newVal = "";
//   print_r($row);
    if (strpos($row['audit_content'], $order_id) === false) {

        $newVal = $row['audit_content'].$order_id.";";

    } else {
        echo "Had order's id!!!";
        exit;
    }

//
   // echo $newVal;
//
    $it = "UPDATE staff SET audit_content = '$newVal' WHERE st_departmentVal = '$staff_depart' AND st_jobVal = '$staff_job'";

    if (mysqli_query($conn, $it)) {
        echo "notiSuc";
    } else {
        echo "Err".mysqli_error($conn);
    };
//
} else if ($st_flag === 'auditFetch') {

    $staff_id = $_POST['staff_id'];
//    $col_name = $_POST['col_name'];

//    echo $staff_id;

    $rd = "SELECT audit_content FROM staff WHERE id = '$staff_id'";

    $res = mysqli_query($conn, $rd);

    $row = mysqli_fetch_array($res, MYSQL_ASSOC);

    echo $row['audit_content'];

} else if ($st_flag === 'auditFetch2') {

    $staff_id = $_POST['staff_id'];
//    $col_name = $_POST['col_name'];

//    echo $staff_id;

    $rd = "SELECT audit_content2 FROM staff WHERE id = '$staff_id'";

    $res = mysqli_query($conn, $rd);

    $row = mysqli_fetch_array($res, MYSQL_ASSOC);

    echo $row['audit_content2'];

} else {
    echo 'No sql command!!!';
};