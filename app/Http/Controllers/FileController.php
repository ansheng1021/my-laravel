<?php


namespace App\Http\Controllers;

use App\Model\addcolor;
use App\Model\test;
class FileController extends Controller
{
   function browse($file_name){
       $list = new test();
       $listData = $list->testserach();
       if($listData){
           return $this->createRes();
       }
       $file = file_get_contents(storage_path($file_name));
       $addcolorModel = new addcolor();
       $addItem = $addcolorModel->addcolorList($file);
       if($addItem){
           $data = $this->createRes();
       }else{
           $data = $this->createRes(600,[],'fail');
       }

       return $data;

   }
}
