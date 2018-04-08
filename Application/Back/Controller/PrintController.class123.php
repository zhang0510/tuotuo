<?php
namespace Back\Controller;
use Think\Controller;
class PrintController extends Controller {
	
	/**
	 * 打印测试  财务支付凭证(已废弃 再问自杀!)
	 */
	function print_Pay($yd_code,$order_code,$star,$end,$order_time,$yd_name){
	    $c_obj = M('cwgl');
	    $map['order_code'] = array('eq',$order_code);
	    $total  = $c_obj -> where($map) -> find();
	    $list['print_Title'] = "财务支付凭证";
	    $list['yd_code'] = $yd_code;
	    $list['order_code'] = $order_code;
	    $list['star'] = $star;
	    $list['end'] = $end;
	    $o_Time = explode(" ",$order_time);
	    $list['order_time'] = explode("-",$o_Time[0]);
	    $list['time'] = explode("-",date('y-m-d'));
	    $list['yd_name'] = $yd_name;
	    $list['total'] = $total['cwgl_price'];
	    $this -> assign('list',$list);
		$this->display("Print:print");
	}
	/**
	 * 打印测试  运车服务合同
	 */
	function printpact(){
	    $p_Obj = D('Print');
	    $order_code = remove_xss(I("order_code"));
	    $result = $p_Obj -> printPact($order_code);
	    $this -> ajaxReturn($result);
	}
	/**
	 * 打印测试  承运底单
	 */
	function printKept(){
	    $p_Obj = D('Print');
		$yd_code = remove_xss(I("yd_code"));
	    $order_code = remove_xss(I("order_code"));
	    $result = $p_Obj -> printKept($order_code,$yd_code);
	    $this -> ajaxReturn($result);
	}
	
	/**
	 * 打印测试  提车单
	 */
	function printAskToGet(){
	    $p_Obj = D('Print');
	    $order_code = remove_xss(I("order_code"));
	    $result = $p_Obj -> printAskToGet($order_code);
	    $this -> ajaxReturn($result);
	}
	
	
	function printShape(){
		$row = I("row");
		$col = I("col");
		$shape = I("shape");
		switch ($shape){
			case 'a':
				for ($i=1;$i<$row;$i++){
					for ($j=0;$j<$col;$j++)
						echo "*";
						echo "<br/>";
				}
				break;
				 
			 case 'b':
				for ($i=1;$i<$row;$i++){
					for ($j=0;$j<$i;$j++)
						echo "*";
						echo "<br/>";
				}
			break;
		 
			case 'c':
				for ($i=1;$i<$row;$i++){
					for ($k=0;$k<$col-$i;$k++)
						echo "&nbsp";
						for ($j=0;$j<2*$i-1;$j++)
							echo "*";
							// for ($k=0;$k<round(($col-$i)/2);$k++)
							// echo " ";
							echo "<br/>";
				}
			break;
			 
			case 'd':
			for ($i=1;$i<=$row;$i++){
			for ($k=0;$k<$col-$i;$k++)
				echo "&nbsp";
				//第一行和最后一行不用控制
				if ($i==1 || $i==$row){
					for ($j=1;$j<=2*$i-1;$j++)
					echo "*";
					echo "<br/>";
				}else{
				for ($j=1;$j<=2*$i-1;$j++){
					if ($j==1 || $j==2*$i-1 ){
						echo "*";
					}else{
						echo "&nbsp";
					}
				}
					echo "<br/>";
				}
				}
				break;
							 
				default:
				echo "您没有输入图形";
				break;
				}

		}
}