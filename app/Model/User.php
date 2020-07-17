<?php
/**
 * Created by Lizijie.
 * User: Administrator
 * Date: 2020/7/17
 * Time: 16:50
 */

namespace App\Model;

use App\Model\BaseModel;

class User extends BaseModel
{
    /**
     * 此模型的连接名称。
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'user';

    public $timestamps = false;

    //默认填充
    protected $fillable = ['username', 'phone'];

    protected $hidden = ['created_at', 'updated_at'];

}