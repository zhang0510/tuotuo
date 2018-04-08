<?php
namespace Front\Model;
class OrderDetailModel extends BaseModel{
    //查询列表
    function Order_Detail($order_code){
        if ($order_code!=""){
            //初始化
            //订单表
            $o_M = M("order");
            //订单详细表
            $oi_M = M("order_info");
            //地图表
            $a_M = M("area");
            //物流表
            $w_M = M("wuliu");
            //优惠券表
            $f_M = M("favorable");
            //运单表
            $y_M = M("yundan");
            //保险单
            $b_M = M("bxd");
            //声明变量
            $carList = array();
            //拼装条件
            $map['order_code'] = array('eq',$order_code);
            
            //查询订单表
            $order = $o_M -> where($map) -> find();
            //查询订单详细表
            $order_info = $oi_M -> where($map) -> select();
            
            //查询物流表
            $wuliu = $w_M -> where($map) -> find();
            //查询运单表
            $yundan = $y_M -> where($map) -> find();
            //
            $bxd = $b_M -> where($map) -> find();
            //拼装条件
            $map['fav_code'] = array('eq',$order_info[0]['fav_code']);
            //查询优惠表
            $favorable = $f_M -> where($map) -> find();
            
            //判断起始地
            if ($order_info[0]['order_info_star']!="" && $order_info[0]['order_info_star']!=null){
                //获取起始地参数
                $star = explode(",",$order_info[0]['order_info_star']);
                //查询起始地名称
                for($i=0;$i<count($star);$i++){
                    $map['area_id'] = array('eq',$star[$i]);
                    $startList[$i]= implode($a_M -> where($map)->field('area_name')->find());
                    $startList[$i] = $startList[$i].'-';
                }
                $myOrder['start'] = trim(implode($startList),'-');
            }else {
                $myOrder['start'] ="暂无";
            }
            
            //判断结束地
            if ($order_info[0]['order_info_end']!="" && $order_info[0]['order_info_end']!=null){
                //获取结束地参数
                $end = explode(",",$order_info[0]['order_info_end']);
                //查询起始地名称
                for($j=0;$j<count($end);$j++){
                    $map['area_id'] = array('eq',$end[$j]);
                    $endList[$j]= implode($a_M -> where($map)->field('area_name')->find());
                    $endList[$j] = $endList[$j].'-';
                }
                $myOrder['end'] = trim(implode($endList),'-');
            }else {
                $myOrder['end'] ="暂无";
            }
            
            //订单ID
            $myOrder['id']  =   $order['order_id'];
            
            //订单CODE
            $myOrder['order_code'] = $order['order_code'];
            
            //支付状态
            $myOrder['pay_status'] = $order['pay_status'];
			
			//是否货到付款
            $myOrder['pay_way'] = $order['pay_way'];
            
            //提车人CODE
            $myOrder['c_code']  =   $order['car_code'];
            
            //订单状态
            $myOrder['status']  =  $order['order_status'];
            
            //发车人信息
            if($order_info[0]['order_info_tclxr']!="" && $order_info[0]['order_info_tclxr']!=null){
                $startInfo = explode(",",$order_info[0]['order_info_tclxr']);
                $myOrder['star_name'] = $startInfo[0];
                $myOrder['star_tel'] = $startInfo[2];
                $myOrder['star_iden'] = $startInfo[1];
            }else {
                $myOrder['star_name'] = "";
                $myOrder['star_tel'] = "";
                $myOrder['star_iden'] = "";
            }
            
            //发车地址
            $myOrder['star_address'] = $order_info[0]['order_info_star_address'];
            
            //收车人信息
            if($order_info[0]['order_info_sclxr']!="" && $order_info[0]['order_info_sclxr']!=null){
                $end = explode(",",$order_info[0]['order_info_sclxr']);
                $myOrder['end_name'] = $end[0];
                $myOrder['end_tel'] = $end[2];
                $myOrder['end_iden'] = $end[1];
            }else {
                $myOrder['end_name'] = "";
                $myOrder['end_tel'] = "";
                $myOrder['end_iden'] = "";
            }
            
            //收车地址
            $myOrder['end_address'] = $order_info[0]['order_info_end_address'];
            
            //循环读取订单信息
            for ($i=0;$i<count($order_info);$i++){
                //车牌号
                $carList[$i]['carmark'] = $order_info[$i]['order_info_carmark'];
                //车型
                $carList[$i]['car_type'] = $order_info[$i]['order_info_type'];
                
                //车品牌
                $carList[$i]['car_name'] = $order_info[$i]['order_info_brand'];
                
                //车价格
                if ($order_info[$i]['order_info_price']!="" && $order_info[$i]['order_info_price']!=null){
                    $carList[$i]['car_price'] = $order_info[$i]['order_info_price']/1000000;
                }
                
                //运输价格
                if ($order_info[$i]['order_info_smsc']!="" && $order_info[$i]['order_info_smsc']!=null){
                    if ($order_info[$i]['order_info_smsc']=="Y"){
                        $sumPrice = $order_info[$i]['order_info_t_car']+$order_info[$i]['order_info_c_car']+$order_info[$i]['order_info_s_car']+$order_info[$i]['order_smsc_car']+$order_info[$i]['order_info_margin'];
                        $carList[$i]['sumPrice'] = $sumPrice/100;
                    }else{
                        $sumPrice = $order_info[$i]['order_info_t_car']+$order_info[$i]['order_info_c_car']+$order_info[$i]['order_info_s_car']+$order_info[$i]['order_info_margin'];
                        $carList[$i]['sumPrice'] = $sumPrice/100;
                    }
                }else{
                    $carList[$i]['sumPrice'] = 0;
                }
                $carList[$i]['bxf'] = $order_info[$i]['order_info_bxd']/100;
                $carList[$i]['carxing'] = $order_info[$i]['order_info_add_price']/100;
               
                
                //送车价格
                if ($order_info[$i]['order_info_s_car']!="" && $order_info[$i]['order_info_s_car']!=null){
                    $carList[$i]['sendCar'] = $order_info[$i]['order_info_s_car']/100;
                }else{
                    $carList[$i]['sendCar'] = 0;
                }
                
                
                //优惠券
                if ($favorable['fav_price']>0){
                    $carList[$i]['fav'] = $favorable['fav_price']/100;
                }else {
                    $carList[$i]['fav'] = 0;
                }
                
            }
            $myOrder['total'] = $order_info[0]['order_info_zj']/100;
            //订单信息数量
            $myOrder['carList'] = $carList;
            
            //下单时间
            $myOrder['cTime'] = $order['order_time'];
            
            //付款时间
            $myOrder['pTime'] = $order_info[0]['pay_time'];
            
            //收车时间
            $myOrder['sTime'] = $yundan['yd_s_time'];
            
            //物流信息
            $wl_time=null;
            if(count($wuliu)>0){
	            $wl_time = explode(" ",$wuliu['wl_time']);
            }
            
            //替换物流日期
            $weekarray=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");
            $myOrder['wlday'] = $wl_time==null?"":$wl_time[0];
            $myOrder['week'] = $wl_time==null?"":$weekarray[date("w",$wl_time[0])];
            $myOrder['wlTime'] = $wl_time==null?"":$wl_time[1];
            
            //物流信息
            $myOrder['info'] = $wuliu['wl_info'];
            
            //保险单下载
            $myOrder['bxd'] = $bxd['bxd_file']==""||$bxd['bxd_file']==null?"":$bxd['bxd_file'];
            if($myOrder['bxd']!=''){
                $myOrder['bxd'] = str_replace('/', '_', $myOrder['bxd']);
            }
        }
        
        //返回结果
        return $myOrder;
    }
    
    //取消订单&&退款
    function Order_Del($order_code,$type){
        //初始化变量
        $order['result'] = 0;
        //判断类型
        if($type == "C"){
            $info ="取消订单";
        }else if ($type == "R"){
            $info ="退款申请";
        }
        //初始化订单表
        $o_M = M("order");
        //拼装条件
        $map['order_code'] = array('eq',$order_code);
        //查询是否重复
        $selOrder = $o_M -> where($map) -> find();
        if ($selOrder['pay_status']=="W" && $type == "R"){
            $order['info'] = "您尚未付款!不能".$info;
            return $order;
        }
        if($selOrder['order_status']==$type){
            $order['info'] = $info."已提交过!";
            return $order;
        }
        //组装值
        $data = array(
            'order_status' => $type
        );
        //开始更新状态
        $order['result'] = $o_M -> where($map) -> save($data);
        if($order['result']){
            $order['info'] = $info."提交成功!";
        }else{
            $order['info'] = $info."提交失败!";
        }
        return $order;
    }
    /**
     * 获取订单状态
     * @date: 2016-9-27 下午3:01:40
     * @author: liuxin
     */
    public function getOrderStatus($order_code=''){
        if($order_code!=''){
            $map['order_code'] = array('eq',$order_code);
            $status = M('order') -> where($map) -> find();
        }else{
            $status['order_status'] = 'E';
        }
        return $status['order_status'];
    }
}