<?php
namespace Back\Model;
use Think\Model;
class BaseModel extends Model {
    Protected $autoCheckFields = false;
    /**
     * @无限级分类递归查询
     * @param number $pid    父ID 默认0
     * @param string $tbname 表名
     * @param string $pidn   父ID字段名
     * @param string $idn    子ID字段名
     * @param string $names  名称字段名
     * @param string $order  排序字段 自定义
     * @param number $mark   返回数据拼接（自定义）方法名getStr
     * @$data  扩展参数<可以是数组也可以是单个参数>
     * @return $data  Array 返回值，可扩展
     */
    function getTypess($pid=0,$tbname="gypt_master_power",$pidn="lmp_parent_id",$idn="lmp_id",$names="lmp_name",$order="lmp_order ASC",$mark=0,$data=null){
        $ltObj = M($tbname);
        $ltMap[$pidn] = array("eq",$pid);
        $ltList = $ltObj->where($ltMap)->order($order)->select();
        $size = count($ltList);
        for ($i = 0; $i < $size; $i++) {
            $this->n = intval($this->n) + 1;
            $this->stropt = $this->stropt.$this->getStr($mark,$ltList[$i],$data);
            $ltMaps[$pidn] = array("eq",$ltList[$i][$idn]);
            $lts = $ltObj->where($ltMaps)->count();
            if($lts==0){
                continue;
            }else{
                $this->getTypess($ltList[$i][$idn],$tbname,$pidn,$idn,$names,$order,$mark,$data);
            }
        }
        $datas['str'] = $this->stropt;
        return $datas;
    }
    /**
     * @产生分割线
     * @param number $n  需要生产分割线的个数 $n*2
     * @param number $coefficient  需要生产分割线的个数 $n*2 默认2
     * @return string
     */
    function getLine($n=0,$coefficient=2){
        $str="";
        $n = $n*$coefficient;
        if($n>0){
            for ($i = 0; $i < $n; $i++) {
                $str.="-";
            }
        }
        return $str;
    }
    /**
     * @自定义拼装
     * @param number $mark
     * @param Object $vo
     * @param Object $data
     * @return string
     */
    function getStr($mark=0,$vo=null,$data=null){
        if($mark==0){
            //生成自定义字符串
            $str = "<option value='".$vo["lt_id"]."'>".$this->getLine($vo["lt_grade"]).$vo["lt_name"]."</option>";
        }else if($mark==1){
            //增加自己的字符串拼接
            if($data["id"]==$vo["lgt_id"]){
                $strd = "selected='selected'";
            }
            if($data["flag"]){
                $grade = "";
            }else{
                $grade = "-".$vo["lgt_grade"];
            }
            $str = "<option value='".$vo["lgt_id"].$grade."'$strd>".$this->getLine($vo["lgt_grade"],3).$vo["lgt_name"]."</option>";
        }elseif($mark==2){
            $str = '<li onclick="clickFun('.$vo["gwt_id"].','.$vo["gwt_levl"].');">'.$this->getLine($vo["gwt_levl"]).$vo["gwt_name"].'</li>';
        }elseif($mark==3){
            $str = "<tr>";
            $str.="<td>".$this->n."</td>";
            $str.="<td>".$this->getLine($vo["gwt_levl"]).$vo["gwt_name"]."</td>";
            if($vo['gwt_p_id']!=0){
                $str.="<td><a href='".U('Back/Work/typeEdit/id/'.$vo['gwt_id'])."'>修改</a>&nbsp;&nbsp;<a href='".U('Back/Work/typeDel/id/'.$vo['gwt_id'])."' onclick='if(confirm(\"确定删除?\")==false)return false;'>删除</a></td>";
            }
            $str.="</tr>";
        }
        return $str;
    }
    /**
     * 根据ID精确获取城市信息对象
     * @param string $code
     */
    function getCityAreaVo($code=""){
        $lcObj = M("gypt_cityarea");//城市区域
        $map["region_id"] = array("eq",$code);
        $ss = $lcObj->where($map)->find();
        $maps['region_id'] = array('eq',$ss['parent_id']);
        $bb = $lcObj->where($maps)->find();
        return $bb['region_name'].$ss['region_name'];
    }
    /**
     * 获取当前管理员登陆信息
     */
    function getMaster(){
        if(session("master")!=""&&session("master")!=null){
            $data = json_decode(des_decrypt_php(session("master")),true);
            return $data;
        }else{
            return "";
        }
        
    }
    /**
     * 查询所有登录用户所有权限
     */
    function getPrower($id=0){
        $lmpObj = M("gypt_master_power");//权限表
        $lmpsObj = M("gypt_master_powerlist");//用户权限
        $accs = json_decode(des_decrypt_php(session('master')),true);//获取登录用户信息
        if ($accs['gm_username']=='admin'){
            $map['lmp_parent_id'] = array('eq',$id);
            //$map['lmp_status'] = array('eq',1);
            $lp = $lmpObj ->where($map)->order("lmp_order asc") -> select();
            $size = count($lp);
            for($i=0;$i<$size;$i++){
                $lp[$i]['zi'] = $this->getPrower($lp[$i]['lmp_id']);
            }
        }else{
            $mapDs['lmpl_master_id'] = array('eq',$accs['gm_code']);
            $s = $lmpsObj->where($mapDs) -> select();
            if($s){
                foreach($s as $k=>$v){
                    $arr[] = $v['lmp_id'];
                }
                $map['lmp_parent_id'] = array('eq',$id);
                if(count($arr)>0){
                    $map['lmp_id'] = array('IN',$arr);
                }
                $map['lmp_status'] = array('eq',1);
                $lp = $lmpObj ->where($map)->order("lmp_order asc") -> select();
                $size = count($lp);
                for($i=0;$i<$size;$i++){
                    $lp[$i]['zi'] = $this->getPrower($lp[$i]['lmp_id']);
                }
            }else{
                $lp='';
            }
        
        }
        return $lp;
    }
    /**
     * 获取权限方法名下所有3级权限
     * @str 权限方法名
     */
    function getFunctions($str=''){
        $gmpObj = M("gypt_master_power");
        $map['lmp_function'] = array('eq',$str);
        $ret = $gmpObj -> where($map) -> find();
        $maps['lmp_parent_id']  = array('eq',$ret['lmp_id']);
        $list = $gmpObj->where($maps)->select();
        $arr = '';
        for($i=0;$i<count($list);$i++){
            $arr[$list[$i]['lmp_function']] = $list[$i];
        }
        return $arr;
    }
	/**
     * 生成 订单，运单，提车单，财务  单号
     * 054+00001//订单
     * 036+00001//运单
     * 012+00001//提车单
     * 097+00001//财务
	 * 051+00001//客服下单
	 * 201700001 //优惠卷码 （F）
     * 订单/运单/提车单/财务(D/Y/T/C)

     */
    function getTablecode($codemark="D"){
    	$tcObj = M("tablecode");
		if($codemark=="D"){
			$obj = M("order");//订单表
			$orderTouMap="1=1";
			$listTou = $obj->where($orderTouMap)->order('order_id desc')->select();
			$order_code = $listTou[0]['order_code'];//头表code
			$order_code_linshi = $order_code + 1;
			$headCode = "0".$order_code_linshi;
			return $headCode;
		}else if($codemark=="M"){
			$obj = M("order");//订单表
			$orderTouMap="1=1 AND source='A'";
			$listTou = $obj->where($orderTouMap)->order('order_id desc')->select();
			if($listTou){
			    $order_code = $listTou[0]['order_code'];//头表code
			    $order_code_linshi = $order_code + 1;
			    $headCode = "0".$order_code_linshi;
			}else{
			    $map['codemark'] = array("eq",$codemark);
			    $ret = $tcObj->where($map)->find();
			    $code = $ret['code'];
			    $data['code'] = $code+1;
			    $tablecode = $this->stringJoint($data['code'],$codemark);
			    if($tablecode!=""){
			        $tcObj->where($map)->save($data);
			        return $tablecode;
			    }else{
			        return 'N';
			    }
			}
			return $headCode;
		}else if($codemark=="Y"){//运单
			$oiObj = M("yundan");//明细表
			$oiMap = "1=1";
			$oiList = $oiObj->where($oiMap)->order('yd_id desc')->select();
			$order_info_code = $oiList[0]['yd_code'];;//头表code
			$order_info_code_linshi = $order_info_code + 1;
			$infocode = "0".$order_info_code_linshi;
			return $infocode;
		}else if($codemark=="T"){//提车
			$oiObj = M("car_order");//明细表
			$oiMap = "1=1";
			$oiList = $oiObj->where($oiMap)->order('car_id desc')->select();
			$order_info_code = $oiList[0]['car_order_code'];;//头表code
			$order_info_code_linshi = $order_info_code + 1;
			$infocode = "0".$order_info_code_linshi;
			return $infocode;
		}else if($codemark=="C"){//财务
			$oiObj = M("car_order");//明细表
			$oiMap = "1=1";
			$oiList = $oiObj->where($oiMap)->order('car_id desc')->select();
			$order_info_code = $oiList[0]['car_order_code'];;//头表code
			$order_info_code_linshi = $order_info_code + 1;
			$infocode = "0".$order_info_code_linshi;
			return $infocode;
		}else if($codemark=="F"){
		     $map['codemark'] = array("eq",$codemark);
		     $co=$tcObj->where($map)->find();
		     $code = $co['code'];
		     $data['code'] = $code+1;
		     $year=date('Y',time()).'00000';
		     $tablecode = intval($year)+$code;
		     if($tablecode!=""){
		         $tcObj->where($map)->save($data);
		         return $tablecode;
		     }
		}else{
		    $map['codemark'] = array("eq",$codemark);
		    $ret = $tcObj->where($map)->find();
		    $code = $ret['code'];
		    $data['code'] = $code+1;
		    $tablecode = $this->stringJoint($data['code'],$codemark);
		    if($tablecode!=""){
		        $tcObj->where($map)->save($data);
		        return $tablecode;
		    }else{
		        return 'N';
		    }
		}
    }
    /**
     * 字符串拼接
     */
    function stringJoint($code='',$codemark=''){
	    	$len = strlen($code);
	    	$str="";
	    	switch($len){
	    		case 1;
	    		$str = '0000'.$code;
	    		break;
	    		case 2;
	    		$str = '000'.$code;
	    		break;
	    		case 3;
	    		$str = '00'.$code;
	    		break;
	    		case 4;
	    		$str = '0'.$code;
	    		break;
	    		case 5;
	    		$str = $code;
	    		break;
	    		default:
	    			$str = 'N';
	    	}
	    
    	if($codemark=="D"&&$str!="N"){
    		return '054'.$str;
    	}else if($codemark=="Y"&&$str!="N"){
    		return '036'.$str;
    	}else if($codemark=="T"&&$str!="N"){
    		return '012'.$str;
    	}else if($codemark=="C"&&$str!="N"){
    		return '097'.$str;
    	}else if($codemark=="M"&&$str!="N"){
    		return '051'.$str;
    	}else{
    	    return '';
    	}
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