<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/22
 * Time: 11:35
 */
include "./connect_db.php";

function exportExcel($arr, $name) {

    require_once "./Classes/PHPExcel.php";

    $objPHPExcel = new PHPExcel();

    $objPHPExcel
        ->getProperties()
        ->setCreator("CJ")
        ->setLastModifiedBy("CJ")
        ->setTitle("export data");

// 给表格添加数据

//设置当前的表格
    $objPHPExcel->setActiveSheetIndex(0);
// 设置表格第一行显示内容
    $objPHPExcel->getActiveSheet()
        ->setCellValue('A1', '序号')
        ->setCellValue('B1', '签单人')
        ->setCellValue('C1', '所属部门')
        ->setCellValue('D1', '签单时间')
        ->setCellValue('E1', '客户名称')
        ->setCellValue('F1', '订购服务')
        ->setCellValue('G1', '服务价格')
        ->setCellValue('H1', '服务期限')
        ->setCellValue('I1', '支付金额')
        ->setCellValue('J1', '支付账户')
        ->setCellValue('K1', '收款账户')
        ->setCellValue('L1', '交易订单号')
        ->setCellValue('M1', '备注信息')
        ->setCellValue('N1', '录入时间')
        ->getStyle('A1:N1')->getFont()->getColor()->setARGB(PHPExcel_style_Color::COLOR_RED);

    $objPHPExcel->getActiveSheet()->getstyle('A1:N1')->getFont()->setBold(true);

    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);


    $key = 1;
    /*以下就是对处理Excel里的数据，横着取数据*/
    foreach($arr as $v){

        //设置循环从第二行开始
        $key++;
        $objPHPExcel->getActiveSheet()

            //Excel的第A列，name是你查出数组的键值字段，下面以此类推
            ->setCellValue('A'.$key, $v['id'])
            ->setCellValue('B'.$key, $v['reach_name'])
            ->setCellValue('C'.$key, $v['reach_apart'])
            ->setCellValue('D'.$key, $v['reach_date'])
            ->setCellValue('E'.$key, $v['client_name'])
            ->setCellValue('F'.$key, $v['buy_serv'])
            ->setCellValue('G'.$key, "\t".$v['serv_price'])
            ->setCellValue('H'.$key, $v['time_limit'])
            ->setCellValue('I'.$key, $v['pay_price'])
            ->setCellValue('J'.$key, "\t".$v['pay_id'])
            ->setCellValue('K'.$key, "\t".$v['rec_id'])
            ->setCellValue('L'.$key, "\t".$v['deal_id'])
            ->setCellValue('M'.$key, $v['else_desc'])
            ->setCellValue('N'.$key, $v['reg_date']);

    }
//设置当前的表格
    $objPHPExcel->setActiveSheetIndex(0);

    ob_end_clean();  //清除缓冲区,避免乱码

    header('Content-Type: application/vnd.ms-excel'); //文件类型
    header('Content-Disposition: attachment;filename="'.$name.'.xls"'); //文件名
    header('Cache-Control: max-age=0');
    header('Content-Type: text/html; charset=utf-8'); //编码

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel 2003
    $objWriter->save('php://output');
    exit;
}


//$res = mysqli_query($conn, "SELECT * FROM pm");
//
//$arr =array();
//
//while ($row = mysqli_fetch_array($res, MYSQL_ASSOC)){
////    echo $row[0]."\t".$row[1]."\t".$row[2]."\t\n";
//    array_push($arr, $row);
//};


$bn = $_GET['bn'];

$ed = $_GET['ed'];

$sid = $_GET['sid'];

//    echo $end."ConditionFetch!!!!".$begin;

if($bn && $ed !== ""){
    $client_fetch = "SELECT * FROM pm WHERE reg_date BETWEEN '$bn' AND '$ed'";
    $clientRes = mysqli_query($conn, $client_fetch);
    $data =array();
    while($row = mysqli_fetch_array($clientRes, MYSQL_ASSOC)){
        array_push($data, $row);
    };

    $excel = exportExcel($data, 'PerformanceDataExport');
} elseif ($sid !== ""){
//    echo gettype($sid);
//   $ids = explode(",", $sid);
   $select_query = "SELECT * FROM pm WHERE id in ($sid)";
   $selectRes = mysqli_query($conn, $select_query);
   $data2 =array();
    while($row = mysqli_fetch_array($selectRes, MYSQL_ASSOC)){
        array_push($data2, $row);
    };

    $excel2 = exportExcel($data2, 'PerformanceDataExport');
} else {
    exit;
};