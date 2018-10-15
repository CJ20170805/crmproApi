<?php
header("Content-Type:text/html;charset=utf-8");
 // 
 //     订单 相关图片
 
$file = $_FILES['file'];

//判断是否是通过HTTP POST上传的
if(!is_uploaded_file($file['tmp_name'])){
  //如果不是通过HTTP POST上传的
  return;
};

//$fileName = iconv('utf-8', 'gb2312', $file['name']);

$upload_path = "upload/orders/".$file['name']; //上传文件的存放路径



// 开始移动文件到相应的文件夹
if(move_uploaded_file($file['tmp_name'], $upload_path)){
  // echo "Successfully!".$upload_path.$file['name'];
  // echo $abUrl;
  echo "http://".$_SERVER['HTTP_HOST']."/"."crmApi/upload/orders"."/".$file['name'];
  // echo $_SERVER['DOCUMENT_ROOT'];
}else{
  echo "Failed!";
};

