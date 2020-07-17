<?php
/**
 * Created by Lizijie.
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
    /**
     * 查询User表数据
     */
    public function queryAllUser(Request $request)
    {
        $id = $request->input("id");
        if(isset($id)){
            //查询单条数据
            $result = User::find($id);
        }else{
            //查询所有数据
            $result = User::all();
        }
        return $this->returnApi($result);
    }

    /**
     * 向User表添加数据
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $userModel = new User();
        $userModel->fill($params);
        if ($userModel->save()) {
            return $this->returnApi($userModel->id);
        }
    }

    /**
     * 更新User表数据
     */
    public function update(Request $request)
    {
        $params = $request->all();
        $userInfo = User::find($params['id']);
        if($userInfo){
            $userInfo->update($params);
            $this->returnApi(true);
        }else{
            $this->returnFail('用户ID不存在',false);
        }
    }

    /**
     * 删除User表数据
     */
    public function destory(Request $request)
    {
        $id = $request->input("id");
        if (User::destroy($id)) {
            return $this->returnApi(true);
        }else{
            return $this->returnFail("用户ID不存在",false);
        }
    }
}