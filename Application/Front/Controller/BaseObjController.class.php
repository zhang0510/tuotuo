<?php
namespace Front\Controller;
use Think\Controller;
class BaseObjController extends Controller {
    
    public function _initialize(){
//     	$this->checkUserSession();
// 		$this->smstime();
// 		$arr = $this->footer();
// 		$this->assign("arr",$arr);
//     	$accs = json_decode(des_decrypt_php(session('user')),true);
//     	$this->assign("user",$accs);
        //取session判断其是否登录
		$art=M("article");
        /*  妥妥*/
        $map2['article_pid']="GY";
        $tuoList=$art->where($map2)->select();
        //dump($tuoList);
     
        /*  服务 */
        $map3['article_pid']="LX";
        $serviceList=$art->where($map3)->select();
        /*  帮助 */
        $map4['article_pid']="JR";
        $helpList=$art->where($map4)->select();
        /*  配送 */
        $map5['article_pid']="QQ";
        $patchList=$art->where($map5)->select();
        /*  支付 */
        $map6['article_pid']="FK";
        $payList=$art->where($map6)->select();
        /*  关于 */
        $map7['article_pid']="BZ";
        $aboutList=$art->where($map7)->select();
        /* 妥妥服务 */
        $map8['article_pid']="FW";
        $ttfw=$art->where($map8)->select();
        /* 安全保障 */
        $map9['article_pid']="AQ";
        $aq=$art->where($map9)->select();
        /* 导航关于妥妥 */
        $map10['article_pid']="DH";
        $dh=$art->where($map10)->select();
        
        $this->assign("tuoList",$tuoList);
        $this->assign("serviceList",$serviceList);
        $this->assign("helpList",$helpList);
        $this->assign("patchList",$patchList);
        $this->assign("payList",$payList);
        $this->assign("aboutList",$aboutList);
        $this->assign("ttfw",$ttfw);
        $this->assign('aq',$aq);
        $this->assign('dh',$dh);
        $this->assign("UserInfo",self::top());
    }

    //判断登录
    function is_mobile(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
        $is_mobile = false;
        foreach ($mobile_agents as $device) {
            if (stristr($user_agent, $device)) {
                //echo $device;
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }
    
    /*
     * 判断会员session是否过期
     */
    public function checkUserSession() {
    	$user = jiema(session('user'));
        //设置超时为20分
        $nowtime = time();
        $s_time = $user['time'];
        if($s_time){
        	if (($nowtime - $s_time) > 1200) {
        		session('time',null);
        	} else {
        		$acc = json_decode(des_decrypt_php(session('user')),true);
        		$acc['time'] = $nowtime;
        		session('user',des_encrypt_php(json_encode($acc)));
        	}
       	} else {
       		session('user',null);
       	} 	
    }
    
    /*
     * 判断会员是否登陆
     */
    function checkUser(){
    	$user = jiema(session('userData'));
    	if ($user){
    		return true;
    	} else {
    		$this->redirect('Login/pclogin');
    	}
    }
    
    /*
     * 判断短信有效时间
     */
    function smstime(){
    	$sms = session('sms');
    	$dtime = time();
    	if (($dtime-$sms['time'])>180){
    		session('sms',null);
    	}
    }
    
    /**
     * 上传头像
     * return url
     */
    public function uploadImg(){
        $upload = new \Think\Upload(C('UPLOAD_CONFIG_HEADER'));	// 实例化上传类
        //头像目录地址
        $path = './Upload/Avatar/';
        //返回图片地址
        $paths = '/Upload/Avatar/';
        $info = $upload->upload();
        if(!$info) {
            // 上传错误提示错误信息
            $this->ajaxReturn(array('status'=>0,'info'=>$upload->getError()));
        }else{
            // 上传成功 获取上传文件信息
            $temp_size = getimagesize($path.$info["Filedata"]["savepath"].$info["Filedata"]["savename"]);
            //print_log("--------------------------".json_encode($temp_size));
            if($info['size'] > 3*1024){//判断宽和高是否符合头像要求
                $this->ajaxReturn(array('status'=>0,'info'=>'图片不得大于3M'));
            }
            $this->ajaxReturn(array('status'=>1,'path'=>__ROOT__.$paths.$info["Filedata"]["savepath"].$info["Filedata"]["savename"],'width'=>$temp_size[0],'height'=>$temp_size[1]));
        }
    }
    /**
     * 裁剪并保存用户头像
     * return url
     */
    public function cropImg(){
        //图片裁剪数据
        $params = I('post.');						//裁剪参数
        if(!isset($params) && empty($params)){
            $this->showErrorPage('参数错误！');
        }
        //var_dump($params);
        //头像目录地址
        //$path = '/Avatar/';
        //要保存的图片
        $arr = explode('.',$params['src']);
        $real_path ='.'.$arr[0].'_'.'jqh.'.$arr[1];
        //临时图片地址
        $pic_path = '.'.$params['src'];//$path.'temp.jpg';
        //实例化裁剪类
        $Think_img = new \Think\Image();
        //裁剪原图得到选中区域
        $Think_img->open($pic_path)->crop($params['w'],$params['h'],$params['x'],$params['y'])->save($real_path);
        //生成缩略图
        $data['flag'] = 1;
        $data['path'] = $arr[0].'_'.'jqh.'.$arr[1];
        $this->ajaxReturn($data);
    }

    /*
     * 多图上传
     * @author yao
     * @time 2016-7-19
     */
    public function moreimg(){
        $this->display('Picupload/picuploadmore');
    }
    
    /*
     * 百度富文本
     * @author yao
     * @time 2016-7-19
     */
    public function textarea(){
        $this->display('Textarea/index');
    }
        
    /**
     * 图片上传
     */
    function upload(){
        $mark = I('mark');
        $ci = I("config")==""?'UPLOAD_CONFIG':I("config");
        $upload = new \Think\Upload(C($ci));// 实例化上传类
        // 上传文件
        $info = $upload->upload();
    
        if(!$info) {// 上传错误提示错误信息
            //$this->error($upload->getError());
            $data['flag']= false;
            $data['msg']= $upload->getError();
        }else{// 上传成功
            //$filesize = $info['files']['size'];
            $fileurl = $_SERVER['DOCUMENT_ROOT'].'Upload/'.$info['files']['savepath'].$info['files']['savename'];
            $filepath = "http://".$_SERVER["HTTP_HOST"].'/Upload/'.$info['files']['savepath'].$info['files']['savename'];
            list($width, $height, $type, $attr) = getimagesize($filepath);
            $list = C('STATIC_PROPERTY.POSITION_CONFIG')[$mark];
            if($mark!='CLASSTHUMB'){
                if($width>$list['W']||$height>$list['H']){
                    unlink($fileurl);
                    $data['flag']= false;
                    $data['msg']= "您上传的图片已超出宽度或高度，请调整后上传!";
                }else{
                    $data['flag']= true;
                    $data['fileurl'] = '/Upload/'.$info['files']['savepath'].$info['files']['savename'];
                }
            }else{
                if($width>$list['W']||$height!=$list['H']){
                    unlink($fileurl);
                    $data['flag']= false;
                    $data['msg']= "您上传的图片已超出宽度或高度，请调整后上传!";
                }else{
                    $data['flag']= true;
                    $data['fileurl'] = '/Upload/'.$info['files']['savepath'].$info['files']['savename'];
                }
            }
            /* }else{
             if($width!=$list['W']||$height!=$list['H']){
             unlink($fileurl);
             $data['flag']= false;
             $data['msg']= "您上传的图片不符合宽度或高度的要求，请调整后上传!";
             }else{
             $data['flag']= true;
             $data['fileurl'] = '/Upload/'.$info['files']['savepath'].$info['files']['savename'];
             }
             } */
            $this->ajaxReturn($data);
        }
    }
    /**
     * 错误页面跳转
     * msg 错误信息
     * url 重定向页面
     * times 跳转等待时间
     * 调用方式:parent::showErrorPage(msg,url,times);
     * @param string $data
     */
    function showErrorPage($msg="数据错误请联系管理员!",$url="",$times=1){
    
        $this->assign("url",$url);
        $this->assign("msg",$msg);
        $this->assign("times",$times);
        $this->display('Error:404');
    }
    /**
     * 成功页面跳转
     * msg 成功 信息
     * url 重定向页面
     * times 跳转等待时间
     * 调用方式:parent::showErrorPage(msg,url,times);
     * @param string $data
     */
    function showSucceePage($msg="操作成功!",$url="",$times=1){
    
        $this->assign("url",$url);
        $this->assign("msg",$msg);
        $this->assign("times",$times);
        $this->display('Error:succee');
    }
    /**
     * 表单Token防止重复提交。
     */
    public function token($s=''){
        $sum = create_random_code($s);
        $sum_two = des_encrypt_php($sum);
        session('token',$sum_two);
        return $sum_two;
    }
    

    /*
     * 底部信息
     */
    function footer(){
    	$model = M('hs_other_info');
    	//说明
    	$arr = array();
    	$sm = array_slice(C('STATIC_PROPERTY.OTHER_INFO'),0,5);
    	foreach ($sm as $k=>&$v){
    		$ar['xia'] = $k;
    		$ar['title'] = $v;
    		$ar['name'] = $model->where(array('fo_flag'=>'N','fo_type'=>$k))->select();
    		$arr[] = $ar;    		
    	}
    	$nav = array_slice(C('STATIC_PROPERTY.OTHER_INFO'),5);
    	foreach ($nav as $k=>&$v){
    		$ar['xia'] = $k;
    		$a['title'] = $v;
    		$map['fo_flag'] = array('eq','Y');
    		$map['fo_type'] = array('eq',$k);
    		$map['fo_pid'] = array('exp','is NULL');
    		$a['name'] = $model->where($map)->select();
    		$arr[] = $a;    		
    	}
    	//友情链接
    	//$arr['link'] = M('link')->select();
    	//系统信息
    	//$arr['sys'] = M('config')->find();
    	return $arr;
    }
    /**
     * 获取微信accsen_token
     */
    function getAccsenToken(){
    	//获取微信公众号信息
    	$APPID=C("APPID");
    	$APPSECRET=C("SECRET");
    	$access_token = S("accesstoken");
    	if($access_token == "" || $access_token == null){
    		$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;
    		$json = https_request($TOKEN_URL);
    		$result=json_decode($json,true);
    		S("accesstoken",$result['access_token'],'7000');
    		print_log("获取的token:".$result['access_token']);
    		print_log("获取是否成功:".$result['errcode']);
    		$access_token = $result['access_token'];
    	}
    	return $access_token;
    }
    
    //top方法
    public function top(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'));
        if($session_User['id']>0){
            $userInfo['login'] = 1;
            $userInfo['userInfo'] = $session_User;
        }else{
            $userInfo['login'] = 0;
        }
        return $userInfo;
    }
}