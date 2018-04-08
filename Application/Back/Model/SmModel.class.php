<?php
namespace Back\Model;
class SmModel extends BaseModel{
	/*
	 * 获取所有上门送车地数据
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	public function getInfo(){
	
	}
	
	/*
	 * 上门送车地分页以及搜索
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	Public function getPage($end){
		if (!empty($end)) $where['sm_end'] = $end;
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->limit($page->limit)->select();
		return $info;
	}
	
	public function getPages($star='',$sign=''){
	    if($sign){
	        if($star){
	            $map['sm_end'] = array('like',$star.'%');
	        }else{
	            $map[] = '1=1';
	        }
	    }else{
	        $map['sm_end'] = array('eq',$star);
	    }
	    $num = $this->where($map)->count();
	    $page = set_page($num,10);
	    $info['page'] = $page -> Backpage();
	    $info['list'] = $this->where($map)->limit($page->limit)->select();
	    return $info;
	}
	/*
	 * 根据起始数据和结束数据查询上门送车地数据
	 * @date 2016-8-9
	 * @author yao
	 * @param
	 * return array
	 */
	public function verify($star,$end){
		if (empty($star) or empty($end)) return "参数错误！";
		$where['sm_star'] = $star;
		$where['sm_end'] = $end;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	
}