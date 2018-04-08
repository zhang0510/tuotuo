<?php
namespace Front\Model;
class LoginModel extends BaseModel{
    //查找用户-PC方式
    function pc_Select_User($userInfo,$type){
        $sel = M("user");
        if($type=="count"){
        	$registerSel=0;
        }else{
        	$registerSel=null;
        }
        if($userInfo !=''){
            $map['tel']     = array('eq',$userInfo['tel']);
            $map['user_pwd']= array('eq',$userInfo['user_pwd']);
	        //判断类型 count-查询是否存在 find-读取信息
	        if($type=="count"){
	            $registerSel = $sel->where($map)->count();
	        }else if($type=="find"){
	            $registerSel = $sel->where($map)->find();
	        }
        }
        return $registerSel;
    }
    
    //查找用户-手机号方式
    function mobile_Select_User($tel,$type){
        $sel = M("user");
        if($type=="count"){
        	$registerSel=0;
        }else{
        	$registerSel=null;
        }
        if($tel !=''){
            $map['tel']     = array('eq',$tel);
	        if($type=="count"){
	            $registerSel = $sel->where($map)->count();
	        }else if($type=="find"){
	            $registerSel = $sel->where($map)->find();
	        }
        }
		print_log("查询手机号:".json_encode($registerSel));
        return $registerSel;
    }
}