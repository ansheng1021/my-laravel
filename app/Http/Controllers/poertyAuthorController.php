<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Model\poertyAuthor;


class poertyAuthorController extends Controller
{
    function poerty(){
//        $testmodel = new poertyAuthor();
//        $str = $testmodel->getFile()['file'];
//        $data= array();
//        foreach ($str as $key => $val){
//            $dir_name=$testmodel->get_fileName($val);
////            var_dump(explode('.',$dir_name)[0]);
//            $arr = $testmodel->isOneType($dir_name, $val);
//        }
        $paragraphs = [
            "柱史有名跡，清才自天縱。",
            "構思慶雲合，落筆醴泉湧。",
            "歌詩與文賦，錚錚人口諷。",
            "揚袂入澤宮，鵠心一箭中。",
            "恃才善戲謔，負氣好侮弄。",
            "大志有誰知，細行乖自訟。",
            "小諫事世宗，惕惕佩光寵。",
            "太祖方歷試，握兵權已重。",
            "上書范魯公，先見不能用。",
            "曆數不在周，謳謠卒歸宋。",
            "汗漫失屠龍，接輿遂歌鳳。",
            "行荷伯倫鍤，高卧畢卓甕。",
            "神德不爲嫌，優待臺諫俸。",
            "晚求萬泉令，吏隠官資冗。",
            "一旦隨朝露，識者彌哀痛。",
            "無子嗣家聲，身世若一夢。",
            "文編多散失，人口時傳誦。",
            "空持一器酒，何處澆孤冢。"
        ];
//        dd(implode($paragraphs, ','));
        $str = implode($paragraphs, ',');
        $data = explode(',',$str);
        dd($data);
        return 'hello';

    }
}
