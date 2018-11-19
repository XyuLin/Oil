<?php
/**
 * Created by PhpStorm.
 * User: L丶lin
 * Date: 2018/11/15
 * Time: 21:15
 */

namespace app\common\model;


use think\Model;

class Notice extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
    ];

    /*
     * 获取最新公告
     */
    public static function getNoticeList()
    {
        $list = self::where('type','1')->select();

        return $list;
    }
}