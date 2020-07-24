<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class poertycon extends Model
{
    protected $connection = 'mysql';

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'poet_list';

    public $timestamps = false;

    // 插入数据库
    public function addpoets($data)
    {

    }
}
