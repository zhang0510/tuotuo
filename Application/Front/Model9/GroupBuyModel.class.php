<?php
namespace Front\Model;
/**
 * @author Administrator
 *
 */
class GroupBuyModel extends BaseModel {
   
	/**
	 * 团购优惠
	 */
	function getGroupBuy(){
		$tsgObj = M("system_group");
		$list = $tsgObj->order('group_star asc')->select();
		return $list;
	}
	
	/**
	 * 获取多个车型及相应价格
	 */
	function getCarTypeData($carType=""){
		$cxObj = M("carxing");
		$ctArr = explode("-", $carType);
		$size = count($ctArr);
		$data=array();
		$price_all = 0;
		$carNum = 0;
		if($size>0){
			for ($i=0;$i<$size;$i++){
				$ctArrInfo = explode(',',$ctArr[$i]);
				$cxMap['cxjj_id'] = array("eq",$ctArrInfo[0]);
				$brandName = $cxObj->where($cxMap)->getField('cxjj_brand');
				$cxMap_['cxjj_id'] = array("eq",$ctArrInfo[1]);
				$cartypeVo = $cxObj->where($cxMap_)->field('cxjj_brand,cxjj_price')->find();
				$data[$i]['car_type_info'] = $ctArr[$i];
				$data[$i]['brand_id'] = $ctArrInfo[0];
				$data[$i]['brand_name'] = $brandName;
				$data[$i]['cartype_id'] = $ctArrInfo[1];
				$data[$i]['cartype_name'] = $cartypeVo['cxjj_brand'];
				$data[$i]['car_num'] = $ctArrInfo[2];
				$data[$i]['car_price'] = $cartypeVo['cxjj_price']/100;
				$data[$i]['car_price_all'] = $ctArrInfo[2]*$cartypeVo['cxjj_price']/100;
				$price_all+=$data[$i]['car_price_all'];
				$carNum += $ctArrInfo[2];
			}
		}
		$list['data'] = $data;
		$list['price_all'] = $price_all;
		$list['carNum'] = $carNum;
		return $list;
	}
	/**
	 * 获取多个车型及相应价格
	 */
	function getCarTypeNum($carType=""){
		$ctArr = explode("-", $carType);
		$size = count($ctArr);
		$carNum = 0;
		if($size>0){
			for ($i=0;$i<$size;$i++){
				$ctArrInfo = explode(',',$ctArr[$i]);
				
				$carNum += $ctArrInfo[2];
			}
		}
		return $carNum;
	}
	/**
	 * 获取目的地省市区信息
	 */
	function getAimCityArea($citycode=""){
		$arr = explode(',',$citycode);
		$map['area_pid'] = array('eq',$arr[1]);
		$obj = M('area');
		$list = $obj -> where($map) -> select();//获取市下的区域信息集合
		$map_['area_id'] = array('eq',$arr[0]);
		$mapcity_['area_id'] = array('eq',$arr[1]);
		$voPro = $obj -> where($map_) ->find();//获取省份信息
		$voCity = $obj -> where($mapcity_) ->find();//获取省份下的市信息
		$data['listArea'] = $list;
		$data['voProvince'] = $voPro;
		$data['voCity'] = $voCity;
		return $data;
	}
	/**
	 * 获取出发地省市区
	 */
	function getStartCityArea($citycode=""){
		$arr = explode(',',$citycode);
		$map['area_id'] = array('eq',$arr[0]);
		$map_['area_id'] = array('eq',$arr[1]);
		$map_s['area_id'] = array('eq',$arr[2]);
		$obj = M('area');
		$data['province'] = $obj->where($map)->find();
		$data['city'] = $obj->where($map_)->find();
		$data['area'] = $obj->where($map_s)->find();
		return $data;
}
//---------------------------------费用计算START---------------------------------------------------
	/**
	 * 提车费用查询
	 */
	function tiCar($ti_star=""){
		$tiObj = M("ti");//提车线路
		$tiMap['ti_star'] = array("eq",$ti_star);
		$vo = $tiObj->where($tiMap)->find();
		return $vo;
	}
	/**
	 * 集散地费用查询
	 */
	function gather($san_star="",$san_end){
		$lsObj = M("line_san");
		$map['san_star'] = array("eq",$san_star);
		$map['san_end'] = array("eq",$san_end);
		$vo = $lsObj->where($map)->find();
		return $vo;
	}
	/**
	 * 目的地费用查询
	 * 送车地 省/市
	 */
	function destination($song_end=""){
		$sObj = M("song");
		$map['song_end']  = array("eq",$song_end);
		$vo = $sObj->where($map)->find();
		return $vo;
	}
	/**
	 * 送车上门费用查询
	 */
	function visit($san_end="",$sm_end=""){
		$smObj = M("sm");
		$map['sm_star']  = array("eq",$san_end);
		$map['sm_end']  = array("eq",$sm_end);
		$vo = $smObj->where($map)->find();
		return $vo;
	}
	
//---------------------------------费用计算END---------------------------------------------------
	/**
	 * 获取区域名称
	 */
	function getcityName($area_id=""){
		$obj = M('area');
		$map_['area_id'] = array('eq',$area_id);
		$vo = $obj->where($map_)->find();
		return $vo;
	}
	/**
	 * 组装输入框
	 */
	function carInputDispose($carType=""){
		print_log("车辆保险全部信息：".$carType);
		$cxObj = M("carxing");
		$ctArr = explode("-", $carType);
		$size = count($ctArr);
		$data=array();
		$price_all = 0;
		if($size>0){
			for ($i=0;$i<$size;$i++){
				$ctArrInfo = explode(',',$ctArr[$i]);
				$sizenum = $ctArrInfo[2];
				for ($h=0;$h<$sizenum;$h++){
					$cxMap['cxjj_id'] = array("eq",$ctArrInfo[0]);
					$brandName = $cxObj->where($cxMap)->getField('cxjj_brand');
					$cxMap_['cxjj_id'] = array("eq",$ctArrInfo[1]);
					$cartypeVo = $cxObj->where($cxMap_)->field('cxjj_brand,cxjj_price')->find();
					$data[$i][$h]['brand_id'] = $ctArrInfo[0];//品牌编号
					$data[$i][$h]['brand_name'] = $brandName;//品牌名称
					$data[$i][$h]['cartype_id'] = $ctArrInfo[1];//车型编号
					$data[$i][$h]['cartype_name'] = $cartypeVo['cxjj_brand'];//车型名称
					$data[$i][$h]['car_price'] = $cartypeVo['cxjj_price']/100;//车型加价
					$data[$i][$h]['car_guzhi'] = $ctArrInfo[3];//单位万元
					$data[$i][$h]['car_yuanbaoxian'] = $ctArrInfo[4]/$sizenum;//单位元
				}
			}
		}
		return $data;
	}
	/**
	 * 优惠金额查询
	 */
	function getFavorableSum($code=""){
		$sgObj = M("system_group");
		$sgMap['group_code'] = array("eq",$code);
		$ret = $sgObj->where($sgMap)->find();
		return $ret;
	}
	
	/**
	 * 记录订单团购
	 */
	function groupOrder($payWay="Z"){
		$orderDateCode=array();
		$userData = json_decode(des_decrypt_php(session("userData")),true);
		$code = md5($userData['user_code']);
		$dataOrder = json_decode(des_decrypt_php(S($code)),true);
		$wlObj = D("Worklwt");
		$feiyong = $wlObj->getPrice($dataOrder['startAddress'],$dataOrder['endAddress']);
		//--------------------------------订单头表信息START--------------------------------------------------
		
		$data['user_code'] = $userData['user_code'];//会员编号
		$data['order_time'] = date('Y-m-d H:i:s',time());//订单生成时间
		$data['order_status'] = "S";//待审核
		$data['pay_status'] = 'W';//未支付
		$data['order_way'] =$dataOrder["extractCarWay"]=="Y"?"X":'S';//小板车/司机
		$data['pay_way'] = $payWay;//支付方式
		$data['user_name'] = $userData['tel'];//当前的登陆人
		//使用的优惠券信息
		$couponticket = $dataOrder['couponticket'];
		$youhui=0;
		if($couponticket!=""){
			$youhui = explode("-", $couponticket)[0];
		}
		$data['yh_mark'] = $youhui;
		//订单类型--团购订单
		
		$data['yh_type']  = "T";
// 		$retT = $this->groupLineAdd($data);
// 		$headId = "";
// 		if($retT['flag']){
// 			$headId = $retT['id'];
// 		}
		$gather_name = $dataOrder['gather_name'];
		$gather_tel = $dataOrder['gather_tel'];
		$gather_code = $dataOrder['gather_code'];
		//发车人联系信息
		$send_name = $dataOrder['send_name'];
		$send_code = $dataOrder['send_code'];
		$send_tel = $dataOrder['send_tel'];
		$this->groupAddCommon($userData['user_code'],$gather_name,$gather_tel,$gather_code,$send_name,$send_code,$send_tel);
		//--------------------------------订单头表信息END--------------------------------------------------
		//--------------------------------订单详情信息START--------------------------------------------------
		//订单明细
		$car_plate_arr = explode(";", $dataOrder["car_plate_num"]);
		$size = count($car_plate_arr);
		$orderDateCode['carCount'] = $size;
		$orderDateCode['total'] = $dataOrder["platelets"];//总价
		if($size>0){
			$FEIYONGall=0;
			//关联code
			$guanliancode="";
			if($size>1){
				$guanliancode = get_code("GL");//关联code
			}
			$obj = M("order");//订单表
			$oiObj = M("order_info");//明细表
			for($i=0;$i<$size;$i++){
				$orderCode = $this->getTablecode("D");//订单号头表
				
				$orderTouMap="1=1";
				$listTou = $obj->where($orderTouMap)->order('order_id desc')->select();
				$order_code = $listTou[0]['order_code'];//头表code
				$oiMap['order_code'] = array("eq",$order_code);
				$oiList = $oiObj->where($oiMap)->order('order_info_id desc')->select();
				$order_info_code = $oiList[0]['order_info_code'];;//头表code
				
				$order_code_linshi = $order_code + 1;
				$data['order_code'] = "0".$order_code_linshi;
				$order_info_code_linshi = $order_info_code + 1;
				
				$datas['order_info_code'] = "0".$order_info_code_linshi;
				
				
				$orderDateCode['touCode'] = $data['order_code'];//$orderCode;
				//$data['order_code'] = $data['order_code'];
				$data['guanliancode'] = $guanliancode;
				$retT = $this->groupLineAdd($data);
				$headId = "";
				if($retT['flag']){
					$headId = $retT['id'];
				}
				$code = $datas['order_info_code'];
				$car_plate = explode("-", $car_plate_arr[$i]);
				$dataInfo['order_code'] = $data['order_code'];
				$dataInfo['order_info_code'] = $code;//订单明细表
				$dataInfo['guanliancode'] = $guanliancode;
				$orderDateCode['infoCode'][] = $code;
				$dataInfo['order_id'] = $headId;
				$dataInfo['order_info_brand'] = $car_plate[0];//车辆品牌
				$dataInfo['order_info_type'] = $car_plate[1];//车辆车系(车型)
				$dataInfo['order_info_price'] = $car_plate[2]*1000000;//车辆估价
				$dataInfo['order_info_bxd'] = $car_plate[3]*100;//车辆保险
				$dataInfo['order_info_add_price'] = $car_plate[4]*100;//车型加价
				$dataInfo['order_info_carmark'] = $car_plate[5];//车辆牌号
				$FEIYONGall= $feiyong['san_price']+$feiyong['ti_price']+$feiyong['so_price']+$feiyong['maoli']+$dataOrder['songcheshangmen']+$car_plate[4]+$car_plate[3];
				if($i==0&&$FEIYONGall>0){
					$FEIYONGall = $FEIYONGall-$dataOrder['tuangouyouhui']-$dataOrder['youhui'];
				}
				$FEIYONGall = $FEIYONGall*100;
				$dataInfo['order_info_zj'] = $FEIYONGall;//$dataOrder["platelets"]*100;//订单总费用
				$dataInfo['order_info_tc'] = 'N';//是否提车
				$dataInfo['order_info_smsc'] = $dataOrder["connectCarWay"];//是否上门送车
	
				$dataInfo['order_info_c_car'] = $feiyong['san_price']*100;//集散地费用
				$dataInfo['order_info_t_car'] = $feiyong['ti_price']*100;//提车费用
				$dataInfo['order_info_s_car'] = $feiyong['so_price']*100;//送车费用
				$dataInfo['order_info_margin'] = $feiyong['maoli']*100;//毛利
				$dataInfo['order_smsc_car'] = $dataOrder['songcheshangmen']*100;//上门送车费
	
				$dataInfo['order_info_star'] = $dataOrder['startAddress'];//起始地
				$dataInfo['order_info_end'] = $dataOrder['endAddress'];//终点
				if($dataOrder['connectArea']!=""){
					$dataInfo['order_info_smscd'] = $dataOrder['endAddress'].','.$dataOrder['connectArea'];//上门送车地
				}
				$dataInfo['order_info_star_address'] = $dataOrder['send_car_address'];//发车详细地址
				$dataInfo['order_info_end_address'] = $dataOrder['gather_car_address'];//收车详细地址
	
				$dataInfo['order_info_remark'] = $dataOrder["remark"];//备注
	
				$dataInfo['order_info_sclxr'] = $dataOrder['gather_name'].','.$dataOrder['gather_code'].','.$dataOrder['gather_tel'];//收车人联系信息
				$dataInfo['order_info_tclxr'] = $dataOrder['send_name'].','.$dataOrder['send_code'].','.$dataOrder['send_tel'];//发车人联系信息
				$this->groupLineInfoAdd($dataInfo);
			}
		}
		//--------------------------------订单详情信息END--------------------------------------------------
		return $orderDateCode;
	}
	/**
	 * 常用联系人管理
	 */
	function groupAddCommon($userCode="",$gather_name="",$gather_tel="",$gather_code="",$send_name="",$send_code="",$send_tel=""){
		$lmObj = M("linkman");
		$lmMap['link_name'] = array("eq",$gather_name);
		$lmMap['link_tel'] = array("eq",$gather_tel);
		$lmMap['link_num'] = array("eq",$gather_code);
		$lmMap['user_code'] = array("eq",$userCode);
		
		$lmMap_['link_name'] = array("eq",$send_name);
		$lmMap_['link_tel'] = array("eq",$send_tel);
		$lmMap_['link_num'] = array("eq",$send_code);
		$lmMap_['user_code'] = array("eq",$userCode);
		$ret = $lmObj->where($lmMap)->find();
		if(!$ret){
			$data['link_name'] = $gather_name;
			$data['link_tel'] = $gather_tel;
			$data['link_num'] = $gather_code;
			$data['user_code'] = $userCode;
			$data['link_code'] = get_code("LM");
			$lmObj->add($data);
		}
		$ret_ = $lmObj->where($lmMap_)->find();
		if(!$ret_){
			$data['link_name'] = $send_name;
			$data['link_tel'] = $send_tel;
			$data['link_num'] = $send_code;
			$data['user_code'] = $userCode;
			$data['link_code'] = get_code("LM");
			$lmObj->add($data);
		}
	}
	/**
	 * 常用联系人
	 */
	function getGroupAddCommon($userCode=""){
		$lmMap['user_code'] = array("eq",$userCode);
		$lmObj = M("linkman");
		$list = $lmObj->where($lmMap)->select();
		$size = count($list);
		if($size>0){
			for ($i=0;$i<$size;$i++){
				$mam_code = $list[$i]['link_num'];
				$list[$i]['link_num_code'] = substr($mam_code,0,4)."****".substr($mam_code,-4);
				
			}
		}
		return $list;
	}
	
	/**
	 * 团购头表添加
	 * @param string $data
	 */
	function groupLineAdd($data=null){
		$orObj = M("order");
		$ret = $orObj->add($data);
		if($ret){
			$data['flag'] = true;
			$data['id'] = $ret;
			return true;
		}else{
			$data['flag'] = false;
			return false;
		}
	}
	/**
	 * 团购明细添加
	 * @param string $data
	 */
	function groupLineInfoAdd($data=null){
		$orObj = M("order_info");
		$ret = $orObj->add($data);
		if($ret){
			return true;
		}else{
			return false;
		}
	}
}