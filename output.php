<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/22
 * Time: 9:34
 */
include "./connect_db.php";

//header('Content-type: text/html; charset=utf-8');
//header('Content-type: application/vnd.ms-excel');
//header('Content-Disposition: filename=test.xsl');

$res = mysqli_query($conn, "SELECT * FROM client");

$arr =array();

while ($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
//    echo $row[0]."\t".$row[1]."\t".$row[2]."\t\n";
    array_push($arr, $row);
};

$excel = exportexcel($arr, array('编号','渠道名称','点击次数','最后操作时间'),
    'ChannelData');

function exportexcel ($data=array(),$title=array(),$filename='report')
{
    header("Content-type:application/octet-stream");
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=" . $filename . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    //导出xls 开始

    if (!empty($title)) {
        foreach ($title as $k => $v) {
            $title[$k] = iconv("UTF-8", "GB2312", $v);
        }
        $title = implode("\t", $title);
        echo "$title\n";
    }
    if (!empty($data))
    {
        foreach($data as $key=>$val)
        {
            foreach ($val as $ck => $cv)
            {
                $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
            }
            $data[$key]=implode("\t", $data[$key]);
        }

        echo implode("\n",$data);
     }
};
