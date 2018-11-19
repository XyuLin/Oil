<?php
/**
 * Created by PhpStorm.
 * User: L丶lin
 * Date: 2018/11/19
 * Time: 10:51
 */

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\ApplyRecord;

class Agent extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    // 申请代理
    public function applyAgent()
    {
        // 获取登录用户信息
        $user = $this->auth->getUser();
        // 获取参数
        $array = [
            'agent_id' => 'agent_id/s',
            'type'     => 'type/s',
            'voucher'  => 'voucher/s',
        ];
        $params = $this->buildParam($array);
        $model = new ApplyRecord();
        $result = $model->addApplyRecord($params['agent_id'],$user,$params['type'],$params['voucher']);
        if($result == false) {
            $this->error($model->getError());
        } else {
            $this->success('申请成功,等待后台审核!');
        }
    }
}