<?php
include "./connect_db.php";

  //  用户信息查询

$userCode = $_POST['code'];

if ($userCode === '100') {

// Catch login user's info

$username = $_POST['username'];

$loginInfo = "SELECT * FROM staff WHERE st_name = '$username'";

$infoRes = mysqli_query($conn, $loginInfo);
$resArr = array();

while($row = mysqli_fetch_array($infoRes)) {
	  array_push($resArr, $row);
	};

$infoResJson = json_encode($resArr);
echo $infoResJson;

} else if ($userCode === '200') {

    // Password Reset

	$newPass = $_POST['newPass'];
	$userId = $_POST['userId'];
	$userName = $_POST['userName'];
    
    $updatePW = "UPDATE staff SET st_word = '$newPass' WHERE id = '$userId' AND st_name = '$userName'";
    if(mysqli_query($conn, $updatePW)){
    	echo "update Success";
    } else {
    	echo "update Error".mysqli_error($conn);
    };
	// echo $userName.$userId.md5($newPass);
} else if ($userCode === '300') {

    // User Avatar Seting
    // 
	$newImgUrl = $_POST['newImgUrl'];
	$userId = $_POST['userId'];
	$userName = $_POST['userName'];
    
    $updatePW = "UPDATE staff SET st_avatar = '$newImgUrl' WHERE id = '$userId' AND st_name = '$userName'";
    if(mysqli_query($conn, $updatePW)){
    	echo "update Avatar Success";
    } else {
    	echo "update Avatar Error".mysqli_error($conn);
    };
} else if ($userCode === '400') {

    // Get all user's name

    $getNames = "SELECT st_name, st_departmentVal FROM staff";
    $getNamesRes = mysqli_query($conn, $getNames);

    $namesArr = array();
    while($nameRow = mysqli_fetch_array($getNamesRes)){
        array_push($namesArr, $nameRow);
    };
    $namesJson = json_encode($namesArr);
    echo $namesJson;

} else {
    echo "UserInfo_Error:".mysqli_error($conn);
}