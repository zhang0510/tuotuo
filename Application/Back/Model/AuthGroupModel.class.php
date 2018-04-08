<?php
namespace Back\Model;
use Think\Model;
class AuthGroupModel extends Model{
	/*
	 * 查看角色组所有
	 * @date 2016-8-3
	 * @author yao
	 * return array
	 */
	public function getGroup(){
		$info = $this->select();
		return $info;
	}
	
	/*
	 * 通过group_id获取角色信息
	 * @date 2016-8-3
	 * @author yao
	 * @param $group_id 角色id
	 * return array
	 */
	public function getData($group_id){
		$where['id'] = $group_id;
		$data = $this->where($where)->find();
		return $data;
	}
	
	/*
	 * 通过角色名称获取id
	 * @date 2016-8-3
	 * @author yao
	 * @param $val 角色名称
	 * return array
	 */
	public function getId($val){
		$where['title'] = array('like',"%".$val."%") ;
		$info = $this->field('id')->where($where)->select();
// 		dump($info);die;
		return $info;
	}
	
	/*
	 * 查询所有角色
	 * @date 2016-8-3
	 * @author yao
	 * @param $val 角色名称
	 * return array
	 */
	function getPage($val){
		$where['title'] = array('like','%'.$val.'%');
		$model = M('AuthGroupAccess');
		$info = $this->where($where)->select();
		foreach ($info as &$v){
			$v['num'] = $model->field('group_id')
					   ->where(array('group_id'=>$v['id']))
					   ->count();
		};
		return $info;
	}
	
	
	
	
}