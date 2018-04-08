<?php
namespace Back\Controller;
class LogController extends BaseController{
    /**
     * 日志展示
     * @date: 2016-9-27 上午10:00:41
     * @author: liuxin
     */
    public function logList(){
        $start = I('start');
        $end = I('end');
        $search = I('search');
        $data = D('Log') -> getLogList($start,$end,$search);
        $this -> assign('start',$start);
        $this -> assign('end',$end);
        $this -> assign('search',$search);
        $this -> assign('list',$data['list']);
        $this -> assign('num',$data['num']);
        $this -> assign('show',$data['show']);
        $this -> display('Log:log_list');
    }
}