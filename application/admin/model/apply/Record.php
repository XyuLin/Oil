<?php

namespace app\admin\model\apply;

use think\Model;

class Record extends Model
{
    // 表名
    protected $name = 'apply_record';

    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';

    // 追加属性
    protected $append = [
        'status_text',
        'type_text',
        'user_text',
        'user_phone_text',
    ];

    public function User()
    {
        return $this->belongsTo('app\admin\model\User');
    }


    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1'), '2' => __('Status 2')];
    }

    public function getTypeList()
    {
        return ['1' => __('Type 1'), '2' => __('Type 2'), '3' => __('Type 3')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getUserTextAttr($value, $data)
    {
        if ($this->User != null) {
            return $this->User->nickname;
        } else {
            return '账户已注销';
        }
    }

    public function getUserPhoneTextAttr($value, $data)
    {
        if ($this->User != null) {
            return $this->User->mobile;
        } else {
            return '账户已注销';
        }
    }




}
