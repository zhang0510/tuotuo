<?php
namespace Back\Controller;
class FinanceController extends BaseController{
    public function getFinanceList(){
        /**
         * 获取财务列表
         * @date: 2016-8-15 下午8:35:06
         * @author: liuxin
         */
        $obj = D('Order');
        $startDate = I('get.startDate');
        $endDate = I('get.endDate');
        //dump($startDate);
        $search = I('get.search');
        $date = I('get.date');
        $list = $obj -> getFinanceList($search,$startDate,$endDate);
        //切割时间
		print_log("时间切割问题数据:".$list['list']['order_time']);
        $ls_time = explode(" ",$list['list']['order_time']);
        $order_time = explode("-",$ls_time[0]);
        $list['list']['time_A'] = $order_time[0];
        $list['list']['time_B'] = $order_time[1];
        $list['list']['time_C'] = $order_time[2];
        $this -> assign('search',$search);
        $this -> assign('startDate',$startDate);
        $this -> assign('endDate',$endDate);
        $this -> assign('list',$list['list']);
        $this -> assign('page',$list['page']);
        $this -> assign('num',$list['num']);
        //取时间
        $time_now = explode("-",date('y-m-d'));
        $this -> assign('time_now',$time_now);
        $this -> display('Finance:finance_manage');
    }
    /**
     * 查看财务详情
     * @date: 2016-8-15 下午8:35:56
     * @author: liuxin
     */
    public function checkFinance(){
        $id = I('get.id');
        $obj = D('Order');
        $list = $obj -> getFinanceInfo($id);
        $this -> assign('list',$list);
        $this -> display('Finance:check_finance');
    }
    /**
     * 更改运单状态
     * @date: 2016-8-15 下午8:36:14
     * @author: liuxin
     */
    public function change(){
        $code = I('post.code');
        $status = I('post.status');
        $mark = I('post.mark');
        $obj = D('Order');
        $res = $obj -> change($code,$status,$mark);
        if($res){
            $data['sign'] = 'Y';
            $data['con'] = '修改成功';
        }else{
            $data['sign'] = 'N';
            $data['con'] = '修改失败';
        }
        $this -> ajaxReturn($data);
    }
    /**
     * 更改其他费用
     * @date: 2016-8-15 下午8:37:09
     * @author: liuxin
     */
    public function inputFee(){
        $id = I('post.id');
        $fee = I('post.fee');
        $obj = D('Order');
        $res = $obj -> inputFee($id,$fee);
        if($res){
            $data['sign'] = 'Y';
            $data['con'] = '修改成功';
        }else{
            $data['sign'] = 'N';
            $data['con'] = '修改失败';
        }
        $this -> ajaxReturn($data);
    }
	
	
	function daochu(){
		$code=I("get.code");
		$search='';
		$startDate='';
		$endDate='';
		//$code="TO1470658608M587,TO1473195216GH3P";
		
		$obj = D('Order');
		$list = $obj -> getFinanceList($search,$startDate,$endDate,$code); 
	
	
	    $data['xlsName']  = "财务报表--导出".date("Y-m-d H:i:s",time());
	    $data['xlsCell']  = array(
	        array('order_id','订单编号'),
	        array('order_user','下单者'),
	        array('order_tel','下单者手机号'),
	        array('order_time','下单时间'),
	        array('order_carType','订单车型'),
	        array('order_financeTotal','订单总金额'),
	        array('order_ydId','运单编号'),
	        array('order_ydUser','承运人'),
	        array('order_ydStar','出发地'),
	        array('order_ydEnd','目的地'),
	        array('order_ydPrice','费用'),
	        array('order_ydStatus','状态')
	    );
		$list=$list['list'];
		for($i=0;$i<count($list);$i++){
	        $data['xlsData'][$i]['order_id'] = $list[$i]['order_code'];
	        $data['xlsData'][$i]['order_user'] = $list[$i]['user_name'];
	        $data['xlsData'][$i]['order_tel'] = $list[$i]['user_tel'];
	        $data['xlsData'][$i]['order_time'] = $list[$i]['order_time'];
	        $data['xlsData'][$i]['order_carType'] = $list[$i]['orderInfo']['order_info_type'];
	        $data['xlsData'][$i]['order_financeTotal'] = $list[$i]['orderInfo']['order_info_zj']/100;
	        $data['xlsData'][$i]['order_ydId'] = $list[$i]['yundan'][0]['yd_code'];
			$data['xlsData'][$i]['order_ydUser'] = $list[$i]['yundan'][0]['yd_name'];
	        $data['xlsData'][$i]['order_ydStar'] = $list[$i]['yundan'][0]['yd_star'];
	        $data['xlsData'][$i]['order_ydEnd'] = $list[$i]['yundan'][0]['yd_end'];
	        $data['xlsData'][$i]['order_ydPrice'] = $list[$i]['yundan'][0]['yd_price']/100;
			if($list[$i]['yundan'][0]['yd_status'] == "Y"){
				$data['xlsData'][$i]['order_ydStatus'] ="已支付";
			}else{
				$data['xlsData'][$i]['order_ydStatus'] ="未支付";
			}

	    }
		exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);

	}
}