<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function createRes($status= '200',$data=[],$msg='success'){
        $data =[
            'status' => $status,
            'msg'=> $msg,
            'data'=>$data
        ];
        return json_encode($data);
    }
    public function readJson($file=''){

    }

}
