<?php
/**
 * Created by PhpStorm.
 * User: L丶lin
 * Date: 2018/11/15
 * Time: 21:12
 */

namespace app\common\model;


use think\Model;

class News extends Model
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
     * 获取新闻列表
     */
    public static function getNewsList($page = '1')
    {
        $list = self::limit('10',$page)->order('id desc')->select();
        return $list;
    }
}