<?php


namespace App\Model;
//require_once __DIR__.'/../vendor/autoload.php';

use Hanson\Chinese\Chinese;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class test extends Model
{
    public function createNumber($arr){
        foreach ($arr as $key => $val) {
            foreach ($arr as $key => $val){
                $arr[$key]=intval($arr[$key]);
            }
            return $arr;
        }
    }
    public function testserach(){
        $users = DB::table('color_list')->get()->toArray();

        foreach ($users as $key => $val) {
            $val->{'cmyk'} =  $this->createNumber(explode(",", $val->{'cmyk'}));
            $val->{'rgb'} = $this->createNumber(explode(",", $val->{'rgb'}));
        }
        return $users;
    }
}
