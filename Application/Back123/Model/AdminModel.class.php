<?php
namespace Back\Model;
use Think\Model;
class AdminModel extends Model{
	/*
	 * 查询所有管理员
	 * @date 2016-8-5
	 * @author yao
	 * @param $name 管理名称 
	 * @param $uid  管理员的id
	 * return array
	 */
	Public function getInfo($name,$uid){
		if (!empty($name))
		$where['admin_name'] = array('like','%'.$name.'%');
		if (!empty($uid))
		$where['admin_id'] = array('in',$uid);
		$num = $this->where($where)->count();
		$page = set_page($num,10);
		$info['page'] = $page -> Backpage();
		$info['list'] = $this->where($where)->limit($page->limit)->select();
		return $info;
	}
	
	/*
	 * 根据code查询管理员
	 * @date 2016-8-5
	 * @author yao
	 * @param $admin_code  管理员的id
	 * return array
	 */
	Public function getData($admin_code){
		$where['admin_code'] = $admin_code;
		$data = $this->where($where)->find();
		return $data;
	}
	
}