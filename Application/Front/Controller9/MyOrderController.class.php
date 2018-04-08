<?php
namespace Front\Controller;

class MyOrderController extends BaseController {
    //订单列表
    public function index(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'));
        if($session_User['id']>0){
            //查询
        	//初始化Model
        	$mObj = D("MyOrder");
        	$myList = $mObj -> myOrder_list($session_User['tel']);
            $this -> assign('show',$myList['show']);
            $this -> assign('oList',$myList['list']);
            $this -> assign('num',$myList['number']);
            //进入页面
            $this->display("MyOrder:my_order");
        }else{
            //进入页面
            $this->display("Login:pc_login");
        }
    }
    /**
     * 订单详情页
     */
    function orderInfo(){
    	//取session判断其是否登录
    	$orderCode = I("orderCode");
    	$session_User = jiema(session('userData'));
    	if($session_User['id']>0){
    		//查询
    		//初始化Model
    		$mObj = D("MyOrder");
    		$myVo = $mObj -> myOrder_info($orderCode);
    		$this->assign("fname",explode(",", $myVo['order_info_tclxr']));
    		$this->assign("sname",explode(",",$myVo['order_info_sclxr']));
    		$this -> assign('info',$myVo);
    		//进入页面
    		$this->display("MyOrder:my_order_info");
    	}else{
    		//进入页面
    		$this->display("Login:pc_login");
    	}
    }
    /**
     * 承运保单列表
     */
    public function policyList(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'));
        if($session_User['id']>0){
            //查询
        	//初始化Model
        	$mObj = D("MyOrder");
        	$myList = $mObj -> myOrder_list($session_User['tel']);
            $this -> assign('show',$myList['show']);
            $this -> assign('oList',$myList['list']);
            $this -> assign('num',$myList['number']);
            //进入页面
            $this->display("MyOrder:my_policy");
        }else{
            //进入页面
            $this->display("Login:pc_login");
        }
    }
    /**
     * 验车照片
     */
    function verifyCar(){
        //$session_User = jiema(session('userData'));
        //if($session_User['id']>0){
            //查询
            $code = I("code");
            $ret = D("MyOrder")->verifyCar($code);
            $this->assign("ret",$ret);
            $this->display("MyOrder:verify_car");
        //}else{
            //进入页面
        //    $this->display("Login:pc_login");
        //}
    }
    /**
     * 委托合同列表
     */
    public function entrustList(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'));
        if($session_User['id']>0){
            //查询
            //初始化Model
            $mObj = D("MyOrder");
            $myList = $mObj -> myOrder_list($session_User['tel']);
            $this -> assign('show',$myList['show']);
            $this -> assign('oList',$myList['list']);
            $this -> assign('num',$myList['number']);
            //进入页面
            $this->display("MyOrder:my_entrust");
        }else{
            //进入页面
            $this->display("Login:pc_login");
        }
    }
    /**
     * 位置列表
     */
    public function positionList(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'));
        if($session_User['id']>0){
            //查询
            //初始化Model
            $mObj = D("MyOrder");
            $myList = $mObj -> myOrder_list($session_User['tel']);
            $this -> assign('show',$myList['show']);
            $this -> assign('oList',$myList['list']);
            $this -> assign('num',$myList['number']);
            //进入页面
            $this->display("MyOrder:my_position");
        }else{
            //进入页面
            $this->display("Login:pc_login");
        }
    }
    //订单列表
    public function orderList($type,$code){
        //初始化Model
        $mObj = D("MyOrder");
        $myList = $mObj -> myOrder_list($type,$code);
        return $myList;
    }
    
    public function payNow(){
        $code = I('get.code');
        $total = I('get.fee');
		$bxd = I('get.bxd')==""?0:I('get.bxd');
		$smsc_car = I('get.smsc_car');
		
		$data['all_price'] = $total-$bxd;
		$data['sprice'] = $bxd;
		$data['total'] = $total;
		$data['visit'] = $smsc_car;
        $this -> assign('code',$code);
        $this -> assign('fee',$total);
		$this -> assign('bxd',$bxd);
		$this -> assign('yunfei',$total-$bxd);
		$this -> assign('order',$data);
        $this -> display('MyOrder:paynow');
    }
}