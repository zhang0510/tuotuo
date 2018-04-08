<?php
namespace Back\Model;
class CarxingModel extends BaseModel{
	/*
	 * 获取车型加价数据
	 * @date 2016-8-6
	 * @author yao
	 * @param
	 * return array
	 */
	public function getInfo(){
	
	}
	
	/*
	 * 车型加价分页以及搜索
	 * @date 2016-8-6
	 * @author yao
	 * @param
	 * return array
	 */
	Public function getPage($cxjj_type,$type){
		$where['cxjj_type'] = $cxjj_type;
		if (!empty($type)) $where['cxjj_id'] = $type;
		$where['cxjj_price'] = array('neq','');
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->limit($page->limit)->select();
		return $info;
	}
	Public function getPages($where){
	    
	    $num = $this->where($where)->count();
	    $page = set_page($num,10);
	    $info['page'] = $page -> Backpage();
	    $info['list'] = $this->where($where)->limit($page->limit)->select();
	    return $info;
	}
	
	/*
	 * 根据车id获取车型信息
	 * @date 2016-8-8
	 * @author yao
	 * @param  $cxjj_id 车型的ID
	 * return array
	 */
	public function getData($cxjj_id){
		$where['cxjj_id'] = $cxjj_id;
		$data = $this->where($where)->find();
		return $data;	
	}
	
	
	/*
	 * 通过id获取所有子id
	 */
	public function getAll($pid){
		$where['cxjj_pid'] = $pid;
		$info = $this->where($where)->select();
		$a = $this->getLastSql();
		print_log($a);
		return $info;
	}
	/*
	 * 通过id获取所有子id
	 */
	public function by_getCarx($name,$pid){
	    $where['cxjj_pid'] = $pid;
	    if($name !=''){
	        $where['cxjj_brand'] =array('like','%'.$name.'%');
	    }
	    $info = $this->where($where)->select();
	    $a = $this->getLastSql();
	    print_log($a);
	    return $info;
	}
	
	/*
	 * 通过id获取所有子id
	 */
	public function getSon($pid){
		$where['cxjj_pid'] = $pid;
		$info = $this->where($where)->select();
		return $info;
	}
	
}