<?php
namespace Back\Model;
class LogModel extends BaseModel{
    public function getLogList($start='',$end='',$search=''){
        $search == '' ? '' : $map['log_content'] = array('like','%'.$search.'%');
        if(($start&&$end)&&($start<$end)){
            $map['log_time'] = array('lt',$end);
            $map['log_time'] = array('egt',$start);
            $par['start'] = $start;
            $par['end'] = $end;
            if($search){
	            $par['search'] = $search;
            }
        }
        $data['num'] = M('log') -> where($map) -> count();
        $data['page'] = set_page($data['num'],'10');
        $objList = M('log') -> where($map) -> limit($data['page']->limit) -> order('log_time desc') -> select();
        $count = count($objList);
        $data['list'] = $objList;
        $data['show'] = $data['page']-> BackPage();
        return $data;
    }
    
    public function getLogs($code){
        $map['order_code'] = array('eq',$code);
        $objList = M('log') -> where($map) ->order('log_time desc') -> select();
        return $objList;
    }
    
}