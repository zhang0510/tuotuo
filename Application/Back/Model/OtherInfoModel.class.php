<?php
namespace Back\Model;
class OtherInfoModel extends BaseModel{
	/**
	 * 查询自动回复内容
	 */
	function eventReturn(){
		$oiObj = M("other_info");
		$ret = $oiObj->find();
		return $ret;
	}
	/**
	 * 内容修改
	 */
	function eventReturnAdd($id="",$data=null){
		$oiObj = M("other_info");
		$map['id'] = array("eq",$id);
		$ret = $oiObj->where($map)->save($data);
		if($ret){
			return true;
		}else{
			return false;
		}
	}
}