<?php


namespace App\Model;


use Hanson\Chinese\Chinese;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class poertyAuthor extends Model
{
    protected $connection = 'mysql';

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'author_list';

    public $timestamps = false;

    function get_fileName($file_path){
        //1、先获取带文件部分
        $file_base_name = basename($file_path);
        //2、查找截取即可
        $f_name = substr($file_base_name,0,strrpos($file_base_name,'.'));
        return $f_name;
    }
    public function getZhSTR($text){
        return Chinese::simplified($text);
    }
    //判断是古诗还是作者判断朝代
    public function isOneType($str,$path){
        $result = array();
        $result['data']=json_decode(file_get_contents($path),true);
        if(explode('.',$str)[0]==='authors'){
            if(explode('.',$str)[1]==='tang'){
                $result['dynasty']='唐';
            }else{
                $result['dynasty']='宋';
            }
            $this->addAuthors($result,1);
        }else{
            if(explode('.',$str)[1]==='tang'){
                $result['dynasty']='唐';
            }else{
                $result['dynasty']='宋';
            }
            $this->addAuthors($result,2);
        }
        return $result;
    }

    // 读取publc/json下所有文件
    public function getFile() {
        $files = array();
        $str =dirname(dirname(dirname(__FILE__))).'/public/static/json';
        $dh=opendir($str);
        if(is_dir($str)){
            if($dh=opendir($str)){
                while(false !== ($file = readdir($dh))){
                    if($file != "." && $file != ".."){
                        $file_a = ($str."/".$file);
                        if(is_dir($file_a)){
                            // echo $file_a. '<br>';
                            $files['dir'][$file_a] = $this->getFile($file_a);
                        }else{
                            if(is_file($file_a)){
                                // echo $file_a. '<br>';
                                $files["file"][] =  $file_a;
                            }
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $files;
    }
    // 插入数据库
    public function addAuthors($data,$type){
        if($type == 1){
            foreach ($data['data'] as $key=>$val){
                $exits = poertyAuthor::find($val['id']);
                if(!$exits){
                    try{
                        $res = DB::table('author_list')->insert([
                            'name'=> $this->getZhSTR($val['name']),
                            'id'=> $val['id'],
                            'desc'=> $this->getZhSTR($val['desc']),
                            'dynasty'=> $this->getZhSTR($data['dynasty'])
                        ]);
                        echo "作者：插入成功  第" .$key."条\n";
                        sleep(0.4);
                    }catch (\Exception $e){
                       echo "作者：插入失败  第" .$key."条\n";
                        continue;
                    }
                }else{
                    echo "作者：数据已存在  第" .$key."条\n";
                    sleep(0.4);
                }
            }
        }else{
            foreach ($data['data'] as $key => $val) {
                $exits = poertycon::find($val['id']);
                if (!$exits) {
                    try {
                        $res = DB::table('poet_list')->insert([
                            'author' => $this->getZhSTR($val['author']),
                            'id' => $val['id'],
                            'paragraphs' => $this->getZhSTR(implode($val['paragraphs'], ',')),
                            'title' => $this->getZhSTR($val['title']),
                            'dynasty' => $this->getZhSTR($data['dynasty'])
                        ]);
                        echo "古诗：插入成功  第" .$key."条\n";
                        sleep(0.4);
                    } catch (\Exception $e) {
//                       echo "插入失败\n";
                        echo "古诗：插入失败  第" .$key."条\n";
                        continue;
                    }
                } else {
                    echo "古诗：数据已存在  第" .$key."条\n";
                    sleep(0.4);
                }
            }
        }

    }
}
