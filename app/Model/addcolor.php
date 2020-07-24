<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class addcolor extends Model
{
   function addcolorList($arr){
       $data = json_decode($arr,true);
       foreach ($data as $key => $val) {
           $data[$key]['CMYK'] = implode($val['CMYK'],',');
           $data[$key]['RGB'] = implode($val['RGB'],',');
       }
       $result  = DB::table('color_list')->insert($data);
       return $result;
   }
}
