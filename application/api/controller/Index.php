<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\News;
use app\common\model\Notice;

/**
 * 首页接口
 */
class Index extends Api
{

    protected $noNeedLogin = ['smsSend'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     * 
     */
    public function index()
    {
        $page = $this->request->request('page');
        if(empty($page)) {
            $page = '1';
        }
        $data['notice'] = Notice::getNoticeList();
        $data['news'] = News::getNewsList($page);

        $this->success('请求成功',$data);
    }

}
