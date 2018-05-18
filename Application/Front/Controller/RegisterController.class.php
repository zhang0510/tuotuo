<?php
namespace Front\Controller;

class RegisterController extends BaseController {
    //注册
    public function index(){
        //生成表单Token
        $token = rand_token();
        $source = I("get.source");
        $this -> assign('Session_From_Token',$token);
        $this -> assign('source',$source);
        //进入页面
    	$this->display("Register:register");
    }
    
    //验证码
    public function verify_c() {
        $Verify = new \Think\Verify ();
        $Verify->fontSize = 48;
        $Verify->length = 4;
        $Verify->useNoise = false;
        $Verify->entry ();
    }
    //验证码
    function check_verify($code, $id = ""){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    //发送短信验证码
    public function tel_SMS(){
        $verify = I('post.VCode');
        // 检查验证码
        $verify = remove_xss(I('VCode',''));
        if(!$this -> check_verify($verify)){
            //$this->error("亲，验证码输错了哦！",$this->site_url,1);
            $result['massion'] ='E1';
            $result['info'] ='亲，验证码输错了哦！';
            $this -> ajaxReturn($result);
        }
        $tel = remove_xss(I("tel"));
        $rand_num = mt_rand(1000, 9999);
        session("notecode",$rand_num);
        $mes = "亲爱的用户！您的验证码为：".$rand_num." 请您尽快填写！";
        $result['code'] = $rand_num;

        //$rets["returnstatus"]="Success";
        $rets = send_mobile_sms($tel,$mes);
        print_log("短信发送是否成功:".$mes);
        if($rets['status']==0){
        	$result['massion'] ='S';
        	//$result['info'] ='亲，验证码输错了哦！';
        }else{
        	$result['massion'] ='E2';
        	$result['info'] ='验证码发送失败';
        }
        print_log("SMS_MAS = ".$result['massion']);

        $this -> ajaxReturn($result);
    }
    
    //注册Action
    public function register(){
        $result['type'] = 0;
        $verify = I('post.VCode');
        if ($_POST){
            if(!from_token()){
                $result['info'] = "请勿重复提交！";
                $this -> ajaxReturn($result);
            }else{
                //验证码
               function check_verify($code, $id = ""){
                    $verify = new \Think\Verify();
                    return $verify->check($code, $id);
                }
                // 检查验证码
                $verify = remove_xss(I('VCode',''));
                if(!$this -> check_verify($verify)){
                    $result['info'] = "亲，验证码输错了哦！";
                    $this -> ajaxReturn($result);
                }
                //接受参数
                $userData['user_code']  =   get_code('TU');
                $userData['tel']        =   remove_xss(I("tel"));
                $userData['user_pwd']   =   md5(remove_xss(I("upwd")));
                $userData['addtime']    =   date('Y-m-d H:i:s',time());
                $userData['role']    =   "P";
                $smvcode = I("SM_VCode");

                //验证
                if($smvcode!=session('notecode')){
                    $result['info'] = "短信验证码错误！";
                    $this -> ajaxReturn($result);
                }
                session('notecode',null);
                
                if($userData['user_pwd']!=md5(remove_xss(I("upwd_two")))){
                    $result['info'] = "两次输入密码不同！";
                    $this -> ajaxReturn($result);
                }

                //判断用户来源
                $source  =   I("source");
                $sourceModel = M("user_source");
                $sourceArr = $sourceModel->where(array('source_code'=>$source))->find();
                if(!empty($sourceArr)){
                    $userData['user_source'] = $sourceArr['source_id'];
                }else{
                    $userData['user_source'] = '';
                }
                //初始化
                $rObj = D("Register");
                
                //查询手机号是否注册
                $tel_result = $rObj -> selectTel($userData['tel']);

                //判断手机号是否注册
                if($tel_result>0){
                    //已注册
                    $result['info'] = "该手机号码已注册！";
                    $this -> ajaxReturn($result);
                }else{
                    //开始注册
                    $tel_result = $rObj -> register($userData);
                    //判断注册是否成功
                    if ($tel_result){
                        //初始化Model
                        $lObj = D("Login");
                        //设置查询类型
                        $type="find";
                        //查询用户信息
                        $tel_Result = $lObj -> mobile_Select_User($userData['tel'],$type);
                        if($userData['user_source'] != ''){
                            //添加优惠券
                            $obj = D('Back/Favorable');
                            $obj -> addFav(array(
                                'fav_startime' => '',
                                'fav_endtime' => '',
                                'user_code' => $tel_Result['tel'],
                                'fav_left' => '1',
                                'user_name' => $tel_Result['user_name'],
                                'fav_price' => '100',
                            ));
                        }
                        //用户信息写入session
                        $_SESSION ['userData'] = des_encrypt_php(json_encode($tel_Result));
                        $result['type'] = 1;
                        $result['info'] = "注册成功！";
                        if(session('jump')!=""){
                            $result['loginJump'] = session('jump')['method'];
                        }else if(session('jumpz')!=""){
                            $result['loginJump'] = session('jumpz')['method'];
                        }else{
                            $result['loginJump'] = "";
                        }
                        $this -> ajaxReturn($result);
                    } else {
                        $result['info'] = "注册失败！";
                        $this -> ajaxReturn($result);
                    }
                }
            }
        }else{
			$result['info'] = "请传入参数！";
			$this -> ajaxReturn($result);
		}
        
    }
    
    function selTel($tel=""){
        $rObj = D("Register");
        //查询手机号是否注册
		if($tel==""){
			$tel=I("post.tel");
		}
        $tel_result = $rObj -> selectTel($tel);
        $this -> ajaxReturn($tel_result);
    }
}