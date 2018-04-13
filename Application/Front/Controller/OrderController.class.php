<?php
namespace Front\Controller;
//use Think\Controller;
class OrderController extends BaseObjController{
    /**
     * 使用优惠券（废）
     * @date: 2016-9-7 上午8:19:48
     * @author: liuxin
     */
    public function useCoupon(){
        $obj = D('Order');
        $code = I('post.code');
        $num = I('post.num');
        $res = $obj -> useCoupon($code,$num);
        if($res){
            $data = '';
        }
        
    }
    /**
     * 查询上门送车信息
     * @date: 2016-9-7 上午8:20:17
     * @author: liuxin
     */
    public function getVisit(){
        $start = I('post.start');
        $end = I('post.end');
        $obj = D('Order');
        $res = $obj -> getVisit($start,$end);
        $this -> ajaxReturn($res);
    }
    /**
     * 正常下单第二页面
     * @date: 2016-9-7 上午8:39:34
     * @author: liuxin
     */
    public function normal(){
        $cobj = D('Index');
        //拼装数组
        $order['flag'] = I("flag")==""?session('neworder')['flag']:I("flag");
        if($order['flag'] == 'Y'){
            $order['qsrez'] = I("qsrez");
            $order['qerez'] = I("qerez");
            $order['qsrezname'] = I("qsrezname");
            $order['qerezname'] = I("qerezname");
            $order['qsctez'] = I("qsctez");
            $order['qsctcz'] = I("qsctcz");
            $order['carids'] = I("carids");
            $order['lineprice'] = I("lineprice");
            $order['product_type'] = I("product_type");
            $order['totalz'] = I("totalz");
            $order['tiz'] = I("tiz");
            $order['songz'] = I("songz");
            $order['maoliz'] = I("maoliz");
            
            session('jumpz',null);
            //$neworder = session('neworder')==""?"":session('neworder');
            $userInfo = json_decode(des_decrypt_php(session('userData')),true);
            if($userInfo['user_code']){
                session("order",$order);
                $order = session('order')['qsrez']==""||session('order')['qsrez']==null?session('neworder'):$order;
                //dump(session("jumpz"));
            }else{
                $jump = array('order'=>$order,'method'=>'Order/normal');
                session('jumpz',$jump);
                session('order',null);
                session('neworder',null);
                session('order',$order);
                session('neworder',$order);
                $obj = A('Login');
                $obj -> pclogin();
                exit;
            }
            $orderInfo = array('order'=>$order,'userInfo'=>$userInfo);
            session("xinjia",$orderInfo);
            $this->assign("pro",get_province());
            $this->assign("brand",get_brand());
            $this -> assign('order',$order);
            $this -> assign('user',$userInfo);
            $this -> display('Order:normal_step_two');
        }else{
            $order['qsrez'] = I("qsrez");
            $order['qerez'] = I("qerez");
            $order['qsrezname'] = I("qsrezname");
            $order['qerezname'] = I("qerezname");
            $order['qsctez'] = I("qsctez");
            $order['qsctcz'] = I("qsctcz");
            $order['carids'] = I("carids");
            $order['lineprice'] = I("lineprice");
            $order['product_type'] = I("product_type");
            $order['order_info_price'] = I("order_info_price");
            $order['order_info_bxd'] = I("order_info_bxd");
            session('jumpz',null);
            //$neworder = session('neworder')==""?"":session('neworder');
            $userInfo = json_decode(des_decrypt_php(session('userData')),true);
            if($userInfo['user_code']){
                session("order",$order);
                $order = session('order')['qsrez']==""||session('order')['qsrez']==null?session('neworder'):$order;
                session('order',$order);
                //dump(session("jumpz"));
            }else{
                $jump = array('order'=>$order,'method'=>'Order/normal');
                session('jumpz',$jump);
                session('order',null);
                session('neworder',null);
                session('order',$order);
                session('neworder',$order);
                $obj = A('Login');
                $obj -> pclogin();
                exit;
            }
            $orderInfo = array('order'=>$order,'userInfo'=>$userInfo);
            //常用联系人
            $linkMan=M("linkman");
            $map['user_code']=$userInfo['user_code'];
            $linkList=$linkMan->where($map)->select();
            $this->assign("linkList",$linkList);
            $this->assign("names",explode("-",$order['qsrezname']));
            $this->assign("name1",explode("-",$order['qsrezname'])[1]);
            $this->assign("name2",explode("-",$order['qerezname'])[1]);
            $this -> assign('user',$userInfo);
            $this->assign("order",$order);
            $this->assign("ret",array('title'=>'我要运车'));
            $this -> display('Order:normal_step_three');
        }
        
    }
    /**
     * 获取保费
     */
    public function getAcale(){
        $this->ajaxReturn(D('Worktwo')->getSecu(I("car_baojia")*10000,"acale_clent"));
    }
    /**
     * 正常下单第三页面
     * @date: 2016-9-7 上午8:40:15
     * @author: liuxin
     */
    public function normalOrderT(){
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        $order['qsrez'] = I("qsrez");
        $order['qerez'] = I("qerez");
        $order['qsrezname'] = I("qsrezname");
        $order['qerezname'] = I("qerezname");
        $order['qsctez'] = I("qsctez");
        $order['qsctcz'] = I("qsctcz");
        $order['carids'] = I("carids");
        $order['lineprice'] = I("lineprice");
        $order['product_type'] = I("product_type");
        $order['totalz'] = I("totalz");
        $order['tiz'] = I("tiz");
        $order['songz'] = I("songz");
        $order['maoliz'] = I("maoliz");
        $order['flag'] = I("flag");
        $order['order_info_price'] = I("order_info_price");
        $order['order_info_bxd'] = I("order_info_bxd");
        session('order',null);
        session('order',$order);
        //常用联系人
        $linkMan=M("linkman");
        $map['user_code']=$userInfo['user_code'];
        $linkList=$linkMan->where($map)->select();
        $this->assign("linkList",$linkList);
        $this->assign("names",explode("-",$order['qsrezname']));
        $this->assign("name1",explode("-",$order['qsrezname'])[1]);
        $this->assign("name2",explode("-",$order['qerezname'])[1]);
        $this -> assign('user',$userInfo);
        $this->assign("order",$order);
        $this -> display('Order:normal_step_three');
    }
    /**
     * 正常下单附加服务
     * @date: 2016-9-7 上午8:40:15
     * @author: lwt
     */
    public function normalOrderFu(){
        $flag = I("flag");
        if($flag == 'Y'){
            $userInfo = json_decode(des_decrypt_php(session('userData')),true);
            $order = session('order');
            $fname = I('fname');
            $sname = I('sname');
            $fphone = I('fphone');
            $sphone = I('sphone');
            $fiden = I('fiden');
            $siden = I('siden');
            $carmark = I('carmark');
            $faddress = I('faddress');
            $saddress = I('saddress');
            $order['order_info_tclxr'] = $fname.",".$fphone.",".$fiden;
            $order['order_info_sclxr'] = $sname.",".$sphone.",".$siden;
            $order['order_info_carmark'] = $carmark;
            $order['order_info_star_address'] = $faddress;
            $order['order_info_end_address'] = $saddress;
            session('order',null);
            session('order',$order);
            if($order['product_type'] == 'B'){
                $yun = $order['lineprice']+$order['tiz']+$order['songz']+$order['maoliz'];
            }else{
                $yun = $order['lineprice']+$order['tiz']+$order['maoliz'];
            }
            $this->assign("saddress",$saddress);
            $this->assign("order",$order);
            $this->assign("yun",$yun);
            $this->assign("name1",explode("-",$order['qsrezname'])[1]);
            $this->assign("name2",explode("-",$order['qerezname'])[1]);
            //$this->assign("citys",$order['qerezname']);
            $this->assign("block",D("worktwo")->getBlock(explode(",",$order['qerez'])[1]));
            $this -> assign('user',$userInfo);
            $this -> display('Order:normal_step_fu');
        }else{
            $userInfo = json_decode(des_decrypt_php(session('userData')),true);
            $order = session('order');
            $objs = D("Worktwo");
            $fname = I('fname');
            $sname = I('sname');
            $fphone = I('fphone');
            $sphone = I('sphone');
            $fiden = I('fiden');
            $siden = I('siden');
            $carmark = I('carmark');
            $faddress = I('faddress');
            $saddress = I('saddress');
            $data['order_info_tclxr'] = $fname.",".$fphone.",".$fiden;
            $data['order_info_sclxr'] = $sname.",".$sphone.",".$siden;
            $data['order_info_carmark'] = $carmark;
            $data['order_info_star_address'] = $faddress;
            $data['order_info_end_address'] = $saddress;
            $data['order_info_brand'] = $order['qsctez'];
            $data['order_info_type'] = $order['qsctcz'];
            $data['order_info_star'] = $order['qsrez'];
            $data['order_info_end'] = $order['qerez'];
            $time = date("Y-m-d H:i:s",time());
            $data['order_code'] = $objs->getTablecode("D");
            $data['user_code'] = $userInfo['tel'];
            $data['order_time'] = $time;
            $data['order_status'] = "S";
            $data['pay_status'] = 'W';
            $data['source'] = "B";
            $data['product_type'] = $order['product_type'];
            $data['pay_way'] = 'H';
            $data['order_way'] = 'S';
            $data['kefu_shi'] = 'N';
            $ret = $objs->setOrder($data);
            if($ret){
                session('order',null);
                $this->redirect('MyOrder/index');
            }else{
                $this->showErrorPage("下单失败，请联系客服");
            }
            //$this->ajaxReturn($msg);
        }
        
    }
    /**
     * 判断是否上门送车&&计算价格
     */
    public function smscFun(){
        $masObj = D('Worktwo');
        $id = I("id");
        $type = I("type");
        $sm_star = I("str");
        $sm_end = $sm_star.",".$id;
        $msg['prices'] = ($masObj->getsmPrice($sm_star,$sm_end)['sm_platelets_price'])/100;
        //print_log("----------------------:".$type);
        if($type=='Y'){
            $msg['flag'] = true;
        }else{
            $msg['flag'] = false;
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 获取优惠劵金额
     */
    function getFavPrice(){
        $this->ajaxReturn(D('Worktwo')->getUserConpon(I("code")));
    }
    /**
     * 正常下单第四页面
     * @date: 2016-9-7 上午8:40:37
     * @author: liuxin
     */
    public function normalOrderTh(){
        $token = $this -> token(4);
        session('token',$token);
        $order = session('order');
        $aaObj = D('Worktwo');
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        if(empty($userInfo['user_code'])){
            $obj = A('Login');
            $obj -> pclogin();
            exit;
        }
        $order['order_info_end_address'] = I("order_info_end_address");
        $order['order_info_smsc'] = I("order_info_smsc");
        $order['car_washing'] = I("car_washing");
        $order['fav_code'] = I("fav_code");
        $order['order_info_zj'] = I("totalz");
        $str = '';
        $strs = '';
        if($order['product_type'] == 'B'){
            $yun = $order['lineprice']+$order['tiz']+$order['songz']+$order['maoliz'];
        }else{
            $yun = $order['lineprice']+$order['tiz']+$order['maoliz'];
        }
        $strs .="运输费:+".$yun."元,";
        $strs .="保费:+".$order['order_info_bxd']."元,";
        if($order['order_info_smsc'] == "Y"){
            $order['order_info_smscd'] = $order['qerez'].",".I("city_qus");
            $order['order_smsc_car'] = I("order_smsc_car");
            $strs .="上门送车:+".$order['order_smsc_car']."元,";
            $str .="上门送车:+".$order['order_smsc_car']."元,";
            $this->assign("citys","-".$aaObj->getPlaceName(I("city_qus")));
        }
        
        $fav = $aaObj->getUserConpon($order['fav_code']);
        if($fav['flag']){
            $prie = $order['order_info_zj'] - $fav['price'];
            $strs .="优惠劵:-".$fav['price']."元,";
        }else{
            $prie = $order['order_info_zj'];
        }
        if($order['car_washing'] !=0){
            $str .="洗车:+50元";
            $strs .="洗车:+50元";
        }
        session('order',null);
        session('order',$order);
        $this -> assign('order',$order);
        $this -> assign("tclxr",explode(",",$order['order_info_tclxr']));
        $this -> assign("sclxr",explode(",",$order['order_info_sclxr']));
        $this -> assign("str",$str);
        $this -> assign("strs",$strs);
        $this -> assign("price",$prie);
        $this -> assign('user',$userInfo);
        $this -> assign('token',$token);
        $this -> display('Order:quick_step_four');
    }
    /**
     * 确认下单
     */
    public function orderInsert(){
        $order = session('order');
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        $objs = D("Worktwo");
        $time = date("Y-m-d H:i:s",time());
        $data['order_code'] = $objs->getTablecode("D");
        $data['user_code'] = $userInfo['tel'];
        $data['order_time'] = $time;
        $data['order_status'] = "S";
        $data['pay_status'] = 'W';
        $data['source'] = "B";
        $data['product_type'] = $order['product_type'];
        $data['pay_way'] = 'H';
        $data['order_way'] = 'S';
        $data['kefu_shi'] = 'N';
        $data['order_info_brand'] = $order['qsctez'];
        $data['order_info_type'] = $order['qsctcz'];
        $data['order_info_carmark'] = $order['order_info_carmark'];
        $data['order_info_price'] = $order['order_info_price']*100;
        $data['order_info_c_car'] = $order['lineprice']*100;
        $data['order_info_t_car'] = $order['tiz']*100;
        $data['order_info_s_car'] = $order['songz']*100;
        $data['order_smsc_car'] = $order['order_smsc_car']*100;
        $data['order_info_bxd'] = $order['order_info_bxd']*100;
        $data['order_info_smsc'] = $order['order_info_smsc'];
        $data['order_info_star'] = $order['qsrez'];
        $data['order_info_tclxr'] = $order['order_info_tclxr'];
        $data['order_info_sclxr'] = $order['order_info_sclxr'];
        $data['order_info_star_address'] = $order['order_info_star_address'];
        $data['order_info_end'] = $order['qerez'];
        $data['order_info_smscd'] = $order['order_info_smscd'];
        $data['order_info_end_address'] = $order['order_info_end_address'];
        $data['order_info_margin'] =$order['maoliz']*100;
        $data['car_washing'] =$order['car_washing']*100;
		$fav = $objs->getUserConpon($order['fav_code']);
		if($fav['flag']){
		    $data['order_info_zj'] = ($order['order_info_zj']-$fav['price'])*100;
		    $data['fav_code'] = $order['fav_code'];
		}else{
		    $data['order_info_zj'] = $order['order_info_zj']*100;
		}
		//print_log("------------------------".json_encode($data));die();
		$ret = $objs->setOrder($data);
		if($ret){
		    session('order',null);
		    $msg['code'] = $data['order_code'];
		    $msg['flag'] = true;
		}else{
		    $msg['flag'] = false;
		}
		$this->ajaxReturn($msg);
    }
    /**
     * 订单成功页面
     */
    public function suOrder(){
        $code = I("code");
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        $this->assign("info",D("Worktwo")->getOrderInfo($code));
        $this -> assign('user',$userInfo);
        $this->display("Order:su_order");
    }
    public function paynow(){
        $payway = I('post.payway');
        $fee = I('post.fee');
        $code = I('post.code');
        $datas['pay_way'] = $payway;
        $maps['order_code'] = array('eq',$code);
        M("order") ->where($maps)->save($datas);
        M("order_assistant") ->where($maps)->save($datas);
        if($payway=='Z'){
            //echo 111;
            $payobj = A('Payment');
            $configs = array(
                'return_url'	=>C("DOMAINNAME").'/Front/Payment/usersurl',	//服务器同步通知页面路径(必填)
                //'notify_url'	=>'',	//服务器异步通知页面路径(必填)     //若模块下配置文件已经配置则注释掉
                'out_trade_no'	=>$code,	//商户订单号(必填)
                'subject'		=>'妥妥运车支付',	//订单名称(必填)
                'total_fee'		=>$fee,	//付款金额(必填)
                'body'			=>'妥妥运车在线支付',	//订单描述
                //'show_url'		=>'',	//商品展示地址
            );
            //调用支付宝接口
            $payobj->alipayapi($configs);
        }else if($payway=='W'){
            $fee = $fee*100;
            $payobj = A('Payment');
            $payobj->wxpayapi($code,$fee);
        }else{
            $this->redirect('MyOrder/index');
        }
    }
    
}