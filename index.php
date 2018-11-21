<?php
include './vendor/autoload.php';

//环境监测
//var_dump(PHP_VERSION_ID);
//var_dump(extension_loaded('zip'));
//var_dump(extension_loaded('xml'));
//var_dump(extension_loaded('gd'));

//生成一个基本的EXCEL
use PhpOffice\PhpSpreadsheet\Spreadsheet; //初始化
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; //用于保存
use PhpOffice\PhpSpreadsheet\IOFactory; //读写操作

$inputFillName = 'test.xlsx';
$spreadsheet = IOFactory::load($inputFillName); //从工作簿文件中加载PHPExcel工作簿对象
$sheetData = $spreadsheet->getActiveSheet()->toArray(); //把工作表中的数据转换成数组
echo "<pre>";
print_r($sheetData);



$spreadsheet = new Spreadsheet();
$spreadsheet->setActiveSheetIndex(0); //设置当前活动状态工作表的索引
$sheet = $spreadsheet->getActiveSheet(); //初始化sheet对象,获得当前活动状态的工作表
$sheet->setCellValue('A1','编号') //设置单元格的值
      ->setCellValue('B1','用户名')
      ->setCellValue('C1','昵称')
      ->setCellValue('D1','年龄');
$data = [
  [
      'id' => 10086,
    'username' => 'dick',
    'nickname' => 'google',
    'age' => 18
  ],
    [
        'id' => 10086,
        'username' => 'dick',
        'nickname' => 'google',
        'age' => 18
    ]
];

$sheet->fromArray($data,null,'A2');//从数组中获得数据填充到工作表

$writer = new Xlsx($spreadsheet);
$writer->save('test.xlsx'); //将工作簿对象中的数据保存到一个工作簿文件中
