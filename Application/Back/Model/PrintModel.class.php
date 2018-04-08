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
    public function printKept($yd_code){
        $result=null;
        //初始化数据表.. 一堆表..嗯..
        $yunda_M = M('yundan');
        $carInfo_M = M('verify_car_info');
        $area_M = M('area');
        $order_M =M('order_assistant');
        $img_M= M('verify_car_img');
        //写入条件
        $map['yd_code'] = array('eq',$yd_code);
        $yunData=$yunda_M->where($map)->select();
        foreach ($yunData as &$va){
            $va['yd_price']=$va['yd_price']/100;
            $where['order_code']=$va['order_code'];
            $orderData=$order_M ->where($where)->find();
            $va['order_info_type']=$orderData['order_info_type'];
            $va['order_info_carmark']=$orderData['order_info_carmark'];
            $order_info_sclxr=explode(",",$orderData['order_info_sclxr']);
            $va['order_info_sclxr0']=$order_info_sclxr[0];
            $va['order_info_sclxr1']=$order_info_sclxr[1];
            $va['order_info_sclxr2']=$order_info_sclxr[2];
            $payArr=explode(",",$va['yd_cover_code']);
            $PayMap['yd_code']=array("IN",$payArr);
            $payMoney=$yunda_M ->where($PayMap)->field("SUM('yd_price') as pay")->find();
            $va['payMoney']=$payMoney['pay']/100;
            $imgMap['order_code']=$va['order_code'];
            $imgs=$img_M ->where($imgMap)->select();
            $str='';
            foreach ($imgs as $vo){
                $str.=$vo['verify_img_code'].',';
            }
            $str=trim($str,",");
            $va['imgsCode']=$str;
            $yanMap['order_code']=$va['order_code'];
            $yanData=$carInfo_M ->where($yanMap)->find();
            $va['yanData']=$yanData;
        }
        
        
        //打印标题
        $result['print_Title'] = "车妥妥承运底单";
        $result['list']=$yunData;
        print_log("承运底单信息：".json_encode($result));
        //返回结果集
        return $result;
    }
    //打印合同
    public function printContract($order_code){
        $order_M =M('order_assistant');
        $verify_M =M('verify_car_info');
        $area_M =M('area');
        $map['order_code']=$order_code;
        $orderInfo=$order_M->where($map)->find();
        if ($orderInfo['order_info_star']!=""&& $orderInfo['order_info_star']!=null){
            //循环查询地点对应名称
            $star = explode(",",$orderInfo['order_info_star']);
        
            for ($i=0;$i<count($star);$i++){
                $mep['area_id'] = array('eq',$star[$i]);
                $startList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
            }
            //存储起始地
            $orderInfo['order_info_stars'] = $startList[1];
        }else {
        
            $orderInfo['order_info_stars'] = "";
        }
        
        if ($orderInfo['order_info_end']!=""&& $orderInfo['order_info_end']!=null){
            //循环查询地点对应名称
            $end = explode(",",$orderInfo['order_info_end']);
        
            for ($i=0;$i<count($end);$i++){
                $mep['area_id'] = array('eq',$end[$i]);
                $endList[$i] = implode($area_M -> where($mep)->field('area_name')->find());
            }
            //存储起始地
            $orderInfo['order_info_ends'] =$endList[1];
        }else {
        
            $orderInfo['order_info_ends'] = "";
        }
        $orderInfo['year']=date("Y",strtotime($orderInfo['order_time']));
        $orderInfo['month']=date("m",strtotime($orderInfo['order_time']));
        $orderInfo['day']=date("d",strtotime($orderInfo['order_time']));
        $orderInfo['order_info_tclxrs']=explode(",",$orderInfo['order_info_tclxr']);
        $orderInfo['order_info_sclxrs']=explode(",",$orderInfo['order_info_sclxr']);
        $orderInfo['order_info_smsc'] = $orderInfo['order_info_smsc'] == 'Y' ? '上门送车' : '自提';
        $orderInfo['order_info_bxd'] =$orderInfo['order_info_bxd']/100;
        $orderInfo['order_info_price'] =$orderInfo['order_info_price']/100;
        //提车费
        $info['tc'] = $orderInfo['order_info_t_car']/100;
        //送车价
        $info['sc'] = $orderInfo['order_info_s_car']/100;
        //上门
        $info['sm'] = $orderInfo['order_smsc_car']/100;
        //集散费
        $info['js'] =$orderInfo['order_info_c_car']/100;
        //毛利
        $info['ml'] = $orderInfo['order_info_margin']/100;
        //运输费
        $orderInfo['order_yun_price'] = $info['tc']+$info['sc']+$info['sm']+$info['js']+$info['ml'];
        $orderInfo['car_washing']= $orderInfo['car_washing']/100+$orderInfo['bill_price']/100;
        $orderInfo['allMoney']=$orderInfo['order_info_zj']/100;//$orderInfo['car_washing']+$orderInfo['order_yun_price']+$orderInfo['order_info_bxd'];
        $orderInfo['wan']=cny(floor($orderInfo['allMoney']/10000));
        if(($orderInfo['allMoney']/1000)>0){
            $orderInfo['qian']=cny(substr($orderInfo['allMoney'],-4,1));
        }else{
            $orderInfo['qian']='';
        }
        if(($orderInfo['allMoney']/100)>0){
            $orderInfo['bai']=cny(substr($orderInfo['allMoney'],-3,1));
        }else{
            $orderInfo['bai']='';
        }
        if(($orderInfo['allMoney']/10)>0){
            $orderInfo['shi']=cny(substr($orderInfo['allMoney'],-2,1));
        }else{
            $orderInfo['shi']='';
        }
        $orderInfo['ge']=cny(substr($orderInfo['allMoney'],-1,1));
        if($orderInfo['pay_way']=='B'){
            $orderInfo['pay_way']='支付宝';
        }else if($orderInfo['pay_way']=='W'){
            $orderInfo['pay_way']='微信';
        }else{
            $orderInfo['pay_way']='车到付款';
        }
        $judge=time()-strtotime($orderInfo['order_time']);
        if($judge>20*3600){
            $orderInfo['is']=1;
        }else{
            $orderInfo['is']=2;
        }
        $orderInfo['nowYear']=date("Y",time());
        $orderInfo['nowMonth']=date("m",time());
        $orderInfo['nowDay']=date("d",time());
        $verifyInfo = $verify_M ->where($map)->find();
        //查看支付状态 检查支付时间
            $difTime=time()-strtotime($orderInfo['order_time']);
            $system=M("system")->find();
            $numsTime=$system['pay_time']*3600;
            if($difTime>$numsTime){
                $orderInfo['agree']='Y';
            }else{
                $orderInfo['agree']='N';
            }
        $result['order']=$orderInfo;
        $result['verifyInfo']=$verifyInfo;
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