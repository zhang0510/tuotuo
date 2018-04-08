<?php
namespace Front\Model;
class OrderModel extends BaseModel{
    /**
     * 获取上门送车信息
     * @date: 2016-9-7 上午8:41:05
     * @author: liuxin
     * @param string $start 上门送车始发地
     * @param string $end   终点
     * @return Ambigous <\Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
     */
    public function getVisit($start='',$end=''){
        $obj = M('sm');
        $map['sm_star'] = array('eq',$start);
        $map['sm_end'] = array('eq',$end);
        $list = $obj -> where($map) -> find();
        return $list;
    }
    /**
     * 生成订单
     * @date: 2016-9-7 上午8:42:00
     * @author: liuxin
     * @param unknown $order 包含下单信息的数组
     * @param unknown $arrH 向订单头表写入信息的数组
     * @param unknown $arrI 向订单详情页写入信息的数组
     * @param unknown $user 用户信息
     * @return string|boolean
     */
    public function geQuickOrder($order,$arrH,$arrI,$user){
        $obj = M('order');
        $iobj = M('order_info');
        $cobj = M('favorable');
        
        $arrH['order_code'] = $this->getTablecode('D');//get_code('to');
        $res = $obj -> add($arrH);
        if($res){
            $arrI['order_code'] = $arrH['order_code'];
            $arrI['order_info_code'] = $this->getTablecode('M');;
            $arrI['order_id'] = $res;
            $ress = $iobj -> add($arrI);
            if($ress){
                if($order['coupon']!=''){
                    $now = date('Y-m-d H:i:s',time());
                    $map['fav_startime'] = array('lt',$now);
                    $map['fav_endtime'] = array('gt',$now);
                    $map['fav_code'] = array('eq',$order['coupon']);
                    $info = $cobj -> where($map) -> find();
                    if($info['fav_left']>1){
                        $cres = $cobj -> where($map) -> setDec('fav_left');
                        if($cres){
                            $this -> checkLink($user['user_code'], $order['name'], $order['phone'], $order['fiden']);
                            $this -> checkLink($user['user_code'], $order['sname'], $order['sphone'], $order['siden']);
                            //return $arrH['order_code'].'-'.$arrI['order_info_code'];
                            return $res;
                        }else{
                            return false;
                        }
                    }else if($info['fav_left']==1){
                        $data['fav_left'] = 0;
                        $data['fav_flag'] = 'N';
                        $data['fav_status'] = 'Y';
                        $cres = $cobj -> where($map) -> save($data);
                        if($cres){
                            $this -> checkLink($user['user_code'], $order['name'], $order['phone'], $order['fiden']);
                            $this -> checkLink($user['user_code'], $order['sname'], $order['sphone'], $order['siden']);
                            //return $arrH['order_code'].'-'.$arrI['order_info_code'];
                            return $res;
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    }
                }else{
                    $this -> checkLink($user['user_code'], $order['name'], $order['phone'], $order['fiden']);
                    $this -> checkLink($user['user_code'], $order['sname'], $order['sphone'], $order['siden']);
                    //return $arrH['order_code'].'-'.$arrI['order_info_code'];
                    return $arrH['order_code'];
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     * 检查并写入关联联系人
     * @date: 2016-9-7 上午8:43:14
     * @author: liuxin
     * @param unknown $userCode 用户code
     * @param unknown $name 联系人名
     * @param unknown $phone    联系电话
     * @param unknown $ide  身份证号
     */
    public function checkLink($userCode,$name,$phone,$ide){
        $lobj = M('linkman');
        $map['user_code'] = array('eq',$userCode);
        $map['link_name'] = array('eq',$name);
        $data['link_name'] = $name;
        $data['link_tel'] = $phone;
        $data['link_num'] = $ide;
        $data['link_code'] = get_code('tl');
        $data['user_code'] = $userCode;
        $res = $lobj -> where($map) -> find();
        if(!$res){
            $lobj -> add($data);
        }
    }
    public function getAreaName($str=''){
        $arr = explode(',',$str);
        $num = count($arr);
        $name = '';
        $obj = M('area');
        for($i=0;$i<num;$i++){
            $map['area_id'] = array('eq',$arr[i]);
            $info = $obj -> where($map) -> find();
            $name.='-'.$info['area_name']; 
        }
        $name = trim($name,'-');
        return $name;
    }
    /**
     * 
     * @param string $areaName
     * @return string
     */
    function getcityId($areaName=""){
    	$str="";
    	$obj = M("area");
    		$arr = explode("-", $areaName);
    		$size = count($arr);
    		if($size > 0){
    			for ($i=0;$i<$size;$i++){
	    			$map['area_name'] = array("eq",$arr[$i]);
	    			if($i==0){
		    			$voo = $obj->where($map)->field('area_id,min(area_id)')->group('area_name')->select();
		    			$vo = $voo[0];
	    			}else if($i==1){
	    				$voo = $obj->where($map)->field('area_id,max(area_id)')->group('area_name')->select();
	    				$vo = $voo[0];
	    			}else{
	    				$vo = $obj->where($map)->find();
	    			}
	    			$str =$str.",".$vo['area_id'];
    			}
    		}
    		$str = substr($str,1);
    	return $str;
    }
}