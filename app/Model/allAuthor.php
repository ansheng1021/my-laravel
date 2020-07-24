<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class allAuthor extends Model
{
    function getauthor($p=0,$n=0){
        $start = $p * $n;
        $end = ($p * $n) + $n;
        $str = "select * from author_list limit $start,$end";
        $result = DB::select($str);
        return $result;
    }
}
