<?php
namespace Back\Model;
use Think\Model\RelationModel;
class CwglModel extends RelationModel{
	/*
	 * 求财务总金额
	 * @param liuxin
	 * return int
	 */
    public function getCwglNum(){
        $nu = $this -> count();
        $num = $this -> limit($nu) -> sum('cwgl_price');
        return $num;
    }
    
    
    /*
     * 根据订单号查询财务管理是否存在
     */
    public function queryOrder($order_code){
    	$where['order_code'] = array('eq',$order_code);
    	$data = $this->where($where)->find();
    	return $data;
    }
    
    public function getTotalPrem(){
        $nu = $this -> count();
        $num = $this -> limit($nu) -> sum('cwgl_bxf');
        return $num;
    }
}