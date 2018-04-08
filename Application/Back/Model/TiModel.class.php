<?php
namespace Back\Model;
class TiModel extends BaseModel{
	/*
	 * 获取所有出发地数据
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	public function getInfo(){
		
	}
	
	/*
	 * 出发地分页以及搜索
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	Public function getPage($star){
		if (!empty($star)) $where['ti_star'] = array('like',$star.','.'%');
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->order("ti_id desc")->limit($page->limit)->select();
		return $info;
	}
	
	public function getPages($star='',$sign=''){
	    if($sign){
	        if($star){
	            $map['ti_star'] = array('like',$star.'%');
	        }else{
	            $map[] = '1=1';
	        }
	    }else{
	        $map['ti_star'] = array('eq',$star);
	    }
	    $num = $this->where($map)->count();
	    $page = set_page($num,10);
	    $info['page'] = $page -> Backpage();
	    $info['list'] = $this->where($map)->limit($page->limit)->select();
	    return $info;
	}
	/*
	 * 根据起始数据和结束数据查询初始地数据
	 * @date 2016-8-9
	 * @author yao
	 * @param
	 * return array
	 */
	public function verify($star,$end){
		if (empty($star) or empty($end)) return "参数错误！";
		$where['ti_star'] = $star;
		$where['ti_end'] = $end;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	/*
	 * 根据起始数据查询初始地数据
	 * @date 2016-8-9
	 * @author yao
	 * @param
	 * return array
	 */
	public function star($star){
		if (empty($star)) return "参数错误！";
		$where['ti_star'] = $star;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	
}