<?php
 // 
 //     用户头像
 
// $file = $_FILES['file'];

// //判断是否是通过HTTP POST上传的
// if(!is_uploaded_file($file['tmp_name'])){
//   //如果不是通过HTTP POST上传的
//   return;
// };

// $upload_path = "./upload/userAvatar/"; //上传文件的存放路径
// //开始移动文件到相应的文件夹
// if(move_uploaded_file($file['tmp_name'],$upload_path.$file['name'])){
//   echo "Successfully!";
// }else{
//   echo "Failed!";
// }


//  用户信息查询
$userCode = $_POST['code'];
$username = $_POST['username'];
echo $userCode."LLALALALA".$username;
