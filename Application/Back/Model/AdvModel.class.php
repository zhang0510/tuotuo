<?php
namespace Back\Model;
use Think\Model;
class AdvModel extends Model{
	/*
	 * 获取所有广告
	 */
	public function getInfo(){
		$info = $this->select();
		return $info;
	}
	
}