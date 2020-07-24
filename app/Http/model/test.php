<?php


namespace App\Http\model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class test extends Model
{
    public function  testserach(){
        $users = DB::table('color_list')->get()->toArray();
        return $users;
    }
}
