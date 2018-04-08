<?php
namespace Back\Controller;
use Think\Controller;
use Think\Auth;
class BaseController extends Controller {
     public function _initialize(){
        $this->checkAdminSession();
        $this->assign('id',self::getnavid());
        $obj = new \Think\Auth();
        $accs = json_decode(des_decrypt_php(session('master')),true);
        $aids = $obj->getGroups($accs['admin_id']);
        $objss = M('authRule');//规则表
        if($accs['admin_acc']!="admin"){
            $map['_string'] = ' (level = "1") ';
            $map['id'] = array('in',$aids[0]['rules']);
            $map['pid'] = array('eq',0);
            $map['status'] = array('eq','1');
        }else{
            $map['_string'] = ' (level = "1") ';
            $map['pid'] = array('eq',0);
            $map['status'] = array('eq','1');
        }
        $lps = $objss ->where($map)->find();
        $funs = $this->getFunctions();
        $this->assign('leftprower',$this->leftPrower());
        if($accs['admin_acc'] != "admin"){
            if(IS_AJAX){
                $bb = $obj->check($funs,$accs['admin_id']);
                if(!$bb){
                    $this->ajaxReturn("您的权限无法访问");
                    exit;
                }
            }else{
                $bb = $obj->check($funs,$accs['admin_id']);
                if(!$bb){
                    $this->redirect($lps['name']);
                    exit;
                }
            }
        }
        $this->assign("master",$accs);
    }
    /*
     * 取左边栏的id
     */
    function getnavid(){
    	$id = '';
		$obj = M('authRule');
		$info = $obj->select();
     	$arr = explode('/', $_SERVER['PATH_INFO']);
     	$url = $arr[0].'/'.$arr[1];
    	foreach ($info as $v){
    		if (strtolower($url) == strtolower($v['name'])){
    			if (empty($v['pid'])){
    				$id = $v['id'];
    			} else {
    				$ar = $obj->where(array('id'=>$v['pid']))->find();
    				if (empty($ar['pid'])){
    					$id = $ar['id'];
    				} else {
    					$newar = $obj->where(array('id'=>$ar['pid']))->find();
    					$id = $newar['id'];
    				}
    			}    			
    		}
    	}
    	return $id;
    }
    
    /**
     * 左侧导航栏
     */
    function leftPrower($pid=0){
    	$obj = new Auth();
    	$accs = jiema(session('master'));
    	$aid = $obj->getGroups($accs['admin_id']);
        $obj = M('authRule');//规则表
        if($accs['admin_code']!="admin"){
            $map['_string'] = ' (level = "1" AND status="1") ';
            $map['id'] = array('in',$aid[0]['rules']);
            $map['pid'] = array('eq',$pid);
        }else{
            $map['_string'] = ' (level = "1" AND status="1") ';
            $map['pid'] = array('eq',$pid);
        }
        $lp = $obj ->where($map)->order('id')->select();
        //dump($accs['admin_code']);die();
        $size = count($lp);
        return $lp;
    } 
    /*
     * 判断登录
     */
     public function checkAdminSession() {
        $mas = jiema(session('master'));
        //设置超时为10分
        $nowtime = time();
        $s_time = session('time');
        if (empty($mas)){
        	$this->error('请先登陆！', U("Login/index"));
        } else {
	        if($s_time){
	            if (($nowtime - $s_time) > C('STATIC_PROPERTY')['BACK_LOGIN_TIME']) {
	                session('time',null);
	                $this->error('登录超时，请重新登陆', U("Login/index"));
	            } else {
	                $acc = json_decode(des_decrypt_php(session('master')),true);
	                $this->assign('mas',$mas);
	                session('time',$nowtime);
	            }
	        }
	        else{
	        	session('master',null);
	            $this->error('当前用户未登录，请重新登陆', U("Login/index"));
	             
	        }        	
        }        
    }  
    
    /**
     * 页面静态化方法，
     * @param string $data
     * @return boolean
     */
    function pageStatic($path="",$data=null){
        if($data!=null){
            $dir = $path==""?$_SERVER['DOCUMENT_ROOT'].'/Application/Home/View/Temp':$path;
            $this->dleDir($dir);
            $data[0]["url"] = "http://".$_SERVER["HTTP_HOST"].'/index.php/Home/Index/static_index/act/1';
            $data[0]["filepath"] = $dir."/index.html";
            $data[1]["url"] = "http://".$_SERVER["HTTP_HOST"].'/index.php/Home/Synthesize/static_Synthesize';
            $data[1]["filepath"] = $dir."/main.html";
            $size = count($data);
            for ($i = 0; $i <$size;  $i++) {
                $current = file_get_contents($data[$i]["url"]);
                file_put_contents($data[$i]["filepath"], $current);
            }
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 删除文件及文件夹
     * @param unknown $directory
     */
   private function delDir($dir){
        //删除目录下的文件：
        $dh=opendir($dir);
        while ($file=readdir($dh)){
            if($file!="." && $file!=".."){
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)){
                    unlink($fullpath);
                }else{
                    deldir($fullpath);
                }
            }
        }
    }
    
    /**
     * 图片上传
     */
    function upload(){
        $mark = I('mark');
    	print_log('---------------------qqqqqqqqqqqqqq：'.$mark);
        $ci = I("config")==""?'UPLOAD_CONFIG':I("config");
    	print_log('---------------------config：'.$ci);
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
                if($width>$list['W']||$height>$list['H']){
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
     * 文件上传
     */
    function file(){
        $mark = I('mark');
        $ci = I("config")==""?'UPLOADFILE_CONFIG':I("config");
        $upload = new \Think\Upload(C($ci));// 实例化上传类
        // 上传文件
        $info = $upload->upload();
        
        if(!$info) {// 上传错误提示错误信息
            //$this->error($upload->getError());
            $data['flag']= false;
            $data['msg']= $upload->getError();
        }else{// 上传成功
            $filesize = $info['files']['size'];
            $fileurl = $_SERVER['DOCUMENT_ROOT'].'Upload/'.$info['files']['savepath'].$info['files']['savename'];
            //$filepath = "http://".$_SERVER["HTTP_HOST"].'/Upload/'.$info['files']['savepath'].$info['files']['savename'];
            //$size = filesize($info['files']['savename']);
            //$size = 10;
            $list = C('STATIC_PROPERTY.POSITION_CONFIG')[$mark];
            if($mark=='FILE'){
                if($filesize>$list){
                    unlink($fileurl);
                    $data['flag']= false;
                    $data['msg']= "您上传的文件过大，请调整后上传!";
                }else{
                    $data['flag']= true;
                    $data['fileurl'] = '/Upload/'.$info['files']['savepath'].$info['files']['savename'];
                }
            }
            $this->ajaxReturn($data);
        }
    }
    
    /**
     * 获取方法名
     */
    function getFunctions(){
        $str = $_SERVER['PATH_INFO'];
        if(substr_count($str,'/')>1){
            $arr = explode('/',$str);
            $str='';
            for ($i = 0; $i < 2; $i++) {
                $str .= $arr[$i].'/';
            }
        }
        return rtrim($str,'/');
    }
    
    /*
     * 公共头部
     */
    public function top(){
    	$this->display();
    }
    
    /*
     * 公共左部
     */
    public function left(){
    	$this->display();
    }
    
    /*
     * 公共日历
     */
    
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
    /**
     * 获取微信accsen_token
     */
    function getAccsenToken(){
        //获取微信公众号信息
        $APPID='wx9997ee90f1e5bb7b';//'wxf320aba12db4a196';
        $APPSECRET='8f0e48d68593f4b19f6c162730f76386';//'eb490e6ef2925ba1d6395d1c094a887e';
        $times = S("accesstoken")['time'];
        $time = time();
        if($time - $times > 7000){
            $TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;
            $json = https_request($TOKEN_URL);
            $result=json_decode($json,true);
            $data['access_token'] = $result['access_token'];
            $data['time'] = $time;
            S("accesstoken",$data);
            print_log("获取的token:".$result['access_token']);
            print_log("获取是否成功:".$json);
            $access_token = $result['access_token'];
        }else{
            $access_token = S("accesstoken")['access_token'];
        }
        return $access_token;
    }
}