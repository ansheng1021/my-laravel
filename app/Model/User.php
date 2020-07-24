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
    protected $connection = 'mysql';   //连接名

    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'user';          //表名

    public $timestamps = false;         //是否依据laravel的标准保存时间  laravel中封装了方法 数据库中对应字段 created_at（创建时间）  updated_at（更新时间）
                                          //可以不写  如果为true laravel将在更新和插入操作时自动填充created_at updated_at字段 无需赋值
    //默认填充
    protected $fillable = ['username', 'phone'];      //可以不写   在进行IO操作时 可以通过$model->fill($request->all())将此数组中定义的字段填充至模型 不需要一一赋值

    protected $hidden = ['created_at', 'updated_at'];   //可以不写  在查询时默认将数组中字段剔除

}