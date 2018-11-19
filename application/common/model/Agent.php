<?php
/**
 * Created by PhpStorm.
 * User: L丶lin
 * Date: 2018/11/19
 * Time: 10:57
 */

namespace app\common\model;


use think\Model;

class Agent extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 定义字段类型
    protected $type = [
    ];

    // 获取代理详细资料
    public static function getAgentDetail($id)
    {
        $info = self::get($id);
        if($info == null) {
            return false;
        } else {
            return $info;
        }
    }

}