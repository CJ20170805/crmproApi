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
        ->setCellValue('A1', '事业部')
        ->setCellValue('B1', '签单部门')
        ->setCellValue('C1', '签单人')
        ->setCellValue('D1', '店铺ID')
        ->setCellValue('E1', '店铺名称')
        ->setCellValue('F1', '签单产品')
        ->setCellValue('G1', '签单类型')
        ->setCellValue('H1', '签单金额')
        ->setCellValue('I1', '到账金额')
        ->setCellValue('J1', '直接成本')
        ->setCellValue('K1', '最终业绩')
        ->setCellValue('L1', '到账日期')
        ->setCellValue('M1', '付款方式')
        ->setCellValue('N1', '付款账号')
        ->setCellValue('O1', '签单渠道')
        ->setCellValue('P1', '服务日期')
        ->setCellValue('Q1', '收款账号')
        ->setCellValue('R1', '交易订单号')
        ->setCellValue('S1', '备注信息')
        ->setCellValue('T1', '录入时间')
        ->getStyle('A1:T1')->getFont()->getColor()->setARGB(PHPExcel_style_Color::COLOR_RED);

    $objPHPExcel->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getstyle('A1:T1')->getFont()->setBold(true);

    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(16);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(16);
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20);

    $key = 1;
    /*以下就是对处理Excel里的数据，横着取数据*/
    foreach($arr as $v){

        //设置循环从第二行开始
        $key++;
        $objPHPExcel->getActiveSheet()

            //Excel的第A列，name是你查出数组的键值字段，下面以此类推
            ->setCellValue('A'.$key, $v['job_type'])
            ->setCellValue('B'.$key, $v['reach_apart'])
            ->setCellValue('C'.$key, $v['reach_name'])
            ->setCellValue('D'.$key, "\t".$v['shop_id'])
            ->setCellValue('E'.$key, $v['shop_name'])
            ->setCellValue('F'.$key, $v['buy_serv'])
            ->setCellValue('G'.$key, $v['reach_type'])

            ->setCellValue('H'.$key, "\t".$v['reach_price'])
            ->setCellValue('I'.$key, "\t".$v['pay_price'])
            ->setCellValue('J'.$key, "\t".$v['pay_cost'])
            ->setCellValue('K'.$key, $v['pay_price'] - $v['pay_cost'])
            ->setCellValue('L'.$key, $v['reach_date'])
            ->setCellValue('M'.$key, $v['pay_methods'])
            ->setCellValue('N'.$key, "\t".$v['pay_id'])
            ->setCellValue('O'.$key, $v['reach_methods'])
            ->setCellValue('P'.$key, $v['time_limit'])
            ->setCellValue('Q'.$key, "\t".$v['rec_id'])
            ->setCellValue('R'.$key, "\t".$v['deal_id'])
            ->setCellValue('S'.$key, $v['else_desc'])
            ->setCellValue('T'.$key, $v['reg_date']);

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