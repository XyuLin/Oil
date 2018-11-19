<?php

namespace app\admin\controller\apply;

use app\common\controller\Backend;

/**
 * 申请代理记录
 *
 * @icon fa fa-circle-o
 */
class Record extends Backend
{
    
    /**
     * Record模型对象
     * @var \app\admin\model\apply\Record
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\apply\Record;
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("typeList", $this->model->getTypeList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    // 操作。通过/否决
    public function operation()
    {
        $id = $this->request->param('ids');
        $type = $this->request->param('type');
        $info = $this->model->get($id);
        $info->status = $type;
        $info->save();

        if($type == '1') {
            $this->success('审核通过!');
        } else {
            $this->success('审核拒绝通过');
        }
    }
    

}
