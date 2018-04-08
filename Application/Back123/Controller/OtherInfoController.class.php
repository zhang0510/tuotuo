<?php
namespace Back\Controller;
class OtherInfoController extends BaseController {
   		
	function eventReturn(){
		$oiObj = D("OtherInfo");
		$ret = $oiObj->eventReturn();
		$this->assign("otherInfo",$ret);
		$this->display("OtherInfo:other_info_wx");
	}
	
	/**
	 * 
	 */
	function eventReturnAdd(){
		$id = I("id");
		$picurl = I("picurl");
		$des = I("des");
		$urlpath = I("urlpath");
		$title = I("title");
		$content=I("content");
		$data['picurl'] = $picurl;
		$data['des'] = $des;
		$data['urlpath'] = $urlpath;
		$data['title'] = $title;
		$data['content']=$content;
		$oiObj = D("OtherInfo");
		$ret = $oiObj->eventReturnAdd($id,$data);
		if($ret){
			$this->success("修改成功");
		}else{
			$this->ajaxReturn("未改变");
		}
		
	}
}