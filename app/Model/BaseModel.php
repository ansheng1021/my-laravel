<?php
/**
 * Created by Lizijie.
 * User: Administrator
 * Date: 2020/7/17
 * Time: 16:50
 */
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
class BaseModel extends Model{
    public function scopeWithCertain($query, $relation, Array $columns)
    {
        return $query->with([$relation => function ($query) use ($columns){
            $query->select(array_merge(['id'], $columns));
        }]);
    }
}