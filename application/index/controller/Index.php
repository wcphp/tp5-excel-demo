<?php
namespace app\index\controller;

//use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use think\Db;

class Index
{
    public function index()
    {
        //写
//        $spreadsheet = new Spreadsheet();
//        $sheet = $spreadsheet->getActiveSheet();
//        $sheet->setCellValue('A1', 'Welcome to Helloweba.');
//
//        $writer = new Xlsx($spreadsheet);
//        dump($writer->save('hello.xlsx'));





    }
    /**
     * 首字母
     * @return
     * @throws \Exception
     */
    public function firstZM()
    {
        $inputFileName = './data/jian.xls';
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $arr = [];
        foreach($sheetData as $item){

         if(!isset($arr[$item['A']])){
                $arr[$item['A']] =  $item['B'];
            }
        }

        $inputFileName1 = './data/fan.xls';
        $spreadsheet1 = IOFactory::load($inputFileName1);
        $sheetData1 = $spreadsheet1->getActiveSheet()->toArray(null, true, true, true);

        foreach($sheetData1 as $item){

            if(!isset($arr[$item['A']])){
                $arr[$item['A']] =  $item['B'];
            }
        }
        echo json_encode($arr,JSON_UNESCAPED_UNICODE);

    }

    /**
     * 行业
     * @return
     * @throws \Exception
     */
    public function hangye()
    {
        $inputFileName = './data/hangye.xlsx';
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $id = 1;
        $pid = 0;
        foreach($sheetData as $item){
            if(!empty($item['A'])){
                Db::name('industry')->insert(['id'=>$id,'pid'=>0,'name'=>$item['A']]);
                $pid = $id;
                $id++;
            }
            if(!empty($item['B']) && trim($item['B']) !='其他'){
                Db::name('industry')->insert(['id'=>$id,'pid'=>$pid,'name'=>$item['B']]);
                $id++;
            }

        }

    }







}
