<?php
namespace Front\Controller;
class WorklwtController extends BaseController {
    /**
     * 优惠列表
     */
    function lineDisList(){
        $obj = D("Worklwt");
        $list = $obj->lineDisList();
        $this->assign('list',$list);
        //dump($list);
        $this->assign("adv",$obj->advLine('C'));
        $this->display("PreferentialLine:preferential_line");
    }
    /**
     * 优惠下单第一步
     */
    function lineDis(){
        //$accs = jiema(session("master"))
        $this->checkUser();
        $code = I('code');
        if($code!=""){
            $obj = D("Worklwt");
            $brand = get_brand();
            $province = get_province();//获取省份
            $this->assign("list",$province);
            $this->assign("brand",$brand);
            $this->assign("info",$obj->lineDis($code));
            $this->display("Dis:line_diss");
        }else{
        	$obj = D("Worklwt");
        	$brand = get_brand();
        	$province = get_province();//获取省份
        	$this->assign("list",$province);
        	$this->assign("brand",$brand);
        	//$this->assign("info",$obj->lineDis($code));
        	$this->display("Dis:line_dis");
        }
    }
    /**
     * 优惠下单第二步
     */
    function lineDisTwo(){
        $accs = jiema(session("userData"));
       
        $this->checkUser();
        $code = I('code');
        $qscte = I("qscte");//品牌
        $qsctc = I("qsctc");//车型
        $eprice = I("eprice")/100;//附加费
        
        $cobj = D('Index');
        if($code!=""){
            $obj = D("Worklwt");
            //$fa = $obj->getMemberFav($code);
            $info = $obj->lineDis($code,$eprice);
            $baseObj = D('Base');
            $pobj = D('Index');
            $sans = $pobj -> getTi($info['line_star']);
            $data['kks']['sans'] = $sans['spro'];
            $sane = $pobj -> getSong($info['line_end']);
            $data['kks']['sane'] = $sane['epro'];
            $mao =  $obj->getmlPrice($sans['spro'],$sane['epro']);//获取毛利
            
            $data['kks']['dis'] = $info['line_discount']/100;
            $data['kks']['name1'] = explode("-", $info['start_city'])[0];
            $data['kks']['name2'] = explode("-", $info['end_city'])[0];
            $data['kks']['name3'] = $info['start_city'];
            $data['kks']['name4'] = $info['end_city'];
            $data['to']['order_code'] = $baseObj->getTablecode('D');//get_code("OC");
            $data['to']['user_code'] = $accs['user_code'];
            $data['to']['order_status'] = "S";
            $data['to']['pay_status'] = "W";
            $data['to']['order_way'] = "S";
            $data['to']['yh_type'] = "Y";
            $data['toi']['order_code'] = $data['to']['order_code'];
            $data['toi']['order_info_code'] = $baseObj->getTablecode('M');;
            $data['toi']['order_info_brand'] = $qscte;
            $data['toi']['order_info_type'] = $qsctc;
            //$data['toi']['order_info_zj'] = $info['price']['totle'];
            $data['toi']['order_info_c_car'] = $info['price']['san_price'];
            $data['toi']['order_info_t_car'] = $info['price']['ti_price'];
            $data['toi']['order_info_s_car'] = $info['price']['so_price'];
            $data['toi']['order_info_add_price'] = $eprice;
            $data['toi']['order_info_end'] = $info['line_end'];
            $data['toi']['order_info_star'] = $info['line_star'];
            //$mao =  $obj->getmlPrice(explode(",",$data['toi']['order_info_star'])[0],explode(",",$data['toi']['order_info_end'])[0]);//获取毛利
            $info['price']['totle'] =$info['price']['totle']+$mao;//运车总价
            $data['toi']['order_info_zj'] = $info['price']['totle'];//总价
            $data['toi']['order_info_margin'] = $mao;
            $arr = explode(',',$info['line_end']);
            $block = $cobj -> getBlock($arr[1]);
            S($accs['user_code'].'AK',$data,2*3600);
            $pro = get_province();
            $this->assign("bao",$obj->getBaoxian());
            //dump($arr);
            $coupon = $cobj -> getUserConpon($accs['user_code'],$info['line_star'],$info['line_end'],$cobj->getTi($info['line_star'])['ti_end'],$cobj->getTi($info['line_end'])['song_star']);
            //dump($coupon);
            
            $startsss = I("strt");
            $endsss = I("end");
            
            $this -> assign('coupon',$coupon);
            $this->assign('block',$block);
            $this->assign("pro",$pro);
            $this->assign("qscte",$qscte);
            $this->assign("qsctc",$qsctc);
            $this->assign("info",$info);
            $this->assign("strt",explode("-", $startsss)[0]);
            $this->assign("end",explode("-", $endsss)[0]);
            $this->assign("toi",$data['toi']);
            $this->assign("kks",$data['kks']);
        }else{
        	$userData = json_decode(des_decrypt_php(session("userData")),true);
        	$obj = D("Worklwt");
        	//$fa = $obj->getMemberFav($code);
        	$start_cityarea = I("start_cityarea");//出发地
        	$end_cityarea = I("end_cityarea");//目的地
        	$info = $obj->lineDis($start_cityarea,$end_cityarea,$eprice);
        	$start_cityarea_name = $obj->getAreaName($start_cityarea);
        	$end_cityarea_name = $obj->getAreaName($end_cityarea);
        	//毛利获取
        	$cf = explode(",", $start_cityarea);
        	$md = explode(",", $end_cityarea);
        	//$ml = $wlObj->getmlPrice($cf[0],$md[0]);
        	$pobj = D('Index');
        	$sans = $pobj -> getTi($start_cityarea);
        	$data['kks']['sans'] = $sans['spro'];
        	$sane = $pobj -> getSong($end_cityarea);
        	$data['kks']['sane'] = $sane['epro'];
        	$mao =  $obj->getmlPrice($cf[0],$md[0]);//获取毛利
        	$linePriceArr = $obj->getPrice($start_cityarea,$end_cityarea);
        	$data['kks']['dis'] = 0;
        	$data['kks']['name1'] = explode("-", $start_cityarea_name)[0];
        	$data['kks']['name2'] = explode("-", $end_cityarea_name)[0];
        	$data['kks']['name3'] = $start_cityarea_name;
        	$data['kks']['name4'] = $end_cityarea_name;
        	$data['to']['order_code'] = get_code("OC");
        	$data['to']['user_code'] = $accs['user_code'];
        	$data['to']['order_status'] = "S";
        	$data['to']['pay_status'] = "W";
        	$data['to']['order_way'] = "S";
        	$data['to']['yh_type'] = "Y";
        	$data['toi']['order_code'] = $data['to']['order_code'];
        	$data['toi']['order_info_code'] = get_code("OIC");
        	$data['toi']['order_info_brand'] = $qscte;
        	$data['toi']['order_info_type'] = $qsctc;
        	//$data['toi']['order_info_zj'] = $info['price']['totle'];
        	$data['toi']['order_info_c_car'] = $linePriceArr['san_price'];
        	$data['toi']['order_info_t_car'] = $linePriceArr['ti_price'];
        	$data['toi']['order_info_s_car'] = $linePriceArr['so_price'];
        	$data['toi']['order_info_add_price'] = $eprice;
        	$data['toi']['order_info_end'] = $end_cityarea;
        	$data['toi']['order_info_star'] = $start_cityarea;
        	//$mao =  $obj->getmlPrice(explode(",",$data['toi']['order_info_star'])[0],explode(",",$data['toi']['order_info_end'])[0]);//获取毛利
        	$info['price']['totle'] =$linePriceArr['fuc'];//运车总价
        	$data['toi']['order_info_zj'] = $linePriceArr['fuc'];//总价
        	$data['toi']['order_info_margin'] = $linePriceArr['maoli'];
        	$arr = explode(',',$end_cityarea);
        	$block = $cobj -> getBlock($arr[1]);
        	S($accs['user_code'].'AK',$data,2*3600);
        	$pro = get_province();
        	$this->assign("bao",$obj->getBaoxian());
        	//dump($arr);
        	$coupon = $cobj -> getUserConpon($accs['user_code'],$start_cityarea,$end_cityarea,$cobj->getTi($start_cityarea)['ti_end'],$cobj->getTi($end_cityarea)['song_star']);
        	//dump($coupon);
        	$startsss = I("strt");
        	$endsss = I("end");
        	$this -> assign('coupon',$coupon);
        	//echo $end_cityarea;
        	//dump($block);
        	$this->assign('block',$block);
        	$this->assign("pro",$pro);
        	$this->assign("qscte",$qscte);
        	$this->assign("qsctc",$qsctc);
        	$this->assign("info",$info);
        	$this->assign("strt",explode("-", $startsss)[0]);
        	$this->assign("end",explode("-", $endsss)[0]);
        	
        	$this->assign("toi",$data['toi']);
        	$this->assign("kks",$data['kks']);
        }
        $this->assign("conponsize",count($coupon));
        $this->display("Dis:line_dis_two");
    }
    /**
     * 判断是否登录
     */
    function checkLogins(){
        $obj = D("Worklwt");
        $data = $obj->checkLogin();
        $this->ajaxReturn($data);
    }
    /**
     * 提车方式筛选
     */
    function ticheType(){
        $obj = D("Worklwt");
        $accs = jiema(session("userData"));
        $data = S($accs['user_code'].'AK');
        $type = I("type");
        $ti = $obj->getTi($data['toi']['order_info_star'],$type);
        $so = $obj->getSong($data['toi']['order_info_end'],$type);
        
       
        if($data['kks']['bid']!=''){
            $id = $data['kks']['bid'];
            $ids = $data['toi']['order_info_end'].','.$id;
        
            $data['toi']['order_info_smscd'] = $ids;
            $data['toi']['order_smsc_car'] = $obj->getsmPrice($data['toi']['order_info_end'],$ids,$type);//获取上门送车费
        }
        
        
        $data['to']['order_way'] = $type;
        $data['toi']['order_info_t_car'] = $ti;
        $data['toi']['order_info_s_car'] = $so;
        $data['toi']['order_info_zj'] = $ti+$so+$data['toi']['order_info_c_car'];
        S($accs['user_code'].'AK',null);
        S($accs['user_code'].'AK',$data,2*3600);
        $msg = $obj->getPrce();
        $this->ajaxReturn($msg);
    }
    /**
     * 是否上门送车
     */
    function smscFun(){
        $obj = D("Worklwt");
        $accs = jiema(session("userData"));
        $data = S($accs['user_code'].'AK');
        $id = I("id");
        
        $data['kks']['bid'] = $id;  
        
        $type = I("type");
        $data['toi']['order_info_smsc'] = $type;
        //print_log('-----------------'.$type);
        if($type=="Y"){
            $ids = $data['toi']['order_info_end'].','.$id;
            
            $data['toi']['order_info_smscd'] = $ids;
            $data['toi']['order_smsc_car'] = $obj->getsmPrice($data['toi']['order_info_end'],$ids);//获取上门送车费
            
        }else{
            //$ids = $data['toi']['order_info_end'].','.$id;
            $data['toi']['order_info_smscd'] = '';
            $data['toi']['order_smsc_car'] = '';
        }
        S($accs['user_code'].'AK',null);
        S($accs['user_code'].'AK',$data,2*3600);
        $msg = $obj->getPrce();
        $this->ajaxReturn($msg);
    }
    /**
     * 保险费用
     */
    function getbxPrice(){
        $obj = D("Worklwt");
        $accs = jiema(session("userData"));
        $data = S($accs['user_code'].'AK');
        $pr = I("pr")*10000;
        $bi = $obj->getBxBl();
        $bx = $pr*$bi/100;
        $data['toi']['order_info_price'] = $pr*100;
        $data['toi']['order_info_bxd'] = $bx;
        S($accs['user_code'].'AK',null);
        S($accs['user_code'].'AK',$data,2*3600);
        $msg = $obj->getPrce();
        //$msg['bx'] = $bx;
        $this->ajaxReturn($msg);
    }
    /**
     * 优惠码使用
     */
    function yhmSyFun(){
        $obj = D("Worklwt");
        $accs = jiema(session("userData"));
        $data = S($accs['user_code'].'AK');
        $code = I("code");
        $data['toi']['fav_code'] = $code;
        $data['to']['yh_mark'] = $code;
        S($accs['user_code'].'AK',null);
        S($accs['user_code'].'AK',$data,2*3600);
        $msg = $obj->getPrce();
        //$msg['bx'] = $bx;
        $this->ajaxReturn($msg);
    }
    /**
     * 优惠下单第三步
     */
    function lineDisThre(){
 		$accs = jiema(session("userData"));
        $gbObj = D("GroupBuy");
        $linkList = $gbObj->getGroupAddCommon($accs['user_code']);//当前用户的常用联系人
        $this->checkUser();
        $obj = D("Worklwt");
        $data = S($accs['user_code'].'AK');
        $this->assign("name3",$data['kks']['name3']);
        $this->assign("name4",$data['kks']['name4']);
        $this->assign("name1",$data['kks']['name1']);
        $this->assign("name2",$data['kks']['name2']);
        $this->assign("cx",$data['toi']['order_info_brand']);
        $this->assign("cp",$data['toi']['order_info_type']);
        $this->assign("pr",$data['toi']['order_info_price']);
        $this->assign("types",$data['toi']['order_info_smsc']);
        $this->assign("linkList",$linkList);//常用联系人
        //dump(S($accs['user_code'].'AK'));
        $this->display("Dis:line_dis_thre");
    }
    /**
     * 优惠下单第四步
     */
    function lineDisFour(){
        $accs = jiema(session("userData"));
        $this->checkUser();
        $obj = D("Worklwt");
        $data = S($accs['user_code'].'AK');
        $data['toi']['order_info_carmark'] = I("order_info_carmark");
        $data['toi']['order_info_tclxr'] = I("fname").",".I("fiden").','.I("fphone");
        $data['toi']['order_info_sclxr'] = I("sname").",".I("siden").','.I("sphone");
        $data['toi']['order_info_star_address'] = I("order_info_star_address");
        $data['toi']['order_info_end_address'] = I("order_info_end_address");
        $data['toi']['order_info_remark'] = I("order_info_remark");
        //dump($data);
        S($accs['user_code'].'AK',null);
        S($accs['user_code'].'AK',$data,2*3600);
        //dump($data);
        $this->assign('yh',$obj->getyxPrice($data['toi']['fav_code']));
        $this->assign('to',$data['toi']['order_info_zj']);
        $this->assign('so',$data['toi']['order_smsc_car']);
        
        $this -> assign('toi',$data['toi']);
        $this -> assign('kks',$data['kks']);
        
        $this->display("Dis:line_dis_four");
    }
    /**
     * 优惠下单支付
     */
    function payLineDis(){
        $accs = jiema(session("userData"));
        $data = S($accs['user_code'].'AK');
        $this->checkUser();
       /*  $ss = I("post.ss"); */
        $ss= $data['to']['pay_way'];
        $obj = D("Worklwt");
        $data = S($accs['user_code'].'AK');
        $data['to']['order_time'] = date("Y-m-d H:i:s",time());
        $data['toi']['order_info_zj'] = $data['toi']['order_info_zj']*100;
        $data['toi']['order_info_c_car'] = $data['toi']['order_info_c_car']*100;
        $data['toi']['order_info_t_car'] = $data['toi']['order_info_t_car']*100;
        $data['toi']['order_info_s_car'] = $data['toi']['order_info_s_car']*100;
        $data['toi']['order_smsc_car'] = $data['toi']['order_smsc_car']*100;
        $data['toi']['order_info_margin'] = $data['toi']['order_info_margin']*100;
        $data['toi']['order_info_add_price'] = $data['toi']['order_info_add_price']*100;
        $data['toi']['order_info_bxd'] = $data['toi']['order_info_bxd']*100;
        //dump($accs);
        //if($accs['role'] == 'Q'){
            $data['to']['user_name'] = $accs['user_name'];
            $data['to']['user_tel'] = $accs['tel'];
            $data['to']['user_identity'] = $accs['identity'];
       
        //}
        $ret = $obj->setOrders($data);
        if($ret){
            if($ss=='H'){
                $this -> success('操作成功',U('OrderDetail/index',array('order_code'=>$ret)));
            }else if($ss=='Z'){
                //echo "订单生成成功,等待支付";
                $payobj = A('Payment');
                $configs = array(
                    'return_url'	=>C("DOMAINNAME").'/Front/Payment/usersurl',	//服务器同步通知页面路径(必填)
                    //'notify_url'	=>'',	//服务器异步通知页面路径(必填)     //若模块下配置文件已经配置则注释掉
                    'out_trade_no'	=>$ret,	//商户订单号(必填)
                    'subject'		=>'车妥妥支付',	//订单名称(必填)
                    'total_fee'		=>$data['toi']['order_info_zj'],	//付款金额(必填)
                    'body'			=>'车妥妥在线支付',	//订单描述
                    //'show_url'		=>'',	//商品展示地址
                );
                
                //调用支付宝接口
                $payobj->alipayapi($configs);
            }else{
                $fee = $data['toi']['order_info_zj']*100;
                $payobj = A('Payment');
                $payobj->wxpayapi($ret,$fee);
            }
        }else{
            echo "订单重复生成";
        }
        
    }
    /**
     * 修改支付方式
     */
    function upPay(){
        $accs = jiema(session("userData"));
        $data = S($accs['user_code'].'AK');
        $data['to']['pay_way'] = I("ss");
        S($accs['user_code'].'AK',null);
        S($accs['user_code'].'AK',$data,2*3600);
        $this->ajaxReturn(true);
    }
}