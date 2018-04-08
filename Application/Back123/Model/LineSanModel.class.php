<?php
namespace Back\Model;
class LineSanModel extends BaseModel{
	/*
	 * 获取所有集散地数据
	 * @date 2016-8-6
	 * @author yao
	 * @param
	 * return array
	 */
	public function getInfo(){
		
	}
	
	/*
	 * 集散地分页以及搜索
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	Public function getPage($star){
		if (!empty($star)) $where['san_star'] = $star;
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->limit($page->limit)->select();
		return $info;
	}
	
	public function getPages($star='',$sign=''){
	    if($sign){
	        if($star){
	            $map['san_star'] = array('like',$star.'%');
	        }else{
	            $map[] = '1=1';
	        }
	    }else{
	        $map['san_star'] = array('eq',$star);
	    }
	    $num = $this->where($map)->count();
	    $page = set_page($num,10);
	    $info['page'] = $page -> Backpage();
	    $info['list'] = $this->where($map)->limit($page->limit)->select();
	    return $info;
	}
	/*
	 * 根据起始数据和结束数据查询集散地数据
	 * @date 2016-8-9
	 * @author yao
	 * @param
	 * return array
	 */
	public function verify($star,$end){
		if (empty($star) or empty($end)) return "参数错误！";
		$where['san_star'] = $star;
		$where['san_end'] = $end;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	
	
	
}