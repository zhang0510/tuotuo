<?php
namespace Back\Model;
class CarOrderModel extends BaseModel{
	/*
	 * 根据order_code查询是否存在
	 */
	public function queryOrder($order_code){
		$where['order_code'] = array('eq',$order_code);
		$data = $this->where($where)->find();
		return $data;
	}
}