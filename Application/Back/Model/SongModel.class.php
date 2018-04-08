<?php
namespace Back\Model;
use Back\Model\BaseModel;
class SongModel extends BaseModel{
	/*
	 * 获取所有送车地数据
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	public function getInfo(){
	
	}
	
	/*
	 * 送车地分页以及搜索
	 * @date 2016-8-6
	 * @author yao
	 * @param 
	 * return array
	 */
	Public function getPage($end){
		if (!empty($end)) $where['song_end'] = $end;
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->limit($page->limit)->select();
		return $info;
	}
	public function getPages($star='',$sign=''){
	    if($sign){
	        if($star){
	            $map['song_end'] = array('like',$star.'%');
	        }else{
	            $map[] = '1=1';
	        }
	    }else{
	        $map['song_end'] = array('eq',$star);
	    }
	    $num = $this->where($map)->count();
	    $page = set_page($num,10);
	    $info['page'] = $page -> Backpage();
	    $info['list'] = $this->where($map)->limit($page->limit)->select();
	    return $info;
	}
	
	/*
	 * 根据起始数据和结束数据查询送车地数据
	 * @date 2016-8-9
	 * @author yao
	 * @param
	 * return array
	 */
	public function verify($star,$end){
		if (empty($star) or empty($end)) return "参数错误！";
		$where['song_star'] = $star;
		$where['song_end'] = $end;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	/*
	 * 根据目的地数据查询初始地数据
	 * @date 2016-8-9
	 * @author yao
	 * @param
	 * return array
	 */
	public function end($end){
		if (empty($end)) return "参数错误！";
		$where['song_end'] = $end;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	
}