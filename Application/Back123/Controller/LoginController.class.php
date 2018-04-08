<?php

namespace Back\Controller;

use Think\Controller;

class LoginController extends Controller {
	// 列表页
	public function verify_c() {
		$Verify = new \Think\Verify ();
		$Verify->fontSize = 48;
		$Verify->length = 4;
		$Verify->useNoise = false;
		$Verify->entry ();
	}
	public function index() {
		$mas = jiema(session('master'));
		if (!empty($mas)){
			$this->redirect('Index/index');
		} else {
			$this->display ();
		}
	}
	public function doLogin() {
		function check_verify($code, $id = ""){
			$verify = new \Think\Verify();
			return $verify->check($code, $id);
		}
		// 检查验证码
		$verify = I('param.verify','');
		if(!check_verify($verify)){
			$this->error("亲，验证码输错了哦！",$this->site_url,1);
		}
		$map['admin_pwd']= substr(md5(I('password')),3,7);
		$map['admin_acc']=I('username');
		$map['admin_flag'] = array('eq',Y);
		$master = M ('Admin');
		$res = $master->where ( $map )->find ();
		if ($res) {
			$_SESSION ['master'] = des_encrypt_php(json_encode($res));
			$_SESSION ['time'] = time();
			$this->success("登陆成功",U("Orderyjh/orderList"));
		} else {
			$this->error ( "登陆失败" ,U("Login/index"));
		}
	}
	public function logout() {
		$_SESSION['master'] = array ();
		$this->success ( "退出成功！", U("Login/index"));
	}
}