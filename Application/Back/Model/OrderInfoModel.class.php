<?php
namespace Back\Model;
use Think\Model\RelationModel;
class OrderInfoModel extends RelationModel{
   
	public function getOrderFee(){
	    $map['pay_status'] = array('eq','Y');
	    $nu = $num = $this -> where($map) -> count();
	    $num = $this -> where($map) -> limit($nu) -> sum('order_info_zj');
	    return $num;
	}
	
	/*
	 * 搜索订单详情里面的信息
	 */
	function getInfo($map){
		$a = $this->where($map)->select();
		return $this->where($map)->select();
	}
}
