<?php
namespace Front\Controller;
//use Think\Controller;
class PersonalController extends BaseController { 
    //个人信息  页面展示
    public function personalInfo(){
		$user=M("user");
		$linkMan=M("linkman");
		$userData=jiema(I("session.userData"));
		$userPhone=$userData['tel'];

		$user_code=$userData['user_code'];
		$map['user_code']=$user_code;
		$userInfo=$user->where($map)->find();
		if($userInfo['tel'] != ""){
			$userPhone=$userInfo['tel'];  //个人信息完善之后，电话号就是修改完之后的电话号
		}else{
			$userPhone=$userInfo['user_name'];   //第一次进来  默认读user_name  user_name  是电话号
		}
		$linkList=$linkMan->where($map)->select();
		$this->assign("userInfo",$userInfo);
		$this->assign("linkList",$linkList);
		$this->assign("userPhone",$userPhone);
        $this->display("PersonalInformation:personal_information");
    }
	/*
	*常用联系人列表
	*/
	public function linkMan(){
		$linkMan=M("linkman");
		$userData=jiema(I("session.userData"));
		$userPhone=$userData['tel'];
		$user_code=$userData['user_code'];
		$map['user_code']=$user_code;
		$linkList=$linkMan->where($map)->select();
		$this->assign("linkList",$linkList);
		$this->display("PersonalInformation:linkman");
	}
	/* 完善个人信息 执行 */
	function addMan(){
		//var_dump($_POST);
		//EXIT;
		$userData=jiema(I("session.userData"));
		$user_code=$userData['user_code'];
		$map['user_code']=array("eq",$user_code);
		$user=M("user");
		$phone=I("post.tel");
		$sex=I("post.sex");
		$email=I("post.email");
		$num=I("post.num");
		$name=I("post.name");
		$data['user_name']=$name;
		$data['tel']=$phone;
		$data['email']=$email;
		$data['sex']=$sex;
		$data['identity']=$num;
		$res=$user->where($map)->save($data);
		if($res){
			//$this -> success('添加成功',U('Personal/personalInfo'));
			$datas="修改成功";
			$this->ajaxReturn($datas);
		}else{
			//$this -> error('添加失败',U('Personal/personalInfo'));
			$datas="修改失败";
			$this->ajaxReturn($datas);
		}
	}
	
	//添加常用发车人
	function linkAdd(){
		$linkMan=M("linkman");
		$userData=jiema(I("session.userData"));
		$link_name=I("post.username");
		$link_tel=I("post.tel");
		$link_num=I("post.idNum");
		$link_code=get_code("tuo");
		$data['link_tel']=$link_tel;
		$data['link_name']=$link_name;
		$data['link_num']=$link_num;
		$data['user_code']=$userData['user_code'];
		$data['link_code']=$link_code;
		$result=$linkMan->add($data);
		if($result){
			$datas="成功";
			$this->ajaxReturn($datas);
		}else{
			$datas="失败";
			$this->ajaxReturn($datas);
		}
	}
	
	//删除常用发车人
	function delLink(){
		$linkMan=M("linkman");
		$code=I("code");
		$map['link_code']=array("in",$code);
		$res=$linkMan->where($map)->delete();
		if($res){
			$datas="成功";
			$this->ajaxReturn($datas);
		}else{
			$datas="失败";
			$this->ajaxReturn($datas);
		}
		
	}
	


}