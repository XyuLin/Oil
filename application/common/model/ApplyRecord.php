<?php
/**
 * Created by PhpStorm.
 * User: L丶lin
 * Date: 2018/11/19
 * Time: 11:05
 */

namespace app\common\model;


use think\Model;

class ApplyRecord extends Model
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $_error = '';
    // 定义字段类型
    protected $type = [
    ];
    public $typeArray = ['1'=>'凭证申请','2'=>'缴费申请','3'=>'卷申请'];
    public $statusArray = ['0'=>'待处理','1'=>'通过','2'=>'拒绝'];

    // 添加申请记录
    public function addApplyRecord($agent_id,$user,$type,$voucher)
    {
        // 验证agenet_id 是否真实有效
        if($agent_id && !$agent = Agent::getAgentDetail($agent_id)) {
            $this->setError('agent_id - 参数错误!');
            return false;
        }
        // 判断用户等级是否与申请等级相同 为错误请求
        if($user->level >= $agent->level) {
            $this->setError('只允许申请比自身高级的代理!');
            return false;
        }
        // 并且用户不可以正在申请
        $isApply = $this->where('user_id',$user->id)->where('status','0')->find();
        if($isApply) {
            $this->setError('您已经在申请代理,请等待后台审核后,在进行申请!');
            return false;
        }
        // 验证type是否符合规则
        if($type && !isset($this->typeArray[$type])) {
            $this->setError('type - 参数错误!');
            return false;
        }
        $params = [
            'agent_id'          => $agent_id,
            'agent_name'        => $agent->data['name'],
            'user_id'           => $user->id,
            'type'              => $type,
            'voucher'           => $voucher,
            'status'            => '0',
        ];

        $record = $this->create($params);
        return $record;
    }


    /**
     * 设置错误信息
     *
     * @param $error 错误信息
     * @return ApplyRecord
     */
    public function setError($error)
    {
        $this->_error = $error;
        return $this;
    }

    /**
     * 获取错误信息
     * @return string
     */
    public function getError()
    {
        return $this->_error ? __($this->_error) : '';
    }
}