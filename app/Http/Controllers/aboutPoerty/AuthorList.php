<?php


namespace App\Http\Controllers\aboutPoerty;


use App\Http\Controllers\BaseController;
use App\Model\poertycon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorList extends BaseController    //继承BaseController就行  Base已经继承了Controller
{
    public function getAuthorList(Request $request)
    {
//       $n = $request->input('n');
//       $author = new allAuthor();
//       $data = $author->getauthor($p,$n);
//       return $this->createRes('200',$data,'success');

        $limit = $request->input("limit", 10);
        $page = $request->input("page", 1);
        $result = DB::table("author_list")     //model中只封装一些公共的方法就可以 基本的业务放在控制器中完成
            ->limit($limit)                            //一个model对应一张表 命名用驼峰 首字母大写
            ->offset($page * $limit)            //model中的内容见User.php
            ->get();
        return $this->returnApi($result);
    }
    public function getRandomPoerty(Request $request){
        $word = $request->input("word");
        if(strpos($word,',')){
            $word = explode(",",$word);
            $word = $word[array_rand($word,1)];
        }
        $result = poertycon::where("paragraphs",'like','%'.$word.'%')->inRandomOrder()->first();
        $result->keyword = $word;
        return $this->returnApi($result);
    }
}
