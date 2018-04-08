<?php
namespace Back\Controller;
class FinanceyjhController extends BaseController{
    /**
     * 获取订单收入列表
     * @date: 2016-8-15 下午8:35:06
     * @author: liuxin
     */
    public function getOrderList(){
        $obj = D('OrderAssistant');
        $startDate = I('get.startDate');
        $endDate = I('get.endDate');
        //dump($startDate);
        $search = I('get.search');
        $list = $obj -> getFinanceList($search,$startDate,$endDate);
        //切割时间
		print_log("时间切割问题数据:".$list['list']['order_time']);
        
        
        $this -> assign('search',$search);
        $this -> assign('startDate',$startDate);
        $this -> assign('endDate',$endDate);
        
        $this -> assign('list',$list['list']);
        $this -> assign('page',$list['page']);
        $this -> assign('num',$list['num']);
        //取时间
        $time_now = explode("-",date('y-m-d'));
        $this -> assign('time_now',$time_now);
        $this -> display();
    }
   /**
    * 获取运单支出列表
    */
    public function getYunList(){
        $startDate = I('get.startDate');
        $endDate = I('get.endDate');
        //dump($startDate);
        $search = I('get.search');
        $date = I('get.date');
        $list = D("Yundan") -> getYunList($search,$startDate,$endDate);
        $this -> assign('search',$search);
        $this -> assign('startDate',$startDate);
        $this -> assign('endDate',$endDate);
        
        $this -> assign('list',$list['list']);
        $this -> assign('page',$list['page']);
        $this -> assign('num',$list['num']);
        $this->display();
    }
    /**
     * 获取保费支出列表
     */
    public function getBaoList(){
        $obj = D('OrderAssistant');
        $startDate = I('get.startDate');
        $endDate = I('get.endDate');
        $search = I('get.search');
        $date = I('get.date');
        $list = $obj -> getFinanceList($search,$startDate,$endDate);
        
        $this -> assign('search',$search);
        $this -> assign('startDate',$startDate);
        $this -> assign('endDate',$endDate);
        
        $this -> assign('list',$list['list']);
        $this -> assign('page',$list['page']);
        $this -> assign('num',$list['num']);
        //取时间
        $time_now = explode("-",date('y-m-d'));
        $this -> assign('time_now',$time_now);
        $this->display();
    }
    /**
     * 获取发票费用列表
     */
    public function getFaList(){
        $obj = D('OrderAssistant');
        $startDate = I('get.startDate');
        $endDate = I('get.endDate');
        $search = I('get.search');
        $date = I('get.date');
        $list = $obj -> getFinanceList($search,$startDate,$endDate);
        
        $this -> assign('search',$search);
        $this -> assign('startDate',$startDate);
        $this -> assign('endDate',$endDate);
        
        $this -> assign('list',$list['list']);
        $this -> assign('page',$list['page']);
        $this -> assign('num',$list['num']);
        //取时间
        $time_now = explode("-",date('y-m-d'));
        $this -> assign('time_now',$time_now);
        $this->display();
    }
    /**
     * 总揽
     */
    public function getTotalList(){
        $obj = D('OrderAssistant');
        $startDate = I('get.startDate');
        $endDate = I('get.endDate');
        $orderAllMoney=$obj->getOrderMoney($startDate,$endDate);
        $yunMoney = $obj->getYunMoney($startDate,$endDate);
        $orderBaoMoney = $obj -> getOrderBaoMoney($startDate,$endDate);
        $orderFaMoney = $obj -> getOrderFaMoney($startDate,$endDate);
        $this->assign("orderAllMoney",$orderAllMoney);
        $this->assign("yunMoney",$yunMoney);
        $this->assign("orderBaoMoney",$orderBaoMoney);
        $this->assign("orderFaMoney",$orderFaMoney);
        $this->display();
    }
    /**
     * 添加流水单
     */
    public function changeStatus(){
        $table=I("table");
        $status=I("status");
        $liuName=I("liuName");
        $number=I("number");
        $idName=I("idName");
        $id=I("id");
        $res = D('OrderAssistant')->changeStatus($table,$status,$liuName,$number,$idName,$id);
        if($res){
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "操作失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 订单添加订单流水
     */
    public function upOrderStatus(){
        $table=I("table");
        $status=I("status");
        $liuName=I("liuName");
        $number=I("number");
        $idName=I("idName");
        $admin = json_decode(des_decrypt_php(session('master')),true);
        $datas['admin_code'] = $admin['admin_name'];
        $id=I("id");
        $res = D('OrderAssistant')->upOrderStatus($table,$status,$liuName,$number,$idName,$id);
        if($res){
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "操作失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 订单导出
     */
    function daochu(){
        $code=I("get.code");
        $search='';
        $startDate='';
        $endDate='';
        //$code="TO1470658608M587,TO1473195216GH3P";
    
        $obj = D('OrderAssistant');
        $list = $obj -> getFinanceList($search,$startDate,$endDate,$code);
        
    
        $data['xlsName']  = "财务报表--导出".date("Y-m-d H:i:s",time());
        $data['xlsCell']  = array(
            array('order_id','订单id'),
            array('order_code','订单编号'),
            array('user_code','下单者手机号'),
            array('order_time','下单时间'),
            array('order_info_type','订单车型'),
            array('order_info_stars','出发地'),
            array('order_info_ends','目的地'),
            array('order_yun_price','运费'),
            array('order_info_bxd','保费'),
            array('bill_price','发票费'),
            array('income','代收方')
        );
        $list=$list['list'];
        for($i=0;$i<count($list);$i++){
            $data['xlsData'][$i]['order_id'] = $list[$i]['order_code'];
            $data['xlsData'][$i]['order_code'] = $list[$i]['order_code'];
            $data['xlsData'][$i]['user_code'] = $list[$i]['user_code'];
            $data['xlsData'][$i]['order_time'] = $list[$i]['order_time'];
            $data['xlsData'][$i]['order_info_type'] = $list[$i]['order_info_type'];
            $data['xlsData'][$i]['order_info_stars'] = $list[$i]['order_info_stars'][0].",".$list[$i]['order_info_stars'][1].",".$list[$i]['order_info_stars'][2];
            $data['xlsData'][$i]['order_info_ends'] = $list[$i]['order_info_ends'][0].",".$list[$i]['order_info_ends'][1];
            $data['xlsData'][$i]['order_yun_price'] = $list[$i]['order_yun_price'];
            $data['xlsData'][$i]['order_info_bxd'] = $list[$i]['order_info_bxd']/100;
            $data['xlsData'][$i]['bill_price'] = $list[$i]['bill_price']/100;
            $data['xlsData'][$i]['income'] = $list[$i]['income'];
        }
        exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
    
    }
    /**
     * 运单导出
     */
    function daochu_yun(){
        $code=I("get.code");
        $search='';
        $startDate='';
        $endDate='';
        //$code="TO1470658608M587,TO1473195216GH3P";
    
        $obj = D('Yundan');
        $list = $obj -> getYunList($search,$startDate,$endDate,$code);
    
    
        $data['xlsName']  = "财务报表--导出".date("Y-m-d H:i:s",time());
        $data['xlsCell']  = array(
            array('yd_code','运单号'),
            array('order_code','订单编号'),
            array('yd_time','日期'),
            array('order_info_type','车型'),
            array('order_info_carmark','车牌号'),
            array('yd_type','承运类型'),
            array('yd_name','承运人'),
            array('yd_line','承运路线'),
            array('yd_price','运费'),
            array('yd_status','是否支付'),
            array('yd_liu','流水号')
        );
        $list=$list['list'];
        for($i=0;$i<count($list);$i++){
            $data['xlsData'][$i]['yd_code'] = $list[$i]['yd_code'];
            $data['xlsData'][$i]['order_code'] = $list[$i]['order_code'];
            $data['xlsData'][$i]['yd_time'] = $list[$i]['yd_time'];
            $data['xlsData'][$i]['order_info_type'] = $list[$i]['order_info_type'];
            $data['xlsData'][$i]['order_info_carmark'] = $list[$i]['order_info_carmark'];
            $data['xlsData'][$i]['yd_type'] = $list[$i]['yd_type'];
            $data['xlsData'][$i]['yd_name'] = $list[$i]['yd_name'];
            $data['xlsData'][$i]['yd_line'] = $list[$i]['yd_line'];
            $data['xlsData'][$i]['yd_price'] = $list[$i]['yd_price']/100;
            $data['xlsData'][$i]['yd_status'] = empty($list[$i]['yd_status']) ? '否' : '是';
            $data['xlsData'][$i]['yd_liu'] = $list[$i]['yd_liu'];
        }
        exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
    
    }
}