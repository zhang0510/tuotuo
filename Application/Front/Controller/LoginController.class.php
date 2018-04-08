<?php
namespace Front\Controller;

class LoginController extends BaseController {
    
    //PC登录
    public function pclogin(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'))['id'];
        if($session_User>0){
            $this->display('HomePage:home_page');
        }else{
            //进入页面
            $this->display("Login:pc_login");
        }
    }
    
    //手机动态登录
    public function mobilelogin(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'))['id'];
        if($session_User>0){
            $this->display('HomePage:home_page');
        }else{
            $this-> assign('Session_From_Token',$token);
            //进入页面
            $this->display("Login:mobile_login");
        }
    }
    
    //验证码
    public function verify_c() {
        $Verify = new \Think\Verify ();
        $Verify->fontSize = 48;
        $Verify->length = 4;
        $Verify->useNoise = false;
        $Verify->entry ();
    }
	
    //验证手机号
	function verifyPhone(){
	    //设置查询类型
	    $type="count";
	    //接收参数
		$tel=I("post.tel");
		//实体化登录
		$L_obj = D('Login');
		//查询手机号
		$flag = $L_obj -> mobile_Select_User($tel,$type);
		$this -> ajaxReturn($flag);
	}
	
	//验证验证码填写是否正确
	function verifyCode(){
		//验证码
		function check_verify($code, $id = ""){
			$verify = new \Think\Verify();
			return $verify->check($code, $id);
		}
		$vCode = remove_xss(I('VCode',''));
		if(!check_verify($vCode)){
		    $data=0;
		}else{
		    $data=1;
		}
		$this -> ajaxReturn($data);
	}
	
    //发送短信验证码
    public function tel_SMS(){
        $tel = remove_xss(I("tel"));
        $rand_num = mt_rand(1000, 9999);
        $mes = "亲爱的用户！您的验证码为：".$rand_num." 请您尽快填写！";
        $result['code'] = $rand_num;
		//print_log( "------短信发送------");
        $rets = send_mobile_sms($tel,$mes);
		
		//print_log( "短信发送获取返回值：".json_encode($rets));
        if($rets['status']==0){
        	$result['massion'] =true;
        }else{
        	$result['massion'] =false;
        }
        $this -> ajaxReturn($result);
    }
    
    //PC登录验证
    public function pc_Login_Verify(){
        $result['type'] = 0;
        //Post接收
        if ($_POST){              
                //接收参数
                $userData['tel']        =   remove_xss(I("tel"));
                $userData['user_pwd']   =   md5(remove_xss(I("user_pwd")));
                
                //初始化Model
                $lObj = D("Login");
                
                //设置查询类型
                $type="count";
                
                //查询用户是否存在
                $tel_Result = $lObj -> pc_Select_User($userData,$type);
                
                //查询结果判断
                if ($tel_Result<=0){
                    $result['info'] = "该手机号码未注册或登录密码不正确！";
                    $this -> ajaxReturn($result);
                }else{
                    //设置查询类型
                    $type="find";
                    
                    //查询用户信息
                    $tel_Result = $lObj -> pc_Select_User($userData,$type);
                    
                    //用户信息写入session
                    $_SESSION ['userData'] = des_encrypt_php(json_encode($tel_Result));
                    
                    //跳转页面  Index/homePage
                    $result['type'] = 1;
                    $result['info'] = "登录成功！";
                    //判断session 是否跳转
                    if(session('jumpz')!=""){
                        $result['loginJump'] = session('jumpz')['method'];
                    }else{
                        $result['loginJump'] = "null";
                    }
                    $this -> ajaxReturn($result);
                }
        }else{
			$result['info'] = "请传入参数！";
			$this -> ajaxReturn($result);
		}
    }
    
    //手机登录验证
    public function mobile_Login_Verify(){
        $result['type'] = 0;
        //Post接收
        if ($_POST){  
                //接收参数
                $tel        =   remove_xss(I("tel"));
                $SM_VCode   =   remove_xss(I("SM_VCode"));
                $SMS_VCode  =   remove_xss(I("SMS_VCode"));
                
                if($SM_VCode!=$SMS_VCode){
                    $result['info'] = "亲，动态验证码输错了哦！";
                    $this -> ajaxReturn($result);
                }
                //初始化Model
                $lObj = D("Login");
                
                //设置查询类型
                $type="count";
    
                //查询用户
                $tel_Result = $lObj -> mobile_Select_User($tel,$type);
    
                //查询结果判断
                if ($tel_Result<=0){
                    $result['info'] = "该手机号码未注册";
                    $this -> ajaxReturn($result);
                }else{
                    //设置查询类型
                    $type="find";
                    
                    //查询用户信息
                    $tel_Result = $lObj -> mobile_Select_User($tel,$type);
                    
                    //用户信息写入session
                    $_SESSION ['userData'] = des_encrypt_php(json_encode($tel_Result));
                    
                    //跳转页面  Index/homePage
                    $result['type'] = 1;
                    $result['info'] = "登录成功！";
                    //判断session 是否跳转
                    if(session('jumpz')!=""){
                        $result['loginJump'] = session('jumpz')['method'];
                    }else{
                        $result['loginJump'] = "null";
                    }
                    $this -> ajaxReturn($result);
                }
//            }
        }else{
			$result['info'] = "请传入参数！";
			$this -> ajaxReturn($result);
		}
    }
    
    //退出登录
    public function logout() {
        $_SESSION['userData'] = array ();
        session('jump',null);
        session('jumpz',null);
        session(null);
        $this -> ajaxReturn();
    }
}