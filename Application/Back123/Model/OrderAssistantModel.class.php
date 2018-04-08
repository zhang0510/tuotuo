<?php
namespace Back\Model;
use Think\Model\RelationModel;
class OrderAssistantModel extends RelationModel{
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
    );	
    public function getTablecode($codemark="D"){
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
    /*
	 * 获取所有订单信息
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	public function getInfo($where){
	    $area_M=M("area");
	    $posi_M =M('position_tracking_record');
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$data['page'] = $page -> Backpage();
		$list = $this->where($where)->order("order_time desc")->limit($page->limit)->select();
		$size = count($list);
		if($size>0){
			foreach ($list as &$info){
			    
			    if ($info['order_info_star']!=""&& $info['order_info_star']!=null){
			        //循环查询地点对应名称
			        $star = explode(",",$info['order_info_star']);
			        for ($i=0;$i<count($star);$i++){
			            $mep['area_id'] = array('eq',$star[$i]);
			            $startList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
			        }
			        //存储起始地
			        $info['order_info_stars'] = $startList;
			    }else {
			
			        $info['order_info_stars'] = "";
			    }
			
			    if ($info['order_info_end']!=""&& $info['order_info_end']!=null){
			        //循环查询地点对应名称
			        $end = explode(",",$info['order_info_end']);
			
			        for ($i=0;$i<count($end);$i++){
			            $mep['area_id'] = array('eq',$end[$i]);
			            $endList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
			        }
			        //存储起始地
			        $info['order_info_ends'] = $endList;
			    }else {
			
			        $info['order_info_ends'] = "";
			    }
			    $area=$posi_M ->where("order_code ='".$info['order_code']."'")->order("time desc")->field("content")->find();
			    if($area){
			        $address=explode("已到达",$area['content'])[1];
			        $info['area']=$address;
			    }else{
			        $info['area']='未知';
			    }
			}
		}
		$data['list'] = $list;
		return $data;
	}		
	/*
	 * 根据订单状态获取当前订单总数
	 * @date: 2016-8-10
	 * @author: yao
	 * @return int
	 */
	public function getNum($status=''){
	    $map['order_status'] = array('eq',$status);
		if ($status == 'S'){
		    $map['sh_status'] = array('eq','');
		}else if($status == ''){
		    $map['kefu_shi'] = array('eq','N');
		    unset($map['order_status']);
		}
		$num = $this -> where($map) -> count();
		return $num;
	}
	/*
	 *获取作废订单数 
	 */
	public function getDieNum(){
	    $where['order_status'] = array('eq','S');
        $where['sh_status'] = array('eq','N');
        $num = $this -> where($where) -> count();
        return $num;
	}
	/*
	 * 根据订单状态获取当前订单总数
	 * @date: 2016-8-10
	 * @author: yao
	 * @return int
	 */
	public function getNums(){
        $map['verify'] = array('eq','N');
        $map['order_status'] = array('eq','T');
	    $num = $this -> where($map) -> count();
	    return $num;
	}
	/*
	 * 获取待回访订单总数
	 * 
	 */
	public function getVisitNum(){
	    $map['visit'] = array('eq','Y');
	    $map['is_visit'] = array('eq','N');
	    $num = $this -> where($map) -> count();
	    return $num;
	}
	/*
	 * 获取需回单订单总数
	 *
	 */
	public function getReceiptNum(){
	    $map['receipt'] = array('eq','Y');
	    $map['is_hui'] = array('eq','N');
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
	    $order_M = M('order_assistant');
	    $yunDan_M = M('yundan');
	    $wuliu_M = M('wuliu');
	    $user_M = M('user');
	    $position_M=M('position_tracking_record');
	    $verify_M=M('verify_car_info');
	    $verifyImg_M=M('verify_car_img');
	    //写入条件
	    $map['order_code'] = array('eq',$code);
	    //$map['is_del'] = array('eq','N');
	    //查询全部表
		$info = $order_M ->where($map)->find();
		//更改客服查看状态
		$data_ke['kefu_shi'] = 'Y';
		$order_M->where($map)->save($data_ke);
		//查看支付状态 检查支付时间
		/* if($info['pay_status']!='Y'){
		    $difTime=time()-strtotime($info['order_time']);
		    $system=M("system")->find();
		    $numsTime=$system['pay_time']*3600;
		    if($difTime>$numsTime||$info['pay_way']=='H'){
		        $info['pay_status']='H';
		    }
		}else{
		    $info['pay_status']=$info['pay_way'];
		} */
		$info['YunDan'] = $yunDan_M ->where($map)->select();
		//查询是否已提车
		$map_1['order_code'] = array('eq',$code);
		$map_1['yd_type'] = array('eq','A');
		$yd = $yunDan_M ->where($map_1)->find();
		if($yd['status'] == 'Y'){
		    $info['flag'] = 'Y';
		    $info['yd_id'] = $yd['yd_id'];
		}else if($yd['status'] =='N' && $yd['is_del'] == 'N' && $info['order_status'] !="W" && $info['order_status'] !="D"){
		    $info['flag'] = 'N';
		    $info['yd_id'] = $yd['yd_id'];
		}else{
		    $info['flag'] = 'M';
		}
		$payYunMap['order_code']=$code;
		$payYunMap['yd_status']=array("neq",'Y');
		$payYunMap['yd_price']=array("neq",0);
		//$payYunMap['yd_price']=array(array("neq",''),array("neq",0),'or');
		$info['unpaidYunDan']=$yunDan_M ->where($payYunMap)->field("yd_code,yd_name,yd_price")->select();
		$typeArr=array(
		    'A' => '提车',
		    'B' => '提短',
		    'C' => '公司发运',
		    'D' => '个人发运',
		    'E' => '交车'
		);
		if($info['YunDan']){
		    foreach($info['YunDan'] as &$va){
		        $key=$va['yd_type'];
		        $va['yd_type']=$typeArr[$key];
		    }
		}
		$info['unpaidCount']=$yunDan_M ->where($payYunMap)->field("count('yd_id') as nums")->find();
		$info['Wuliu'] = $wuliu_M ->where($map)->select();
		$info['Position']=$position_M ->where($map)->order("time desc")->select();
		$info['Verify']=$verify_M->where($map)->find();
		$info['VerifyImg']=$verifyImg_M ->where($map)->select();
		$yd_type=array(
		    'A' => '提车',
		    'B' => '提短',
		    'C' => '公司发运',
		    'D' => '个人发运',
		    'E' => '交车'
		);
		foreach ($info['Position'] as &$va){
		    $k=$va['yd_type'];
		    $va['yd_type']=$yd_type[$k];
		}
		$maps['tel'] = array('eq',$info['user_code']);
		$info['User'] = $user_M -> where($maps) -> find();
		if ($info['order_info_star']!=""&& $info['order_info_star']!=null){
		    //循环查询地点对应名称
		    $star = explode(",",$info['order_info_star']);
		
		    for ($i=0;$i<count($star);$i++){
		        $mep['area_id'] = array('eq',$star[$i]);
		        $startList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
		    }
		    //存储起始地
		    $info['order_info_stars'] = $startList;
		}else {
		
		    $info['order_info_stars'] = "";
		}
		
		if ($info['order_info_end']!=""&& $info['order_info_end']!=null){
		    //循环查询地点对应名称
		    $end = explode(",",$info['order_info_end']);
		
		    for ($i=0;$i<count($end);$i++){
		        $mep['area_id'] = array('eq',$end[$i]);
		        $endList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
		    }
		    //存储起始地
		    $info['order_info_ends'] = $endList;
		}else {
		
		    $info['order_info_ends'] = "";
		}
		//系统设置 支付时限
		$pay_time=M("system")->field("pay_time")->find();
		$info['pay_time']=$pay_time['pay_time'];
		//查看咨询备注
		if(!empty($info['refer_id'])){
		    $refer=M("refer")->where("tr_id =".$info['refer_id'])->field("tr_bei")->find();
		    if($refer){
		        $info['tr_bei']=(!empty($refer['tr_bei'])) ? $refer['tr_bei'] : '-';
		    }else{
		        $info['tr_bei']='-';
		    }
		}else{
		    $info['tr_bei']='-';
		}
		
		//短信接收人
		if(!empty($info['mess_rec_man'])){
		    $ss = explode(";",$info['mess_rec_man']);
		    $info['mess_rec_mans'] = $ss;
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
	 * 获取财务订单收入列表
	 * @date: 2016-8-15 下午8:38:50
	 * @author: liuxin
	 */
	public function getFinanceList($search='',$startDate='',$endDate='',$code=''){
	    $area_M=M("area");
	    $map[] = '1=1';
	    if($search!=''){
	        $map_['order_code'] = array('like','%'.$search.'%');
	        $map_['fin_yun'] = array('like','%'.$search.'%');
	        $map_['_logic'] = 'or';
	        $map['_complex'] = $map_;
	    }
	    if($startDate!=''&&$endDate!=''){
	        $map['order_time'] = array('between',array($startDate,$endDate));
	    }
	    if($code!=''){
	        $arr=explode(",",$code);
	        $where['order_code']=array('IN',$arr);
	        $Tnum = $this ->  where($where) -> count();
	        $Tlist = $this ->  where($where) ->order("order_time desc")-> select();
	    }else{
	        $Tnum = $this ->  where($map) -> count();
	        $page = set_page($Tnum,10);
	        $Tlist = $this ->  where($map) -> limit($page->limit) ->order("order_time desc")-> select();
	        $data['page'] = $page -> BackPage();
	    }
	    
		foreach ($Tlist as &$info){
		    if ($info['order_info_star']!=""&& $info['order_info_star']!=null){
		        //循环查询地点对应名称
		        $star = explode(",",$info['order_info_star']);
		    
		        for ($i=0;$i<count($star);$i++){
		            $mep['area_id'] = array('eq',$star[$i]);
		            $startList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
		        }
		        //存储起始地
		        $info['order_info_stars'] = $startList;
		    }else {
		    
		        $info['order_info_stars'] = "";
		    }
		    
		    if ($info['order_info_end']!=""&& $info['order_info_end']!=null){
		        //循环查询地点对应名称
		        $end = explode(",",$info['order_info_end']);
		    
		        for ($i=0;$i<count($end);$i++){
		            $mep['area_id'] = array('eq',$end[$i]);
		            $endList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
		        }
		        //存储起始地
		        $info['order_info_ends'] = $endList;
		    }else {
		    
		        $info['order_info_ends'] = "";
		    }
		    //提车费
		    $info['tc'] = $info['order_info_t_car']/100;
		    //送车价
		    $info['sc'] = $info['order_info_s_car']/100;
		    //上门
		    $info['sm'] = $info['order_smsc_car']/100;
		    //集散费
		    $info['js'] =$info['order_info_c_car']/100;
		    //毛利
		    $info['ml'] = $info['order_info_margin']/100;
		    //运输费
		    $info['order_yun_price'] = $info['tc']+$info['sc']+$info['sm']+$info['js']+$info['ml'];
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
	 * 审核
	 */
	public function auditing($data){
	    $order_code=$data['order_code'];
	    $where['order_code']=$order_code;
	    $sh_status=$data['sh_status'];
	    if($sh_status=='Y'){
	        $data['order_status']='A';
	    }
	    $bill_type=$data['bill_type'];
	    //查询数据库系统配置
	    $sys=M("system")->find();
	    if($bill_type=='A'){
	       $data['bill_price']=$data['order_info_zj']*$sys['tar_rate']/100;
	    }else if($bill_type=='B'){
	        $data['bill_price']=$data['order_info_zj']*$sys['vat_rate']/100;
	    }
	    
	    $order=M("order_assistant")->where($where)->find();
	    if($data['bill_price']!=''&&$data['bill_price']!=null){
	        $allMoney=$data['order_info_zj']+$data['bill_price'];
	        $data['order_info_zj']=$allMoney*100;
	        $data['bill_price']=$data['bill_price']*100;
	    }else{
	        $data['order_info_zj']=$data['order_info_zj']*100;
	    }
	    $data['is_hui'] = 'N';
	    $data['mess_rec_man'] = rtrim($data['mess_rec_man'],';');
	    $res=M("order_assistant")->where($where)->save($data);
	    if($res){
	        return true;
	    }else{
	        return false;
	    }
	}
	/**
	 * 添加运单
	 */
	public function addYunDan($data){
	    $Yundan=M("yundan");
	    
	    if($data['order_code']!=''&&$data['order_code']!=null){
	        $add['order_code']=$data['order_code'];
	    }
	    if($data['yd_type']!=''&&$data['yd_type']!=null){
	        $add['yd_type']=$data['yd_type'];
	    }
	    if($data['yd_name']!=''&&$data['yd_name']!=null){
	        $add['yd_name']=$data['yd_name'];
	    }
	    if($data['yd_tel']!=''&&$data['yd_tel']!=null){
	        $add['yd_tel']=$data['yd_tel'];
	    }
	    if($data['yd_indetity']!=''&&$data['yd_indetity']!=null){
	        $add['yd_indetity']=$data['yd_indetity'];
	    }
	    if($data['yd_line']!=''&&$data['yd_line']!=null){
	        $add['yd_line']=$data['yd_line'];
	    }
	   
	    if($data['yd_j_gong']!=''&&$data['yd_j_gong']!=null){
	        $add['yd_j_gong']=$data['yd_j_gong'];
	    }
	    if($data['yd_s_gong']!=''&&$data['yd_s_gong']!=null){
	        $add['yd_s_gong']=$data['yd_s_gong'];
	    }
	    if($data['yd_fy_status']!=''&&$data['yd_fy_status']!=null){
	        $add['yd_fy_status']=$data['yd_fy_status'];
	        $orderMap['order_code']=$data['order_code'];
	        if($data['yd_fy_status']=='A'){
	            $orderData['order_status']='M';
	        }else{
	            $orderData['order_status']='N';
	        }
	        $rs=M("order_assistant")->where($orderMap)->save($orderData);
	    }
	    if($data['yd_mark']!=''&&$data['yd_mark']!=null){
	        $add['yd_mark']=$data['yd_mark'];
	    }
	    if($data['yd_price']!=''&&$data['yd_price']!=null){
	        $add['yd_price']=$data['yd_price']*100;
	    }
	    
	    $add['yd_time']=date("Y-m-d H:i:s",time());
	    $add['is_del'] = 'N';
	    $add['yd_code']=$this->getTablecode('Y');
	    $yd_cover_code=$data['yd_cover_code'];
	    
	     //改变订单状态
	    if($data['order_status']!=''&&$data['order_status']!=null){
	        $orderMap['order_code']=$data['order_code'];
	        if($data['order_status']=='G'){
	            $order=M("order_assistant")->where($orderMap)->find();
	            if($order['order_info_smsc']=='Y'){
	                $data['order_status']='B';
	            }else{
	                $data['order_status']='G';
	            }
	        }
	        $orderData['order_status']=$data['order_status'];
	        $rs=M("order_assistant")->where($orderMap)->save($orderData);
	    }
	    
	    $res=$Yundan->add($add);
	    if($res){
	        if($yd_cover_code!=''&&$yd_cover_code!=null){
	            $add['yd_cover_code']=trim($yd_cover_code,",");
	            $yd_arr=explode(",",$add['yd_cover_code']);
	            print_log("----------------------------".json_encode($yd_arr));
	            foreach ($yd_arr as $k=>$va){
	                $where['yd_code']=array('eq',$va);
	                $change['yd_status']='Y';
	                $change['yd_pay_code'] = $add['yd_code'];
	                $changeStatus=$Yundan->where($where)->save($change);
	            }
	        }
	        return true;
	    }else{
	        return false;
	    }
	}
	/**
	 * 修改运单
	 */
	function editYunDan($data){
	    $Yundan=M("yundan");
	    $yd_id=$data['yd_code'];
	    if(!empty($data['yd_price'])){
	        $data['yd_price']=$data['yd_price']*100;
	    }
	    $where['yd_code']=$yd_id;
	    $res=$Yundan->where($where)->save($data);
	    if($res){
	        return true;
	    }else{
	        return false;
	    }
	}  
    /**
     * 删除
     */
	function delYunDan($yd_code){
	    $map['yd_code']=$yd_code;
	    $data['is_del'] = 'Y';
	    $res=M("yundan")->where($map)->save($data);
	    return $res;
	}
	/**
	 * 添加数据跟踪
	 */
	public function addPosition($data){
	    //获取短信接收人
	    //$phone=M("order_assistant")->where("order_code='".$data['order_code']."'")->field("mess_rec_man")->find();
	   // $phone=$phone['mess_rec_man'];
	    $phone=$data['phone'];
	    $phoneArr = explode(";", $phone);
	    $content=$data['content']."，订单信息每天下午更新（周日除外），下单确认车妥妥唯一官方400电话：400-8771107。";
	    for ($i = 0; $i < count($phoneArr); $i++) {
	        if($phoneArr[$i] != $phoneArr[$i-1]){
	            $res=send_mobile_sms($phoneArr[$i],$content)['status'];
	        }
	    }
	    if($res==0){
	        $data['is_send']='Y';
	    }else{
	        $data['is_send']='N';
	    }
	    $data['time']=date("Y-m-d H:i:s",time());
	    $res=M("position_tracking_record")->add($data);
	    if($res){
	        return true;
	    }else{
	        return false;
	    }
	}
	/**
	 * 修改跟踪发送状态
	 */
	public function editPosition($id,$data){
	    $where['id']=$id;
	    $res=M("position_tracking_record")->where($where)->save($data);
	    return $res;
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
	    $cobj = M('cwgl_log');
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
	/**
	 * 修改订单
	 */
	public function editOrder($data){
	    $OrderAssistant=M("order_assistant");
	    $where['order_code']=$data['order_code'];
	    $order_info_tclxr0=$data['order_info_tclxr0'];
	    $order_info_tclxr1=$data['order_info_tclxr1'];
	    $order_info_tclxr2=$data['order_info_tclxr2'];
	    
	    $order_info_sclxr0=$data['order_info_sclxr0'];
	    $order_info_sclxr1=$data['order_info_sclxr1'];
	    $order_info_sclxr2=$data['order_info_sclxr2'];
	    
	    $order_info=$OrderAssistant->where($where)->field("order_info_zj,order_info_tclxr,order_info_sclxr,order_info_bxd")->find();
	    $order_info_tclxr=explode(",",$order_info['order_info_tclxr']);
	    $order_info_sclxr=explode(",",$order_info['order_info_sclxr']);
	    if($order_info_tclxr0){
	        $data['order_info_tclxr']=$order_info_tclxr0.",".$order_info_tclxr[1].",".$order_info_tclxr[2];
	        unset($data['order_info_tclxr0']);
	    }
	    if($order_info_tclxr1){
	        $data['order_info_tclxr']=$order_info_tclxr[0].",".$order_info_tclxr1.",".$order_info_tclxr[2];
	        unset($data['order_info_tclxr1']);
	    }
	    if($order_info_tclxr2){
	        $data['order_info_tclxr']=$order_info_tclxr[0].",".$order_info_tclxr[1].",".$order_info_tclxr2;
	        unset($data['order_info_tclxr2']);
	    }
	    
	    if($order_info_sclxr0){
	        $data['order_info_sclxr']=$order_info_sclxr0.",".$order_info_sclxr[1].",".$order_info_sclxr[2];
	        unset($data['order_info_sclxr0']);
	    }
	    if($order_info_sclxr1){
	        $data['order_info_sclxr']=$order_info_sclxr[0].",".$order_info_sclxr1.",".$order_info_sclxr[2];
	        unset($data['order_info_tclxr1']);
	    }
	    if($order_info_sclxr2){
	        $data['order_info_sclxr']=$order_info_sclxr[0].",".$order_info_sclxr[1].",".$order_info_sclxr2;
	        unset($data['order_info_tclxr2']);
	    }
	    if($data['bill_price']){
	        $data['bill_price']=$data['bill_price']*100;
	    }
	    if($data['order_info_zj']){
	        print_log("-------------------修改总价");
	        $data['order_info_zj']=$data['order_info_zj']*100;
	    }
	    if($data['policy_code']){
	        $data['policy_code']=C("DOMAINNAME").$data['policy_code'];
	    }
	    if($data['order_info_price'] !=="" && $data['order_info_price'] != null){
	        $order_info_price = $data['order_info_price'];
	        $order_info_bxd = $this->getSecu($order_info_price*10000,"acale_clent");
	        $data['order_info_price']=$order_info_price*100;
	        $data['order_info_bxd'] = $order_info_bxd*100;
	        $order_info_zj=($order_info['order_info_zj']/100)-($order_info['order_info_bxd']/100)+($order_info_bxd);
	        print_log("-----车价格----价格:".$order_info_zj."---------:".$order_info_bxd."----------:");
	        $data['order_info_zj'] = $order_info_zj*100;
	    }
	    $res=$OrderAssistant->where($where)->save($data);
	    if($res){
	        return true;
	    }else{
	        return false;
	    }
	}
	/**
	 * 验车信息
	 */
	function verifyInfo($data){
	   
	    $Ver=M("verify_car_info");
	    $order_code=$data['order_code'];
	    $map['order_code']=$order_code;
	    $is=$Ver->where($map)->select();
	    if($is){
	        $res=$Ver->where($map)->save($data);
	    }else{
	        $data['verify_car_time']=date("Y-m-d H:i:s",time());
	        $data['verify_code']=get_code('tvci');
	        $res=$Ver->add($data);
	    }
	    if($res){
	       
	        return true;
	    }else{
	       
	        return false;
	    }
	}
	/**
	 * 验车图片
	 */
	function verifyImg($data){
	    $verifyImg=M("verify_car_img");
	    $data['verify_img_time']=date("Y-m-d H:i:s",time());
	    $data['verify_img_upload']=C("DOMAINNAME").$data['verify_img_upload'];
	    $data['verify_img_code']=explode(".", substr($data['verify_img_upload'], strrpos($data['verify_img_upload'],"/")+1))[0];
	    $res=$verifyImg->add($data);
	    if($res){
	        return $res;
	    }
	}
	/**
	 * 删除验车照片
	 */
	function delVerImg($data){
	    $verifyImg=M("verify_car_img");
	    $res=$verifyImg->where($data)->delete();
	    if($res){
	        return $res;
	    }
	}
	/**
	 * 订单未收总额
	 */
	function getOrderMoney($start,$end){
	    //订单未支付总费用
	    if($start!=''&&$end!=''){
	        $map['order_time']=array('between',arary($start,$end));
	    }
	    $map['fin_is_yun']!='Y';
	    $orderAllMoney=$this->where($map)->field('SUM(order_info_zj) as allmoney')->find();
	    if($orderAllMoney){
	        return $orderAllMoney['allmoney']/100;
	    }else{
	        return 0;
	    }
	}
	/**
	 * 运单未支付总额
	 */
	function getYunMoney($start,$end){
	    //订单未支付总费用
	    if($start!=''&&$end!=''){
	        $map['yd_time']=array('between',arary($start,$end));
	    }
	    $map['yd_status']!='Y';
	    $orderAllMoney=M("yundan")->where($map)->field('SUM(yd_price) as allmoney')->find();
	    if($orderAllMoney){
	        return $orderAllMoney['allmoney']/100;
	    }else{
	        return 0;
	    }
	}
	/**
	 * 保费未支付总额
	 */
	function getOrderBaoMoney($start,$end){
	    //订单未支付总费用
	    if($start!=''&&$end!=''){
	        $map['order_time']=array('between',arary($start,$end));
	    }
	    $map['fin_is_bao']!='Y';
	    $orderAllMoney=$this->where($map)->field('SUM(order_info_bxd) as allmoney')->find();
	    if($orderAllMoney){
	        return $orderAllMoney['allmoney']/100;
	    }else{
	        return 0;
	    }
	}
	/**
	 * 发票未支付总额
	 */
	function getOrderFaMoney($start,$end){
	    //订单未支付总费用
	    if($start!=''&&$end!=''){
	        $map['order_time']=array('between',arary($start,$end));
	    }
	    $map['fin_is_fa']!='Y';
	    $orderAllMoney=$this->where($map)->field('SUM(bill_price) as allmoney')->find();
	    if($orderAllMoney){
	        return $orderAllMoney['allmoney']/100;
	    }else{
	        return 0;
	    }
	}
	/**
	 * 添加流水号 改变支付状态
	 */
	function changeStatus($table,$status,$liuName,$number,$idName,$id){
	     $where[$idName]=$id;
	     $data[$status]='Y';
	     $data[$liuName]=$number;
	     $res=M($table)->where($where)->save($data);
	     return $res;
	}
	/**
	 * 添加订单流水号，修改状态
	 */
	function upOrderStatus($table,$status,$liuName,$number,$idName,$id){
	    $admin = json_decode(des_decrypt_php(session('master')),true);
	    $where[$idName]=$id;
	    $data[$status]='Y';
	    $data['pay_status'] = 'Y';
	    $data['pay_name'] = $admin['admin_name'];
	    $data[$liuName]=$number;
	    $res=M($table)->where($where)->save($data);
	    return $res;
	}
	/**
	 * 查询司机
	 */
	public function getCarList($proId='',$cityId='',$text=''){
	    if($proId!='N'){
	        $map['car_sheng']=array('eq',$proId);
	    }
	    if($cityId!='N'){
	        $map['car_shi']=array('eq',$cityId);
	    }
	    if($text!='N'){
	        $map['car_name']=array('like','%'.$text.'%');
	    }
	    $list=M("car_header")->where($map)->field("car_name,car_tel,car_identity")->select();
	    return $list;
	}
	/**
	 * 查询物流公司
	 */
	public function getCompanyList($text){
	    $where['lc_short_name']=array("like",'%'.$text.'%');
	    $where['lc_name']=array("like",'%'.$text.'%');
	    $where['_logic'] = 'or';
	    $map['_complex'] = $where;
	    $map[] = '1=1';
	    $list=M("logistics_company")->where($map)->field("lc_name,lc_short_name,lc_gen_tel")->select();
	    return $list;
	}
	/**
	 * 运单完成操作
	 */
	public function completeYunDan($yd_id){
	    $obj = M("yundan");
	    $objs = M("order_assistant");
	    $map['yd_id']=array('eq',$yd_id);
	    $data['status']='Y';
	    $info = $obj->where($map)->find();
	    $res=$obj->where($map)->save($data);
	    $infos = $objs->where(array('order_code'=>$info['order_code']))->find();
	    $us = M("user")->where(array("tel"=>$infos['user_code']))->find();
	    if($res){
	        if($info['yd_type'] == 'A'){
	            $datas['order_status'] = 'Y';
	            $str = "%s先生/女士，您的订单%s，%s到%s， %s（车型）接车顾问%s验车已完成，托运合同已生效，保单会在下午18时统一上传（届时会另行告知），“妥妥保驾护航”行程已开始。";
	            $strs = sprintf($str,
	                $us['user_name'],
	                $infos['order_code'],
	                $this->getPlaceName(explode(",",$infos['order_info_star'])[1]),
	                $this->getPlaceName(explode(',',$infos['order_info_end'])[1]),
	                $infos['order_info_type'],
	                $info['yd_name']);
	            print_log("------------------提车完成:".$strs);
	            $arr = explode(";",$infos['mess_rec_man']);
	            foreach ($arr as $k=>$v){
	                $ret = send_mobile_sms($v,$strs);
	            }
	            if($ret['status']==0){
	                //$data['msg']="发送成功";
	            }else{
	                //$data['msg']="发送失败";
	            }
	            //-----提车完成日志
	            $strsh = "订单%s：司机-%s PC端确认提车";
	            $strshs = sprintf($strsh,$infos['order_code'],$info['yd_name'].'，'.$info['yd_tel']);
	            $cobj = M('log');
	            $datas['admin_code'] = $info['yd_name'];
	            $datas['log_code'] = get_code('tl');
	            $datas['log_time'] = date('Y-m-d H:i:s',time());
	            $datas['log_content'] = $strshs;
	            $datas['log_operation'] = "完成提车";
	            $datas['log_back_cont'] = "-";
	            $ress = $cobj -> add($datas);
	        }
	        $objs->where(array('order_code'=>$info['order_code']))->save($datas);
	    }
	    return $res;
	}
	/**
	 * 将地名code转换成名称
	 * @date: 2016-9-27 下午7:47:20
	 * @author: liuxin
	 * @param string $id
	 * @return 地区名称
	 */
	public function getPlaceName($id=''){
	    //查询
	    $map['area_id'] = array('eq',$id);
	    $data = M('area') -> where($map) -> find();
	    //返回地区名称
	    return $data['area_name'];
	}
	/**
	 * 计算保险费用
	 * @param string $price 车费
	 * @param string $type 类型
	 * @return number
	 */
	public function getSecu($price='',$type=''){
	    //实例化数据库
	    $obj = M('system');
	    //查询
	    $list = $obj->where("id=1") -> find();
	    $per = $list[$type];
	    $fee = ceil($price*$per/100);
	    return $fee;
	}
}