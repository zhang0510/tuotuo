<?php
namespace Back\Model;
class YundanModel extends BaseModel{
	public function addYunDan($data){
	    $y_Obj = M("yundan");
	    $result = $y_Obj -> add($data);
	    return $result;
	}
	/**
	 * 获取运单列表（通过可选条件）
	 */
	public function getYunList($search='',$startDate='',$endDate='',$code=''){
	    $map[] = '1=1';
	    if($search!=''){
	        $map_['order_code'] = array('like','%'.$search.'%');
	        $map_['yd_code'] = array('like','%'.$search.'%');
	        $map_['yd_liu'] = array('like','%'.$search.'%');
	        $map_['yd_name'] = array('like','%'.$search.'%');
	        $map_['_logic'] = 'or';
	        $map['_complex'] = $map_;
	    }
	    if($startDate!=''&&$endDate!=''){
	        $map['yd_time'] = array('between',array($startDate,$endDate));
	    }
	    if($code!=''){
	        $arr=explode(",",$code);
	        $where['yd_code']=array('IN',$arr);
	        $Tnum = $this ->  where($where) -> count();
	        $Tlist = $this ->  where($where) ->order("yd_time desc") -> select();
	    }else{
	        $Tnum = $this ->  where($map) -> count();
	        $page = set_page($Tnum,10);
	        $Tlist = $this ->  where($maps) -> limit($page->limit) ->order("yd_time desc") -> select();
	        $data['page'] = $page -> BackPage();
	    }
	    $arr=array(
	        'A' => '提车',
	        'B' => '提短',
	        'C' => '公司发运',
	        'D' => '个人发运',
	        'E' => '交车'
	    );
	    $objs = M("order_assistant");
	    
	    foreach ($Tlist as &$va){
	        $order_code=$va['order_code'];
	        $res=$objs->where("order_code='".$order_code."'")->field("order_info_type,order_info_carmark")->find();
	        $va['pay_name'] = $this->where(array("yd_code"=>array('eq',$va['yd_pay_code'])))->find()['yd_name'];
	        $va['order_info_type']=$res['order_info_type'];
	        $va['order_info_carmark']=$res['order_info_carmark'];
	        $yd_type=$va['yd_type'];
	        $va['yd_type']=$arr[$yd_type];
	    }
	    $data['num'] = $Tnum;
	    $data['list'] = $Tlist;
	    return $data;
	}
}