<?php
namespace Front\Controller;

class OrderDetailController extends BaseController {
    public function index(){
		$order_code = I("order_code");
        //取session判断其是否登录
        $session_User = jiema(session('userData'));
        if($session_User['id']>0){
            if ($order_code!=""){
                //查询
                $oDetail = $this->orderDetail($order_code);
                $carList = $oDetail['carList'];
                $status = D("OrderDetail") -> Order_Detail($order_code);
                $this -> assign('carList',$carList);
                $this -> assign('order',$oDetail);

				$this -> assign('status',$status);
                $this->display("OrderDetail:order_detail");

            }else{
                $this->display("HomePage:home_page");
            }
        }else{
            //进入页面
            $this->display("Login:pc_login");
        }
    }
    //订单列表
    public function orderDetail($order_code=""){
		if ($order_code!=""){
			//初始化Model
			$mObj = D("OrderDetail");
			$orderDetail = $mObj -> Order_Detail($order_code);
		}else{
			$orderDetail="";
		}
        return $orderDetail;
    }
    
    //取消订单or退款
    public function delOrder(){
		$order_code = I("order_code");
		$type = I("type");
        if ($type!="" && order_code!=""){
            //初始化Model
            $mObj = D("OrderDetail");
            $orderDel = $mObj -> Order_Del($order_code,$type);
            $this-> ajaxReturn($orderDel);
        }
    }
    /**
     * 文件下载（一）
     * @date: 2016-10-9 下午2:43:07
     * @author: liuxin
     */
    public function downloads(){
        $name = I('get.name');
        $file_url = $_SERVER['DOCUMENT_ROOT'].str_replace('_', '/', $name);
        $name = '';
        $this -> download($file_url,$name);
    }
    /**
     * 文件下载（二）
     * @date: 2016-10-9 下午2:43:07
     * @author: liuxin
     */
    public function download($file_url,$new_name=''){
        if(!isset($file_url)||trim($file_url)==''){
            return '500';
        }
        if(!file_exists($file_url)){ //检查文件是否存在
            return '404';
        }
        $file_name=basename($file_url);
        $file_type=explode('.',$file_url);
        $file_type=$file_type[count($file_type)-1];
        $file_name=trim($new_name=='')?$file_name:urlencode($new_name);
        $file_type=fopen($file_url,'r'); //打开文件
        //输入文件标签
        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: ".filesize($file_url));
        header("Content-Disposition: attachment; filename=".$file_name);
        //输出文件内容
        echo fread($file_type,filesize($file_url));
        fclose($file_type);
    }
}