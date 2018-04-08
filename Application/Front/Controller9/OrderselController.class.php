<?php
namespace Front\Controller;

class OrderselController extends BaseController { 
    //个人信息
    public function orderselView(){
		$status=I("status")==""||I("status")==null?1:I("status");
		$this->assign("status",$status);
		$key = I("keyword");
		if($status==1){
		    $this->assign("keyword",$key);
		    $this->display("WaybillQuery:waybill_query");
		}else{
		    $this->waybill();
		}
		
    }
	
	function selList(){
		$code=I("post.keyword");
		//$code="TO";
		$order=M("yundan");
		$map['order_code']=array("like","%$code%");
		
		$list=$order->where($map)->group("order_code")->select();
		//var_dump($list);
		$this->ajaxReturn($list);
	}
	
	function waybill(){
		$keyword=I("keyword");
		//$keyword="TO1470658608M587";
		$wuliu=M("position_tracking_record");
		$map['order_code']=array("eq",$keyword);
		$map['content']=array("neq"," ");
		$waylist=$wuliu->where($map)->order("time desc")->select();
		//var_dump($waylist);
		$status=2;
		$this->assign("status",$status);
		$this->assign("keyword",$keyword);
		$this->assign("wayList",$waylist);
        $this->display("WaybillQuery:waybill_query");
	}
    
	   public function query(){
		$status=1;
		$this->assign("status",$status);
        $this->display("WaybillQuery:query");
    }

}