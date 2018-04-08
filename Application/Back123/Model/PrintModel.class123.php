<?php
namespace Back\Model;

class PrintModel extends BaseModel{
    //运车服务合同
    public function printPact($order_code){
        //初始化数据表.. 一堆表..嗯..
        $orderInfo_M = M('order_info');
        $carInfo_M = M('verify_car_info');
        $carImg_M = M('verify_car_img');
        $area_M = M('area');
        $yunda_M = M('yundan');
		$order = M('order');
		$ORDERmAP['order_code'] = array('eq',$order_code);
		$vossss = $order->where($ORDERmAP)->find();
		$result['order_code'] = $order_code;
        //写入条件
        $map['order_code'] = array('eq',$order_code);
        //然后开始... 查查查！！！
		//提车方式
		$result['orderway']=null;
		if($vossss['order_way']=="S"){
			$result['orderway'] = "司机";
		}else if($vossss['order_way']=="S"){
			$result['orderway'] = "板车";
		}else{
			$result['orderway'] = "司机";
		}
		$result['ordersmsc']=null;
        //查询订单信息表
        $orderinfovo = $orderInfo_M ->where($map)->find();
		$orderinfovo['order_info_price'] = $orderinfovo['order_info_price']/1000000;
		$orderinfovo['order_info_c_car'] = ($orderinfovo['order_info_zj']-$orderinfovo['order_info_bxd'])/100;
		$orderinfovo['order_info_bxd'] = $orderinfovo['order_info_bxd']/100;
		$orderinfovo['order_info_brand_type'] = $orderinfovo['order_info_brand']."-".$orderinfovo['order_info_type'];
		//$orderinfovo['order_info_zj'] = $orderinfovo['order_info_c_car']+$orderinfovo['order_info_bxd'];
		$result['orderInfo'] = $orderinfovo;
		//送车方式
		if($orderinfovo['order_info_smsc']=="Y"){
			$result['ordersmsc'] = "送车上门";
		}else if($orderinfovo['order_info_smsc']=="N"){
			$result['ordersmsc'] = "自提";
		}else{
			$result['ordersmsc'] = "自提";
		}
		
        //查询验车服务信息表
        $result['carInfo'] = $carInfo_M ->where($map)->find();
        //查询验车服务图片表
        $result['carImg'] = $imgsvo = $carImg_M ->where($map)-> order('verify_img_type asc') -> select();
		$sizes = count($imgsvo);
		//特别说明
		$result['tebie'] =null;
		if($sizes>7){
			$result['tebie'] = $imgsvo[$sizes-1]['verify_img_describe'];
		}
        //查询运单表
        $result['yundan'] = $yunda_M ->where($map)->find();
        //切割运输时间
        $o_Time = explode(" ",$vossss['order_time']);//$result['yundan']['yd_j_time']);
        $result['yundan']['yd_j_time'] = explode("-",$o_Time[0]);
        //获取起始地参数
        $star = explode(",",$result['orderInfo']['order_info_star']);
        //查询起始地名称(省)
        $map['area_id'] = array('eq',$star[0]);
        $startList= $area_M -> where($map)->field('area_name')->find();
        //存储起始地
        $result['orderInfo']['order_info_star']=implode($startList);
		//查询起始地名称(市)
        $mapcity['area_id'] = array('eq',$star[1]);
        $startList_city= $area_M -> where($mapcity)->field('area_name')->find();
        //存储起始地
        $result['orderInfo']['order_info_star_city']=implode($startList_city);
        //获取结束地参数
        $end = explode(",",$result['orderInfo']['order_info_end']);
        //查询起始地名称(省)
        $map['area_id'] = array('eq',$end[0]);
        $endList= $area_M -> where($map)->field('area_name')->find();
        //存储结束地
        $result['orderInfo']['order_info_end']=implode($endList);
		//查询起始地名称(市)
        $map_city_end['area_id'] = array('eq',$end[1]);
        $endList_city_end= $area_M -> where($map_city_end)->field('area_name')->find();
        //存储结束地
        $result['orderInfo']['order_info_end_city']=implode($endList_city_end);
        //拆分提车联系信息
        $result['orderInfo']['order_info_tclxr'] = explode(",", $result['orderInfo']['order_info_tclxr']);
        //拆分送车联系信息
        $result['orderInfo']['order_info_sclxr'] = explode(",", $result['orderInfo']['order_info_sclxr']);
		print_log("--总费用:--".$result['orderInfo']['order_info_zj']);
        if ($result['orderInfo']['order_info_zj']!=""&&$result['orderInfo']['order_info_zj']!=0){
            //服务费用处理
            $number = str_split($result['orderInfo']['order_info_zj']);
			print_log("--总11111111111费用:--".json_encode($number));
            $num = count($number);
			print_log("--总2222222费用:--".$num);
            switch ($num){
                case 1 :
                    $result['orderInfo']['number'][0] = $this->print_Total($number[0]);
                    $result['orderInfo']['number'][1] = "";
                    $result['orderInfo']['number'][2] = "";
                    $result['orderInfo']['number'][3] = "";
                    $result['orderInfo']['number'][4] = "";
                    $result['orderInfo']['number'][5] = "";
                    break;
                case 2 :
                    $result['orderInfo']['number'][0] = $this->print_Total($number[0]);
                    $result['orderInfo']['number'][1] = $this->print_Total($number[1]);
                    $result['orderInfo']['number'][2] = "";
                    $result['orderInfo']['number'][3] = "";
                    $result['orderInfo']['number'][4] = "";
                    $result['orderInfo']['number'][5] = "";
                    break;
                case 3 :
                    $result['orderInfo']['number'][0] = $this->print_Total($number[0]);
                    $result['orderInfo']['number'][1] = $this->print_Total($number[1]);
                    $result['orderInfo']['number'][2] = $this->print_Total($number[2]);
                    $result['orderInfo']['number'][3] = "";
                    $result['orderInfo']['number'][4] = "";
                    $result['orderInfo']['number'][5] = "";
                    break;
                case 4 :
                    $result['orderInfo']['number'][0] = $this->print_Total($number[0]);
                    $result['orderInfo']['number'][1] = $this->print_Total($number[1]);
                    $result['orderInfo']['number'][2] = $this->print_Total($number[2]);
                    $result['orderInfo']['number'][3] = $this->print_Total($number[3]);
                    $result['orderInfo']['number'][4] = "";
                    $result['orderInfo']['number'][5] = "";
                    break;
                case 5 :
                    $result['orderInfo']['number'][0] = $this->print_Total($number[0]);
                    $result['orderInfo']['number'][1] = $this->print_Total($number[1]);
                    $result['orderInfo']['number'][2] = $this->print_Total($number[2]);
                    $result['orderInfo']['number'][3] = $this->print_Total($number[3]);
                    $result['orderInfo']['number'][4] = $this->print_Total($number[4]);
                    $result['orderInfo']['number'][5] = "";
                    break;
                case 6 :
                    $result['orderInfo']['number'][0] = $this->print_Total($number[0]);
                    $result['orderInfo']['number'][1] = $this->print_Total($number[1]);
                    $result['orderInfo']['number'][2] = $this->print_Total($number[2]);
                    $result['orderInfo']['number'][3] = $this->print_Total($number[3]);
                    $result['orderInfo']['number'][4] = $this->print_Total($number[4]);
                    $result['orderInfo']['number'][5] = $this->print_Total($number[5]);
                    break;
                default:
                    print_log("总价数据异常!");
                    break;
            }
        }else {
            $result['orderInfo']['number'][0] = "零";
            $result['orderInfo']['number'][1] = "零";
            $result['orderInfo']['number'][2] = "零";
            $result['orderInfo']['number'][3] = "零";
            $result['orderInfo']['number'][4] = "零";
            $result['orderInfo']['number'][5] = "零";
        }
        //写入标题
        $result['print_Title'] = "车妥妥服务合同";
		print_log("合同打印:".json_encode($result));
        return $result;
    }
    
    //查询运车承运底单
    public function printKept($order_code,$yd_code){
        $result=null;
        //初始化数据表.. 一堆表..嗯..
        $orderInfo_M = M('order_info');
        $yunda_M = M('yundan');
        $carInfo_M = M('verify_car_info');
        $area_M = M('area');

        //写入条件
        $map['order_code'] = array('eq',$order_code);
        
        //查询订单信息表
        $orderInfo = $orderInfo_M ->where($map)->find();
        
        //查询验车服务信息表
        $carInfo = $carInfo_M ->where($map)->find();
        $mapyd['order_code'] = array('eq',$order_code);
		$mapyd['yd_code'] = array('eq',$yd_code);
        //查询运单表
        $yundan = $yunda_M ->where($mapyd)->find();
        $result['yd_code'] = $yd_code;
        //承运公司名称
        $result['yd_company'] = $this-> trim_Str($yundan['yd_company'], "str");
        
        //承运车辆车牌号
        $result['yd_carmark'] = $this-> trim_Str($yundan['yd_carmark'], "str");
        
        //承运人名称
        $result['yd_name'] = $this-> trim_Str($yundan['yd_name'], "str");
        
        //承运人电话
        $result['yd_tel'] = $this-> trim_Str($yundan['yd_tel'], "str");
        
        //承运人证件号
        $result['yd_indetity'] = $this-> trim_Str($yundan['yd_indetity'], "str");
        
        //切割运输时间
        $result['yd_j_time'] = $this -> trim_Str($yundan['yd_time'],"arr_time");
        
        //汽车品牌
        $result['brand'] = $this -> trim_Str($orderInfo['order_info_brand'], "str").'-'.$this -> trim_Str($orderInfo['order_info_type'], "str");
        
        //车牌号
        $result['carmark'] = $this -> trim_Str($orderInfo['order_info_carmark'], "str");
        
        //获取起始地参数
        //$result['star'] = $this->trim_Str($yundan['yd_star'],"str");
		
        
		$starss = explode(",", $orderInfo["order_info_star"]);
		$endss = explode(",", $orderInfo["order_info_end"]);
        if ($starss[0]!=""){ 
            $mapf['area_id'] = array('eq',$starss[0]);
			$earObjf = $area_M -> where($mapf)->field('area_name')->find();
            $result['star'] = $earObjf['area_name'];
            //存储起始地
        }else {
            $result['star'] = "";
            //$star_address=   "";
        }
		
        
        //获取结束地参数
        //$result['end'] = $this->trim_Str($yundan['yd_end'],"str");
		
        //$endList = array();
        if ($endss[0]!=""){
            $maps['area_id'] = array('eq',$endss[0]);
			$earObjs = $area_M -> where($maps)->find();
            $result['end'] = $earObjs['area_name'];
        }else {
            $result['end']= "";
            //$end_address =  "";
        }
        
        //承运线路
        $result['line'] = $this->trim_Str($yundan['yd_star'],"str")." 到  ".$this->trim_Str($yundan['yd_end'],"str");
        
        //车钥匙
        $result['car_key'] = $this->trim_Str($carInfo['verify_car_keys'],"str");
        
        //备胎
        $result['car_tire'] = $this->trim_Str($carInfo['verify_spare_tire'],"str");
        
        //工具包
        $result['car_kit'] = $this->trim_Str($carInfo['verify_tool_kit'],"str");
        
        //千斤顶
        $result['car_jack'] = $this->trim_Str($carInfo['verify_lifting_jack'],"str");
        
        //脚垫
        $result['car_mat'] = $this->trim_Str($carInfo['verify_door_mat'],"str");
        
        //公里数
        $result['car_km'] = $this->trim_Str($carInfo['verify_km'],"str");
        
        //说明书
        $result['car_instructions'] = $this->trim_Str($carInfo['verify_instructions'],"str");
        
        //警示牌
        $result['car_sign'] = $this->trim_Str($carInfo['verify_warning_sign'],"str");
        
        //点烟器
        $result['car_lighter'] = $this->trim_Str($carInfo['verify_lighter'],"str");
        
        //灭火器
        $result['extinguisher'] = $this->trim_Str($carInfo['verify_fire_extinguisher'],"str");
        
        //代收货款
        if($yundan['yd_price']!="" && $yundan['yd_price']!=null){
            $number = str_split($yundan['yd_price']/100);
			print_log("---运单价格----：".json_encode($number));
            $num = count($number);
            switch ($num){
                case 1:
                    $result['number'][0] = "零";
                    $result['number'][1] = "零";
                    $result['number'][2] = "零";
                    $result['number'][3] = "零";
                    $result['number'][4] = $this->print_Total($number[0]);
                    break;
                case 2:
                    $result['number'][0] = "零";
                    $result['number'][1] = "零";
                    $result['number'][2] = "零";
                    $result['number'][3] = $this->print_Total($number[0]);
                    $result['number'][4] = $this->print_Total($number[1]);
                    break;
                case 3:
                    $result['number'][0] = "零";
                    $result['number'][1] = "零";
                    $result['number'][2] = $this->print_Total($number[0]);
                    $result['number'][3] = $this->print_Total($number[1]);
                    $result['number'][4] = $this->print_Total($number[2]);
                    break;
                case 4:
                    $result['number'][0] = "零";
                    $result['number'][1] = $this->print_Total($number[0]);
                    $result['number'][2] = $this->print_Total($number[1]);
                    $result['number'][3] = $this->print_Total($number[2]);
                    $result['number'][4] = $this->print_Total($number[3]);
					//print_log("------运单金额转换-----：".json_encode($result['number']));
                    break;
                case 5:
                    $result['number'][0] = $this->print_Total($number[0]);
                    $result['number'][1] = $this->print_Total($number[1]);
                    $result['number'][2] = $this->print_Total($number[2]);
                    $result['number'][3] = $this->print_Total($number[3]);
                    $result['number'][4] = $this->print_Total($number[4]);
                    break;
            }
            
        }else{
            $result['number'][0]="零";
            $result['number'][1]="零";
            $result['number'][2]="零";
            $result['number'][3]="零";
            $result['number'][4]="零";
        }
        
        //打印标题
        $result['print_Title'] = "车妥妥承运底单";
        print_log("承运底单信息：".json_encode($result));
        //返回结果集
        return $result;
    }
    
    //查询运车提车单
    public function printAskToGet($order_code){
        
        //初始化数据表.. 一堆表..嗯..
        $order_M = M('order');
        $orderInfo_M = M('order_info');
        $yunda_M = M('yundan');
        $carHeader_M = M('car_header');
        $car = M('car_order');
		$sss['order_code'] = array('eq',$order_code);
		$caoVo = $car->where($sss)->find();
		$result['carcode'] = $caoVo['car_order_code'];
        //写入条件
        $map['order_code'] = array('eq',$order_code);
        
        //查询订单表
        $order = $order_M ->where($map)->find();
        
        //查询订单信息表
        $orderInfo = $orderInfo_M ->where($map)->find();
        
        //查询运单表
        $yundan = $yunda_M ->where($map)->find();
        $result['tebie'] = $yundan['yd_mark'];
        //写入条件
        $map['car_code'] = array('eq',$order['car_code']);
        
        //提车员订单
        $carHeader = $carHeader_M -> where($map)->find();
        
        //切割运输时间
        $result['yd_j_time'] = $this -> trim_Str($caoVo['car_jc_time'],"arr_time");        
        
        //提车员名称
        $result['name'] = $this -> trim_Str($carHeader['car_name'],"str");
        
        //提车员电话
        $result['tel'] = $this -> trim_Str($carHeader['car_tel'],"str");
        
        //提车员证件
        $result['identity'] = $this -> trim_Str($carHeader['car_identity'],"str");
        
        //提车人联系信息 
        $result['tclxr'] = $this -> trim_Str($orderInfo['order_info_tclxr'], "arr_info");

        //发车人地址 
        $result['address'] = $this -> trim_Str($orderInfo['order_info_star_address'], "str");
        
        //汽车品牌
        $result['brand'] = $this -> trim_Str($orderInfo['order_info_brand'], "str")."-".$this -> trim_Str($orderInfo['order_info_type'], "str");
        
        //车牌号
        $result['carmark'] = $this -> trim_Str($orderInfo['order_info_carmark'], "str");
        
        //打印标题
        $result['print_Title']="车妥妥提车单";
        
        //费用数字转文字处理
        if($caoVo['car_order_price']!="" && $caoVo['car_order_price']!=null){
            $number = str_split($caoVo['car_order_price']);
            $num = count($number);
            switch ($num){
                case 1:
                    $result['number'][0] = $this->print_Total($number[0]);
                    $result['number'][1] = "零";
                    $result['number'][2] = "零";
                    $result['number'][3] = "零";
                    $result['number'][4] = "零";
                    $result['number'][5] = "零";
                    $result['number'][6] = "零";
                    $result['number'][7] = "零";
                    $result['number'][8] = "零";
                    break;
                case 2:
                    $result['number'][0] = $this->print_Total($number[1]);
                    $result['number'][1] = $this->print_Total($number[0]);
                    $result['number'][2] = "零";
                    $result['number'][3] = "零";
                    $result['number'][4] = "零";
                    $result['number'][5] = "零";
                    $result['number'][6] = "零";
                    $result['number'][7] = "零";
                    $result['number'][8] = "零";
                    break;
                case 3:
                    $result['number'][0] = $this->print_Total($number[2]);
                    $result['number'][1] = $this->print_Total($number[1]);
                    $result['number'][2] = $this->print_Total($number[0]);
                    $result['number'][3] = "零";
                    $result['number'][4] = "零";
                    $result['number'][5] = "零";
                    $result['number'][6] = "零";
                    $result['number'][7] = "零";
                    $result['number'][8] = "零";
                    break;
                case 4:
                    $result['number'][0] = $this->print_Total($number[3]);
                    $result['number'][1] = $this->print_Total($number[2]);
                    $result['number'][2] = $this->print_Total($number[1]);
                    $result['number'][3] = $this->print_Total($number[0]);
                    $result['number'][4] = "零";
                    $result['number'][5] = "零";
                    $result['number'][6] = "零";
                    $result['number'][7] = "零";
                    $result['number'][8] = "零";
                    break;
                case 5:
                    $result['number'][0] = $this->print_Total($number[4]);
                    $result['number'][1] = $this->print_Total($number[3]);
                    $result['number'][2] = $this->print_Total($number[2]);
                    $result['number'][3] = $this->print_Total($number[1]);
                    $result['number'][4] = $this->print_Total($number[0]);
                    $result['number'][5] = "零";
                    $result['number'][6] = "零";
                    $result['number'][7] = "零";
                    $result['number'][8] = "零";
                    break;
                case 6:
                    $result['number'][0] = $this->print_Total($number[5]);
                    $result['number'][1] = $this->print_Total($number[4]);
                    $result['number'][2] = $this->print_Total($number[3]);
                    $result['number'][3] = $this->print_Total($number[2]);
                    $result['number'][4] = $this->print_Total($number[1]);
                    $result['number'][5] = $this->print_Total($number[0]);
                    $result['number'][6] = "零";
                    $result['number'][7] = "零";
                    $result['number'][8] = "零";
                    break;
                case 7:
                    $result['number'][0] = $this->print_Total($number[6]);
                    $result['number'][1] = $this->print_Total($number[5]);
                    $result['number'][2] = $this->print_Total($number[4]);
                    $result['number'][3] = $this->print_Total($number[3]);
                    $result['number'][4] = $this->print_Total($number[2]);
                    $result['number'][5] = $this->print_Total($number[1]);
                    $result['number'][6] = $this->print_Total($number[0]);
                    $result['number'][7] = "零";
                    $result['number'][8] = "零";
                    break;
                case 8:
                    $result['number'][0] = $this->print_Total($number[7]);
                    $result['number'][1] = $this->print_Total($number[6]);
                    $result['number'][2] = $this->print_Total($number[5]);
                    $result['number'][3] = $this->print_Total($number[4]);
                    $result['number'][4] = $this->print_Total($number[3]);
                    $result['number'][5] = $this->print_Total($number[2]);
                    $result['number'][6] = $this->print_Total($number[1]);
                    $result['number'][7] = $this->print_Total($number[0]);
                    $result['number'][8] = "零";
                    break;
                case 9:
                    $result['number'][0] = $this->print_Total($number[8]);
                    $result['number'][1] = $this->print_Total($number[7]);
                    $result['number'][2] = $this->print_Total($number[6]);
                    $result['number'][3] = $this->print_Total($number[5]);
                    $result['number'][4] = $this->print_Total($number[4]);
                    $result['number'][5] = $this->print_Total($number[3]);
                    $result['number'][6] = $this->print_Total($number[2]);
                    $result['number'][7] = $this->print_Total($number[1]);
                    $result['number'][8] = $this->print_Total($number[0]);
                    break;
            }
        
        }else{
            $result['number'][0]="零";
            $result['number'][1]="零";
            $result['number'][2]="零";
            $result['number'][3]="零";
            $result['number'][4]="零";
            $result['number'][5]="零";
            $result['number'][6]="零";
            $result['number'][7]="零";
            $result['number'][8]="零";
        }
        //返回值
        return $result;
    }
    
    //替换数字为汉字
    public function print_Total($num){
        switch ($num){
            case "0" :
                $aa = "零";
                break;
            case "1" :
                $aa = "壹";
                break;
            case "2" :
                $aa = "贰";
                break;
            case "3" :
                $aa = "叁";
                break;
            case "4" :
                $aa = "肆";
                break;
            case "5" :
                $aa = "伍";
                break;
            case "6" :
                $aa = "陸";
                break;
            case "7" :
                $aa = "柒";
                break;
            case "8" :
                $aa = "捌";
                break;
            case "9" :
                $aa = "玖";
                break;
        }
        return $aa;
    }
    
    //填充字段
    public function trim_Str($str,$type){
        switch ($type){
            case "str":
                if($str!=""&&$str!=null){
                
                }else{
                    $str="";
                }
                break;
            case "arr_time":
                if($str!=""&&$str!=null){
                    $str_Time = explode(" ",$str);
                    $str = explode("-",$str_Time[0]);
                }else{
                    $str[0]="";
                    $str[1]="";
                    $str[2]="";
                }
                break;
            case "arr_info":
                if($str!=""&& $str!=null){
                    $str = explode(",",$str);
                }else{
                    $str[0]="";
                    $str[1]="";
                    $str[2]="";
                }
                break;
        }
        return $str;
    }
}