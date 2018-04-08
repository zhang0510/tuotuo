<?php
namespace Back\Model;
class AreaModel extends BaseModel{
	/*
	 * 获取所有区域
	 */
	public function getArea($num){
		$info = $this->where(array('area_type'=>$num))->select();
		return $info;
	}
	
	
	/*
	 * 获取所有区域分页
	 */
	public function getInfo($numa,$county){
		if (empty($numa)){
			return "参数不能为空！";
		} else {
			$where['area_type'] = $numa;
		}
		if (!empty($county))
		$where['area_id'] = $county;
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->limit($page->limit)->select();
		return $info;
	}
	/*
	 * 获取地区信息（新）
	 */
	public function getAreaInfo($id='',$level=''){
	    if($level){
	        $where['area_id'] = array('eq',$id);
	        $where['area_type'] = 3;
	    }else{
	        if($id){
	            $where['area_pid'] = array('eq',$id);
	            $where['area_type'] = array('eq',3);
	        }else{
	            $where['area_type'] = array('eq',3);
	        }
	    }
	    
	    $num = $this->where($where)->count();
	    $page = set_page($num,10);
	    $info['page'] = $page -> Backpage();
	    $info['list'] = $this->where($where)->limit($page->limit)->field("area_id,area_pid,area_name,area_add_time,area_type,area_get")->select();
	    $aa = $this->where($where)->limit($page->limit)-> fetchSql() ->select();
	    return $info;
	}
	
	/*
	 * 通过pid获取信息
	 */
	Public function getData($pid){
		$data = $this->where(array('area_id'=>$pid))->find();
		return $data;
	}
	
	
	/*
	 * 通过id获取所有子id
	 */
	public function getSon($pid){
		$where['area_pid'] = $pid;
		$info = $this->where($where)->select();
		return $info;
	}
	
	/*
	 * 根据id获取单条信息
	 */
	public function getOne($id){
		if (empty($id)) return "缺少参数！";
		$where['area_id'] = $id;//explode(',', $id)[1];
		$data = $this->where($where)->find();
		return $data;
	}
	
	/*
	 * 根据地区名字查询
	 */
	public function getAreaName($name){
		if (empty($name)) return "缺少参数！";
		$where['area_name'] = array('eq',$name);
		$data = $this->where($where)->find();
		return $data;
	}
	
	/*
	 * 根据地区名字查询市级别
	 */
	function getCityName($name){
		if (empty($name)) return "缺少参数！";
		$where['area_name'] = array('eq',$name);
		$where['area_type'] = array('eq',2);
		$data = $this->where($where)->find();
		return $data;
	}
	
}