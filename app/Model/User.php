<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/17
 * Time: 17:05
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
    protected $fillable = ['username','phone'];
}