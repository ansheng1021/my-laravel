<?php
/**
 * Created by Lizijie.
 * User: Administrator
 * Date: 2020/7/17
 * Time: 16:50
 */
namespace App\Http\Controllers;

class BaseController extends Controller
{
    function returnApi($data)
    {
        header('Content-type: application/json');
        $result = [
            "msg" =>  "请求成功",
            "code" => 200,
            "data" => $data
        ];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    function returnFail($msg,$data)
    {
        header('Content-type: application/json');
        $result = [
            "msg" =>  $msg,
            "code" => 500,
            "data" => $data
        ];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}
