<?php
 // 
 //     用户头像
 
$file = $_FILES['file'];

//判断是否是通过HTTP POST上传的
if(!is_uploaded_file($file['tmp_name'])){
  //如果不是通过HTTP POST上传的
  return;
};

$fileNameURL = $file['name'];

$upload_path = "upload/userAvatar/"; //上传文件的存放路径

$abUrl = $upload_path.$fileNameURL;
// 开始移动文件到相应的文件夹
if(move_uploaded_file($file['tmp_name'], $abUrl)){
  // echo "Successfully!".$upload_path.$file['name'];
  // echo $abUrl;
  echo "http://".$_SERVER['HTTP_HOST']."/"."crmproApi"."/".$upload_path.urldecode($fileNameURL);
  // echo $_SERVER['DOCUMENT_ROOT'];
}else{
  echo "Failed!";
};

