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
use Illuminate\Support\Facades\Cache;

define("BAIDU_TOKEN_URL", "https://aip.baidubce.com/oauth/2.0/token");

class UserController extends BaseController
{
    public function display(){
        return view("upload");
    }
    /**
     * 查询User表数据
     */
    public function queryAllUser(Request $request)
    {
        $id = $request->input("id");
        if (isset($id)) {    //是否传了id
            //查询单条数据
            $result = User::find($id);  //两种方式查询 一种为 new User  然后用实例化的对象就行查询
                                        //第二种则是直接调用model  如User的model 为 User  则可以直接通过 User::这种方法调用model中的方法
                                        //find()方法为内置方法 查询id为 x 的单挑数据
        } else {
            //查询所有数据
            $result = User::all();   //all为查询此表中所有的数据
        }
        return $this->returnApi($result);
    }

    /**
     * 向User表添加数据
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $userModel = new User();       //内置保存方法  实例化模型 为模型填充数据  save()向数据库插入数据
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
        $userInfo = User::find($params['id']);     //内置保存方法  实例化模型 为模型填充数据  update()向数据库更新数据
        if ($userInfo) {
            $userInfo->update($params);
            $this->returnApi(true);
        } else {
            $this->returnFail('用户ID不存在', false);
        }
    }

    /**
     * 删除User表数据
     */
    public function destory(Request $request)
    {
        $id = $request->input("id");        //删除指定id
        if (User::destroy($id)) {
            return $this->returnApi(true);
        } else {
            return $this->returnFail("用户ID不存在", false);
        }
    }

    public function queryCarNumber(Request $request)
    {
        $file = $request->input('file');
        $upload_done = $this->getBendi_base64_image_content($file,public_path()."/static/bendi/");
        $token = $this->getAccessToken()['access_token'];
        $url = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/body_seg?access_token=' . $token;
        $img = file_get_contents($upload_done);
        $img = base64_encode($img);
        $bodys = array(
            'image' => $img,
        );
        $res = $this->request_post($url,$bodys);
        $res = json_decode($res,true);
        $baseurl = $res['foreground'];
        $is_download = $this->base64_image_content("data:image/png;base64,".$baseurl,public_path()."/static/draw/");
        $resultArr = explode("/",$is_download);
        if($is_download){
            $href = "http://test.lzjrys.store/static/draw/".date("Ymd",time())."/".end($resultArr);
            return $this->returnApi($href);
        }else{
            echo "失败";
        }
    }
    /**
     * [将Base64图片转换为本地图片并保存]
     * @param  [Base64] $base64_image_content [要保存的Base64]
     * @param  [目录] $path [要保存的路径]
     */
    function base64_image_content($base64_image_content,$path){
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
            $new_file = $path."/".date('Ymd',time())."/";
            if(!file_exists($new_file)){
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0777);
            }
            $new_file = $new_file.time().".{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
                return '/'.$new_file;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    function getBendi_base64_image_content($base64_image_content,$path){
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
            $new_file = $path."/".date('Ymd',time())."/";
            if(!file_exists($new_file)){
                //检查是否有该文件夹，如果没有就创建，并给予最高权限
                mkdir($new_file, 0777);
            }
            $new_file = $new_file.time().".{$type}";
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))){
                return $new_file;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function getAccessToken()
    {
//        $res = Cache::remember('baiduAi_token', env("DEFAULT_CACHE_TIME"), function () {
            $postData = array(
                "grant_type" => 'client_credentials',
                "client_id" => BAIDU_KEY,
                "client_secret" => BAIDU_SECRET
            );
            $o = "";
            foreach ($postData as $k => $v) {
                $o .= "$k=" . urlencode($v) . "&";
            }
            $post_data = substr($o, 0, -1);
            $res = $this->_request(BAIDU_TOKEN_URL, true, 'POST', $post_data);
            return json_decode($res,true);
//        });
//        return $res;
    }
}
