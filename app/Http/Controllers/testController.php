<?php


namespace App\Http\Controllers;




use App\Model\test;

class testController extends Controller{
    public function index(){
        $testmodel = new test();
        $data = $testmodel->testserach();
        return $this->createRes(200,$data,'success');
    }
}
