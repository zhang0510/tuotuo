<?php
namespace Front\Controller;

class GroupBuyController extends BaseController { 
   
	/**
	 * 进入团购页面
	 */
	function gotoGroupBuy(){
		
		$gbObj = D("GroupBuy");
		$list = $gbObj->getGroupBuy();
		$this->assign("list",$list);
		$this->display("BuyLine:buy_line");
	}
	
	/**
	 * 团购第一步
	 */
	function groupOne(){
		//$tr = jiema(session('userData'));
		$obj = D("Worklwt");
		$data = $obj->checkLogin();
		if(!$data['flag']){
			$jump = array('method'=>'GroupBuy/gotoGroupBuy');
			session('jump',$jump);
			$this->display("Login:pc_login");
		}else{
			$num = I("num")<2?'2':I("num");//选择车数量
			$province = get_province();//获取省份
			$brand = get_brand();//获取品牌
			$code = I("code");
			$this->assign("code",$code);
			$this->assign("num",$num);
			$this->assign("list",$province);
			$this->assign("brand",$brand);
			$this->display("BuyLine:group_one");
		}
	}
	/**
	 * 团购第二步
	 */
	function groupTwo(){
		$userData = json_decode(des_decrypt_php(session("userData")),true);
		$startCity = I("startCity");//出发地
		$endCity = I("endCity");//目的地
		$carType = I("carType");//品牌车型
		print_log("carType车型信息:".$carType);
		$favorableSum = I("favorableSum");//团购优惠CODE
		$gbObj = D("GroupBuy");
		$inObj = D("Index");
		$wlObj = D("Worklwt");
		$favorablemony = $gbObj->getFavorableSum($favorableSum);
		$favorablemony = $favorablemony['group_scale']/100;
		$gbList = $gbObj -> getCarTypeData($carType);//获取品牌车型等信息
		//车型加价总计
		$cartypeallprice = $gbList['price_all'];
		//整条线路费用
		$linePriceArr = $wlObj->getPrice($startCity,$endCity);
		$linePrice = $linePriceArr['fuc'];
		print_log("整条线路费用单辆:".$linePrice);
		//毛利获取
		$cf = explode(",", $startCity);
		$md = explode(",", $endCity);
		//$ml = $wlObj->getmlPrice($cf[0],$md[0]);
		//线路总运费
		$lineYunFei = $linePrice*$gbList['carNum'];
		//费用总计
		$allPrice = $cartypeallprice+$lineYunFei - $favorablemony;
		$all = $cartypeallprice+$lineYunFei;
		print_log("车型加价:".$cartypeallprice);
		print_log("整条线路的费用:".$lineYunFei);
		//print_log("毛利:".$ml);
		$aimPCAList = $gbObj -> getAimCityArea($endCity);//获取目的地上门送车区域，区域List
		$startPCAInfo = $gbObj->getStartCityArea($startCity);//获取出发地省市区信息
		$tiVo = $inObj->getTi($startCity);//集散地A对象
		$songVo = $inObj->getSong($endCity);//集散地B对象
		
		$conponList = $inObj->getUserConpon($userData['user_code'],$startCity,$endCity,$tiVo['ti_end'],$songVo['song_star']);//获取用户优惠券
		
		$this->assign("conpon",count($conponList));
		$this->assign("conponList",$conponList);//当前登陆用户的优惠券
		
		$this->assign("province",$startPCAInfo['province']);//出发地省
		$this->assign("city",$startPCAInfo['city']);//出发地市
		$this->assign("area",$startPCAInfo['area']);//出发地区
		
		$this->assign("aimPro",$aimPCAList['voProvince']);//目的地省
		$this->assign("aimCity",$aimPCAList['voCity']);//目的地市
		
		$this->assign("aimAreaList",$aimPCAList['listArea']);
		$this->assign("gbList",$gbList['data']);
		$this->assign("allPrice",$allPrice);//总费用
		$this->assign("carType",$carType);//车辆信息
		
		$this->assign("favorableSum",$favorableSum);//团购金额CODE
		$this->assign("favorablemony",$favorablemony);//团购金额
		$this->assign("linePrice",$lineYunFei);//整条线路的费用
		$this->assign("cartypeallprice",$cartypeallprice);//车型加价
		$this->assign("all",$all);//价格
		$this->display("BuyLine:group_two");
	}
	/**
	 * 车妥妥第三部
	 */
	function groupThree(){
		$userData = json_decode(des_decrypt_php(session("userData")),true);
		$code = md5($userData['user_code']);
		$data = json_decode(des_decrypt_php(S($code)),true);
		$startAddress = $data['startAddress'];//出发地
		$endAddress = $data['endAddress'];//目的地
		$carinfo = $data['carinfo'];//车辆信息
		$ctinfo = $data['ctinfo'];//车辆，保险等详细信息
		$connectCarWay = $data['connectCarWay'];//提车方式
		$connectArea = $data['connectArea'];//自提区域
		$gbObj = D("GroupBuy");
		$aimPCAList = $gbObj -> getAimCityArea($endAddress);//获取目的地上门送车区域，区域List
		$startPCAInfo = $gbObj->getStartCityArea($startAddress);//获取出发地省市区信息
		$gbList = $gbObj -> getCarTypeData($carinfo);//获取品牌车型等信息
		$linkList = $gbObj->getGroupAddCommon($userData['user_code']);//当前用户的常用联系人
		$carInfoList = $gbObj->carInputDispose($ctinfo);
		if($connectCarWay=="Y"){
			$vo = $gbObj->getcityName($connectArea);
			$this->assign("ztname",$vo['area_name']);
		}
		$this->assign("province",$startPCAInfo['province']);//出发地省
		$this->assign("city",$startPCAInfo['city']);//出发地市
		$this->assign("area",$startPCAInfo['area']);//出发地区
		
		$this->assign("aimPro",$aimPCAList['voProvince']);//目的地省
		$this->assign("aimCity",$aimPCAList['voCity']);//目的地市
		
		$this->assign("gbList",$gbList['data']);
		$this->assign("connectCarWay",$connectCarWay);
		$this->assign("carInfoList",$carInfoList);
		
		$this->assign("linkListsize",count($linkList));
		$this->assign("linkList",$linkList);//常用联系人
		$this->display("BuyLine:group_three");
	}
	/**
	 * 团购订单第4步
	 */
	function groupFour(){
		$token = rand_token();
		$userData = json_decode(des_decrypt_php(session("userData")),true);
		$code = md5($userData['user_code']);
		$data = json_decode(des_decrypt_php(S($code)),true);
		
		$car_plate_num = I("car_plate_nums");//车牌号码
		$send_name = I("send_name");//发件人姓名
		$send_tel = I("send_tel");//发件人电话
		$send_code = I("send_code");//发件人证件号
		
		$gather_name = I("gather_name");//收件人姓名
		$gather_tel = I("gather_tel");//收件人电话
		$gather_code = I("gather_code");//收件人证件号
		
		$send_car_address = I("send_car_address");//发件地址
		$gather_car_address = I("gather_car_address");//收件地址
		
		$remark = I("remark");//备注
		$data['car_plate_num'] = $car_plate_num;
		$data['send_name'] = $send_name;
		$data['send_tel'] = $send_tel;
		$data['send_code'] = $send_code;
		$data['gather_name'] = $gather_name;
		$data['gather_tel'] = $gather_tel;
		$data['gather_code'] = $gather_code;
		$data['send_car_address'] = $send_car_address;
		$data['gather_car_address'] = $gather_car_address;
		$data['remark'] = $remark;
		$code = md5($userData['user_code']);
		S($code,des_encrypt_php(json_encode($data)));
		
		$this->assign("yuanjia",$data['yuanjia']);
		$this->assign("youhui",$data['youhui']);
		$this->assign("songcheshangmen",$data['songcheshangmen']);
		$this->assign("platelets",$data['platelets']);
		$this->assign("baoxian",$data['baoxian']);
		$this->assign("youhui",$data['youhui']);
		$this->assign("tuangouyouhui",$data['tuangouyouhui']);
		$this->assign("token",$token);
		$this->display("BuyLine:group_four");
	}
	/**
	 * 记录订单团购
	 */
	function groupOrder(){
		$token = I("token");
		if(!from_token($token)){
			$this->error("重复提交订单!");
		}
		$payway = I("payway");
		$gbObj = D("GroupBuy");
		$arr = $gbObj->groupOrder($payway);
		if($arr['touCode']!=''&&$arr['touCode']!=null){
		    if($arr['carCount']!=0&&$arr['carCount']==count($arr['infoCode'])){
		        $userData = json_decode(des_decrypt_php(session("userData")),true);
		        $code = md5($userData['user_code']);
		        $data = json_decode(des_decrypt_php(S($code)),true);
		        if($payway=='Z'){
		            $payobj = A('Payment');
		            $configs = array(
		                'return_url'	=>C("DOMAINNAME").'/Front/Payment/usersurl',	//服务器同步通知页面路径(必填)
		                //'notify_url'	=>'',	//服务器异步通知页面路径(必填)     //若模块下配置文件已经配置则注释掉
		                'out_trade_no'	=>$arr['touCode'],	//商户订单号(必填)
		                'subject'		=>'车妥妥支付',	//订单名称(必填)
		                'total_fee'		=>$arr['total'],	//付款金额(必填)
		                'body'			=>'车妥妥在线支付',	//订单描述
		                //'show_url'		=>'',	//商品展示地址
		            );
		            
		            //调用支付宝接口
		            $payobj->alipayapi($configs);
		        }else if($payway=='W'){
		            $payobj = A('Payment');
		            $payobj->wxpayapi($arr['touCode'],$arr['total']);//$arr['total'] 为总价
		        }else{
		            $this -> success('操作成功',U('OrderDetail/index',array('order_code'=>$arr['touCode'])));
		        }
		    }
		}
		//dump($arr);
		//echo "网站建设中.....敬请等待...";
		//die();
	}
	/**
	 * 保险费用计算
	 */
	function insurance(){
		$val = I("val")==''?0:I("val");//单位万元
		$num = I("num")==''?1:I("num");//车数量
		$wlObj = D("Worklwt");
		$bl = $wlObj->getBxBl();//例如30%，使用时除以100
		$mval = $val*$bl*$num*100;//单位元
		$this->ajaxReturn($mval);
	}
	/**
	 * 团购第二步费用相关计算
	 */
	function costCalculate(){
		$startAddress = I("startAddress");//出发地
		$endAddress = I("endAddress");//目的地
	}
	/**
	 * 获取上门送车费
	 * S司机
	 * X小板
	 */
	function getsmPrice(){
		$type = I("extractCarWay")=="Y"?"X":'S';//送车方式
		$endpca = I("endpca");//送车省市
		$smendpca = I("smendpca");//送车省市区
		
		$wlObj = D("Worklwt");
		$data = $wlObj->getsmPrice($endpca,$smendpca,$type);
		$price=0;
		if($data!=null&&$data!=""){
			if($type=='S'){
				$price = $data['sm_platelets_price'];
			}else{
				$price = $data['sm_driver_price'];
			}
		}
		$this->ajaxReturn($price);
	}
	
	/**
	 * 获取城市
	 */
	function getGroupCity(){
		$pid = I("id");
		$gbObj = D("Index");
		$list = $gbObj->getCity($pid);
		print_log("-------:".json_encode($list));
		$this->ajaxReturn($list);
	}
	/**
	 * 获取区域
	 */
	function getGroupArea(){
		$pid = I("id");
		$gbObj = D("Index");
		$list = $gbObj->getBlock($pid);
		$this->ajaxReturn($list);
	}
	/**
	 * 品牌-车型
	 */
	function getCarType(){
		$pid = I("id");
		$gbObj = D("Index");
		$list = $gbObj->getType($pid);
		$this->ajaxReturn($list);
	}
	/**
	 * 费用计算
	 */
	function expenseCount(){
		$data['startAddress'] = $startAddress = I("startAddress");//出发地
		$data['endAddress'] = $endAddress = I("endAddress");//目的地
		$data['carTypePrice'] = $carTypePrice = I("carTypePrice");//车型加价合计
		$data['extractCarWay'] = $extractCarWay = I("extractCarWay");//上门提车方式 司机/小板车  N/Y
		$data['connectCarWay'] = $connectCarWay = I("connectCarWay");//目的地接车方式 自提/送车上门 N/Y
		$data['connectArea'] = $connectArea = I("connectArea");//如果上门送车，送车的区域
		$data['carinfo'] = $carinfo = I("carinfo");//车辆第一步传入信息
		$data['favorableSum'] = $favorableSum = I("favorableSum");//优惠金额code
		$data['insurancePrice'] = $insurancePrice = I("insurancePrice");//保险费用合计
		$data['couponticket'] = $couponticket = I("couponticket");//使用的优惠券信息，如果不使用优惠券，则为空
		
		$data['ctinfo'] = I("ctinfo");//保险全部详细信息
		$gbObj = D("GroupBuy");
		$idObj = D("Index");
		
		$tiVo = $gbObj->tiCar($startAddress);//提车费用
		$dtObj = $gbObj->destination($endAddress);//目的地费用查询
		$thVo = $gbObj->gather($tiVo['ti_end'],$dtObj['song_star']);//获取集散地费用
		$mlPrice = $idObj->getMaoli(explode(",", $startAddress)[0],explode(",", $endAddress)[0]);//毛利
		
 		$wlObj = D("Worklwt");
 		$linePriceArr = $wlObj->getPrice($startAddress,$endAddress);
		//车型加价
		print_log("车型加价:".$carTypePrice);
		print_log("车辆信息:".$data['carinfo']);	
		print_log("保险费用:".$insurancePrice);	
		print_log("费用数据：".json_encode($linePriceArr));
		$carNum = $gbObj->getCarTypeNum($carinfo);
		$data['maoli'] = $mlPrice/100;
		$platelets=0;//运输费用 包含：起始地-集散地A，集散地A-集散地B，集散地B-目的地，目的地-上门，司机/小板车
		$yuanjia = 0;
		$s = 0;
		if($extractCarWay=="N"){
			$yuanjia = $platelets = $linePriceArr['fuc']*$carNum +$carTypePrice;//司机运输费用计算，不含送车上门
			if($connectCarWay=="Y"){
				$smvo = $gbObj->visit($endAddress,$endAddress.','.$connectArea);//上门送车费用
				$s = $smvo['sm_driver_price']/100;
				print_log("上门送1车费用:".$s);
				$platelets += $s*$carNum;
			}
		}else{
			$yuanjia = $platelets = $linePriceArr['fuc_xiaoban']*$carNum +$carTypePrice;//小板车运输费用计算，不含送车上门
			if($connectCarWay=="Y"){
				$smvo = $gbObj->visit($endAddress,$endAddress.','.$connectArea);//上门送车费用
				$s = $smvo['sm_platelets_price']/100;
				print_log("上门送2车费用:".$s);
				$platelets += $s*$carNum;
			}
		}
		print_log("运输总费用:".$yuanjia);
		$platelets = $fm = $platelets + $insurancePrice;//加入保险费用
		//减去优惠费用
		$youhui = 0;
		if($couponticket!=""){
			$youhui = explode("-", $couponticket)[1];
			$platelets = $platelets-$youhui;
		}
		//减去优惠金额 $favorableSum
		$fsaVo = $gbObj->getFavorableSum($favorableSum);
		$tuangouyouhui = $fsaVo['group_scale']/100;
		$platelets = $platelets-$tuangouyouhui +$carTypePrice;
		$data['tuangouyouhui'] = $tuangouyouhui;//团购优惠金额
		$data['yuanjia'] = $yuanjia;//运输费
		$data['youhui'] = $youhui;//优惠金额
		$data['baoxian'] = $insurancePrice;//保险费
		$data['songcheshangmen'] = $s*$carNum;//送车上门费
		$data['platelets'] = $platelets;//最终费用
		$data['carTypePrice'] = $carTypePrice;//车型加价
		$data['all'] = $fm+$carTypePrice;//车型加价
		$userData = json_decode(des_decrypt_php(session("userData")),true);
		$code = md5($userData['user_code']);
		S($code,des_encrypt_php(json_encode($data)));
		$this->ajaxReturn($data);
	}
	

}