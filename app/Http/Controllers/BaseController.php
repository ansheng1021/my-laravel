<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    function returnApi($data)
    {
        header('Content-type: application/json');
        $result = [
            "msg" =>  "请求成功",
            "code" => 200,
            "data" => $data || true
        ];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
}
