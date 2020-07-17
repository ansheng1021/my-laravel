<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/17
 * Time: 16:50
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Model\User;
use Illuminate\Http\Request;
class UserController extends BaseController
{
    public function index()
    {
        echo 1;
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $userModel = new User();
        $userModel->fill($params);
        if($userModel->save()){
            return $this->returnApi($userModel->id);
        }
    }
}