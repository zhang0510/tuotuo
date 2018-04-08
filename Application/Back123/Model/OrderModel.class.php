<?php
namespace Back\Model;
use Think\Model\RelationModel;
class OrderModel extends RelationModel{
    protected $_link = array(
        'OrderInfo'=>array(
            'mapping_type' => self::HAS_ONE,
            'class_name'   => 'OrderInfo',
            'foreign_key ' => 'order_id',
        ),
        'Cwgl'=>array(
            'mapping_type' => self::HAS_ONE,
            'class_name'   => 'Cwgl',
            'foreign_key ' => 'order_id',
        ),
		//提车员订单信息
		'CarOrder' => array(
			'mapping_type'  =>  self::HAS_ONE,
			'class_name'  	=> 	'CarOrder',
			'foreign_key'	=>	'order_id'	
		),
        'YunDan'=>array(
            'mapping_type' => self::HAS_MANY,
            'class_name'   => 'Yundan',
            'foreign_key ' => 'order_id',
        ),
        'Wuliu'=>array(
            'mapping_type' => self::HAS_MANY,
            'class_name'   => 'Wuliu',
            'foreign_key ' => 'order_id',
        ),
    );	/*
	 * 获取所有订单信息
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	public function getInfo($where){
		$orderObj = M("order");
		$orderInfoObj = M("order_info");
		$num = $orderObj->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$list = $this->where($where)->order("order_time desc")->limit($page->limit)->select();
		$size = count($list);
		if($size>0){
			for($i=0;$i<$size;$i++){
				$infoMap['order_code'] = array("eq",$list[$i]['order_code']);
				$list[$i]['OrderInfo'] = $orderInfoObj->where($infoMap)->find();
			}
		}
		$info['list'] = $list;
		return $info;
	}		
	/*
	 * 根据订单状态获取当前订单总数
	 * @date: 2016-8-10
	 * @author: yao
	 * @return int
	 */
	public function getNum($status){
		if ($status)
		$map['order_status'] = array('eq',$status);
		$num = $this -> where($map) -> count();
		return $num;
	}
	/*
	 * 获取所有订单信息
	 * @date 2016-8-7
	 * @author yao
	 * @param 
	 * return array
	 */
	public function getAll($code){
	    $area_M = M('area');
	    $order_M = M('order');
	    $orderInfo_M = M('order_info');
	    $carOrder_M = M('car_order');
	    $yunDan_M = M('yundan');
	    $wuliu_M = M('wuliu');
	    $user_M = M('user');
	    //写入条件
	    $map['order_code'] = array('eq',$code);
	    //查询全部表
		$info = $order_M ->where($map)->find();
		$info['OrderInfo'] = $orderInfo_M ->where($map)->find();
		$info['CarOrder'] = $carOrder_M ->where($map)->find();
		$info['YunDan'] = $yunDan_M ->where($map)->select();
		$info['Wuliu'] = $wuliu_M ->where($map)->select();
		$maps['user_code'] = array('eq',$info['user_code']);
		$info['User'] = $user_M -> where($maps) -> find();
		if ($info['OrderInfo']['order_info_star']!=""&& $info['OrderInfo']['order_info_star']!=null){
		    //循环查询地点对应名称
		    $star = explode(",",$info['OrderInfo']['order_info_star']);
		
		    for ($i=0;$i<count($star);$i++){
		        $mep['area_id'] = array('eq',$star[$i]);
		        $startList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
		    }
		    //存储起始地
		    $info['OrderInfo']['order_info_stars'] = $startList;
		}else {
		
		    $info['OrderInfo']['order_info_stars'] = "";
		}
		
		if ($info['OrderInfo']['order_info_end']!=""&& $info['OrderInfo']['order_info_end']!=null){
		    //循环查询地点对应名称
		    $end = explode(",",$info['OrderInfo']['order_info_end']);
		
		    for ($i=0;$i<count($end);$i++){
		        $mep['area_id'] = array('eq',$end[$i]);
		        $endList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
		    }
		    //存储起始地
		    $info['OrderInfo']['order_info_ends'] = $endList;
		}else {
		
		    $info['OrderInfo']['order_info_ends'] = "";
		}
		
		return $info;
	}
	
	/**
	 * 获取当前订单总数
	 * @date: 2016-8-9 下午3:08:56
	 * @author: liuxin
	 * @return int
	 */
	public function getOrderNum(){
	    $map['pay_status'] = array('eq','Y');
	    $num = $this -> where($map) -> count();
	    return $num;
	}
	/**
	 * 获取财务信息列表
	 * @date: 2016-8-15 下午8:38:50
	 * @author: liuxin
	 */
	public function getFinanceList($search='',$startDate='',$endDate='',$code=''){
	    $map[] = '1=1';
	    if($search!=''){
	        $map_['order_code'] = array('like','%'.$search.'%');
	        $map_['user_name'] = array('like','%'.$search.'%');
	        $map_['user_tel'] = array('like','%'.$search.'%');
	        $map_['_logic'] = 'or';
	        $map['_complex'] = $map_;
	    }
	    if($startDate!=''&&$endDate!=''){
	        $map['order_time'] = array('between',array($startDate,$endDate));
	    }
		if($code != ''){
			$map['order_code'] = array('in',$code);
		}
	    $list = $this -> where($map) -> select();
	    foreach($list as $key => &$value){
	        $obj = M('order_info');
	        $infoMap['order_id'] = array('eq',$value['order_id']);
	        if($search!=''){
	            $infoMap['order_info_type'] = array('like','%'.$search.'%');
	        }
	        $listInfo = $obj -> where($infoMap) -> find();
	        $value['orderInfo'] = $listInfo;
	        $yunObj = M('yundan');
	        $yunMap['order_id'] = array('eq',$value['order_id']);
	        $listYun =  $yunObj -> where($yunMap) -> order('yd_time desc') -> select();
			$ydsize = count($listYun);
			for($j=0;$j<$ydsize;$j++){
				$times = $listYun[$j]['yd_time'];
				$ls_time = explode(" ",$times);
				$order_time = explode("-",$ls_time[0]);
				$listYun[$j]['time_A'] = $order_time[0];
				$listYun[$j]['time_B'] = $order_time[1];
				$listYun[$j]['time_C'] = $order_time[2];
			}
	        if($listYun!=null){
	            $value['yundan'] = $listYun;
	        }else{
	            unset($list[$key]);
	        }
	    }
	    foreach($list as $key=>$vo){
	        $array[] = $vo['order_id'];
	    }
	    if($array!=null){
	       $maps['order_id'] = array('in',$array);
	    }else{
	        $data='';
	        return $data;
	    }
	    $Tnum = $this ->  where($maps) -> count();
	    $page = set_page($Tnum,10);
	    $Tlist = $this ->  where($maps) -> limit($page->limit) -> select();
	    $data['page'] = $page -> BackPage();
		$nnn=0;
	    foreach($Tlist as $key => &$value){
			$nnn++;
			
	        $obj = M('order_info');
	        $infoMap_['order_id'] = array('eq',$value['order_id']);
	        $listInfo = $obj -> where($infoMap_) -> find();
	        $value['orderInfo'] = $listInfo;
			print_log("订单详情：".json_encode($listInfo));
	        $yunObj = M('yundan');
	        $yunMap['order_id'] = array('eq',$value['order_id']);
	        $listYun =  $yunObj -> where($yunMap) -> order('yd_time desc') -> select();
			$ydsizes = count($listYun);
			for($k=0;$k<$ydsizes;$k++){
				$times = $listYun[$k]['yd_time'];
				$ls_time = explode(" ",$times);
				$order_time = explode("-",$ls_time[0]);
				$listYun[$k]['time_A'] = $order_time[0];
				$listYun[$k]['time_B'] = $order_time[1];
				$listYun[$k]['time_C'] = $order_time[2];
			}
	        $value['yundan'] = $listYun;
	    }
	    $data['num'] = $Tnum;
	    $data['list'] = $Tlist;
		print_log("财务信息：".json_encode($data));
	    return $data;
	}
	/**
	 * 获取单条财务信息
	 * @date: 2016-8-15 下午8:39:55
	 * @author: liuxin
	 * @param string $id
	 * @return unknown
	 */
public function getFinanceInfo($order_code=''){
	    //初始化
	    $order_M = M('order');
        $orderInfo_M = M('order_info');
        $yundan_M = M('yundan');
        $cwgl_M = M('cwgl');
        //组装参数
        $map['order_code'] = array('eq',$order_code);
        //查询
        $list['order'] = $order_M -> where($map)->find();
        $list['order_info'] = $orderInfo_M -> where($map)->select();
        $list['yundan'] = $yundan_M -> where($map)->select();
	    $list['cwgl'] = $cwgl_M -> where($map)->find();
	    
	    //订单总价
	    if ($list['order_info'][0]['order_info_zj']!=""){
	        $list['order_info'][0]['order_info_zj'] = $list['order_info'][0]['order_info_zj']/100;
	    }else{
	        $list['order_info'][0]['order_info_zj'] = 0;
	    }
	    
	    
	    //运单费用状态
	    foreach($list['yundan'] as $key=>$vo){
	        if($vo['yd_flag']=='S'){
	            $list['songche'] = $vo['yd_price']; 
	        }
	        if($vo['yd_flag']=='M'){
	            $list['shangmen'] = $vo['yd_price'];
	        }
	        $list['zong'] += $vo['yd_price']; 
	    }
	    
	    //出发地
	    if ($list['order_info'][0]['order_info_star']!=""){
	        $start = self::getCityName($list['order_info'][0]['order_info_star']);
	    }else{
	        $start = "";
	    }
	    
	    //目的地
	    if ($list['order_info'][0]['order_info_end']!=""){
	        $end = self::getCityName($list['order_info'][0]['order_info_end']);
	    }else{
	        $end = "";
	    }
	    
	    //接车时间
	    for ($j=0;$j<count($list['yundan']);$j++){
	        if($list['yundan'][$j]['yd_j_time']!=""){
	            $ls_time = explode(" ",$list['yundan'][$j]['yd_j_time']);
	            $list['yundan'][$j]['time'] = explode("-",$ls_time[0]);
	        }else{
	            $list['yundan'][$j]['time'] = "";
	        }
	    }
	    
	    
	    //线路
	    $list['route'] = $start.'-'.$end;
	    return $list;
	}
	/**
	 * 获取城市列表
	 * @date: 2016-8-15 下午8:40:47
	 * @author: liuxin
	 * @param string $str 一个组合的字符串 包含城市信息
	 * @return Ambigous <>
	 */
	public function getCityName($str=''){
	    $arr[] = explode(',',$str);
	    $obj = M('area');
	    $map['area_id'] = array('eq',$arr[0][1]);
	    $city = $obj -> where($map) -> find();
	    return $city['area_name'];
	}
	/**
	 * 更改运单
	 * @date: 2016-8-15 下午8:41:45
	 * @author: liuxin
	 * @param string $code 运单code
	 * @param string $status   运单状态
	 * @param string $mark 标示
	 * @return Ambigous <boolean, unknown>
	 */
	public function change($code='',$status='',$mark=''){
	    $map['yd_code'] = array('eq',$code);
	    $data['yd_status'] = $status;
	    $data['yd_mark'] = $mark;
	    $obj = M('Yundan');
	    $res = $obj -> where($map) -> save($data);
	    return $res;
	}
	/**
	 * 更改其他费用
	 * @date: 2016-8-15 下午8:44:11
	 * @author: liuxin
     * @param string $id 财务信息id
     * @param string $fee   费用
     * @return Ambigous <boolean, unknown>
     */
	public function inputFee($id='',$fee=''){
	    $map['cwgl_id'] = array('eq',$id);
	    $obj = M('cwgl');
	    $cobj = M('log');
	    
	    $data['cwgl_s_price'] = $fee*100;
	    
	    $admin = json_decode(des_decrypt_php(session('master')),true);
	    $info = $obj -> field('order_code') -> where($map) -> find();
	    $datas['admin_code'] = $admin['admin_code'];
	    $datas['log_code'] = get_code('tl');
	    $datas['log_time'] = date('Y-m-d H:i:s',time());
	    
	    /* if($_SERVER['HTTP_CLIENT_IP']){
	        $onlineip=$_SERVER['HTTP_CLIENT_IP'];
	    }elseif($_SERVER['HTTP_X_FORWARDED_FOR']){
	        $onlineip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }else{ */
	        //$onlineip=$_SERVER['REMOTE_ADDR'];
	    //}
	    $onlineip=$this -> getIp();
	    
	    $datas['log_ip'] = $onlineip;
	    $datas['log_content'] = '管理员'.$admin["admin_name"].'将财务管理信息code为'.$info["order_code"].'的其他费用改为'.$fee;
	    
	    $obj -> startTrans();
	    $cobj -> startTrans();
	    $resu = $obj -> where($map) -> setField($data);
	    $ress = $cobj -> add($datas);
	    $res = $resu&&$ress;
	    if($res){
	        $obj -> commit();
	        $cobj -> commit();
	    }else{
	        $obj -> rollback();
	        $cobj -> rollback();
	    }
	    return $res;
	}
	function getIp(){
	    $onlineip='';
	    if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
	        $onlineip=getenv('HTTP_CLIENT_IP');
	    } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
	        $onlineip=getenv('HTTP_X_FORWARDED_FOR');
	    } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
	        $onlineip=getenv('REMOTE_ADDR');
	    } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
	        $onlineip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $onlineip;
	}
	/**
	 * 写入日志
	 * @date: 2016-9-11 下午2:39:42
	 * @author: liuxin
	 * @param string $content 更改的种类 如 总价
	 * @param string $price    价格
	 * @return Ambigous <\Think\mixed, boolean, unknown, string>
	 */
	function geLog($content='',$price=''){
	    $cobj = M('log');
	    $admin = json_decode(des_decrypt_php(session('master')),true);
	    $datas['admin_code'] = $admin['admin_code'];
	    $datas['log_code'] = get_code('tl');
	    $datas['log_time'] = date('Y-m-d H:i:s',time());
	    $onlineip=$this -> getIp();
	    $datas['log_ip'] = $onlineip;
	    $datas['log_content'] = '管理员'.$admin["admin_name"].'将'.$content.'改为'.$price;
	    $ress = $cobj -> add($datas);
	    return $ress;
	}
}