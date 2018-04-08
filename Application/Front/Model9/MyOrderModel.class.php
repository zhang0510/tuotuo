<?php
namespace Front\Model;
class MyOrderModel extends BaseModel{
    //查询列表
    function myOrder_list($tel){
        //初始化
        $myOrder = array();
        $o_M = M("order_assistant");
        $area = M("area");
        $poObj = M("position_tracking_record");//位置跟踪
        $bObj = M("bxd");//保险单
        //拼装条件
        $map['user_code'] = array('eq',$tel);
        $map['sh_status'] = array('neq','N');
        //计算总数
        $myOrder['number'] = $o_M -> where($map) -> count();
        //计算页数
        $page = set_page( $myOrder['number'], 8);
        //查询订单表
        $list = $o_M -> where($map) ->field('order_code,order_status,order_info_star,order_info_end,order_info_type')-> order('order_time desc') -> limit($page->limit) -> select();
        $count = count($list);
        for($i=0;$i<$count;$i++){
        	$start = explode(",",$list[$i]['order_info_star'])[1];
        	$end = explode(",",$list[$i]['order_info_end'])[1];
        	$map1['area_id'] = array("eq",$start);
        	$map2['area_id'] = array("eq",$end);
        	$objStart = $area->where($map1)->field('area_name')->find();
        	$objEnd = $area->where($map2)->field('area_name')->find();
        	$list[$i]['start_name'] = $objStart['area_name'];
        	$list[$i]['end_name'] = $objEnd['area_name'];
        	$map3['order_code'] = array('eq',$list[$i]['order_code']);
        	$list[$i]['posit'] = $poObj->field("time,content") ->where($map3)->order("time desc")->select();
            //$list[$i]['bxd'] = $bObj ->where($map3) ->getField("bxd_file");
        }
        $myOrder['list']=$list;
        //分页条
        $myOrder['show'] = $page->FrontPage();
        //返回结果
        return $myOrder;
    }
    
    function myOrder_info($orderCode=""){
    	$o_M = M("order_assistant");
    	$area = M("area");
    	$faObj = M("favorable");
    	$bObj = M("bxd");//保险单
    	//拼装条件
    	$map['order_code'] = array('eq',$orderCode);
    	$orderVo = $o_M -> where($map)->find();
    	//出发地，目的地 省市区编号转汉字
    	$start = explode(",",$orderVo['order_info_star'])[1];
    	$end = explode(",",$orderVo['order_info_end'])[1];
    	$map1['area_id'] = array("eq",$start);
    	$map2['area_id'] = array("eq",$end);
    	$objStart = $area->where($map1)->field('area_name')->find();
    	$objEnd = $area->where($map2)->field('area_name')->find();
    	$orderVo['start_name'] = $objStart['area_name'];
    	$orderVo['end_name'] = $objEnd['area_name'];
    	$orderVo['order_smsc_car'] = $orderVo['order_smsc_car']/100;
    	$orderVo['car_washing'] = $orderVo['car_washing']/100;
    	$orderVo['order_info_zj'] = $orderVo['order_info_zj']/100;
    	if($orderVo['fav_code']!=null&&$orderVo['fav_code']!=""){
	    	$map3['fav_code'] = array("eq",$orderVo['fav_code']);
	    	$faVo = $faObj->where($map3)->find();
	    	if($faVo['fav_price']!=""&&$faVo['fav_price']!=null){
	    		$orderVo['fav_price'] = $faVo['fav_price']/100;
	    	}
    	}
    	$orderVo['bxd'] = $bObj ->where($map) ->getField("bxd_file");
    	return $orderVo;
    }
    /**
     * 查询验车信息
     * @param string $code 订单code
     */
    public function verifyCar($code=''){
        $vcObj = M("verify_car_info");
        $vciObj = M("verify_car_img");
        $map['order_code'] = array('eq',$code);
        $ret = $vcObj->where($map)->find();
        $res = $vciObj->field("verify_img_upload")->where($map)->select();
        $ret['imgs'] = $res;
        return $ret;
    }
}