<?php
namespace Back\Model;
use Think\Model;
class AuthGroupAccessModel extends Model{
	/*
	 * 获取相同用户组所拥有的管理员数量
	 * @date 2016-8-4
	 * @author yao
	 * @param $val 角色名称 
	 * return array
	 */
	public function getNum($val){
		$dd = "";
		$model = D('AuthGroup');
		if (!empty($val)){
			$id = $model->getId($val);
			if ($id){
				foreach ($id as $vid){
					$dd .= $vid['id'].',';
				}
				$where['group_id'] = array('in',substr($dd,0,-1));
			} else {
				$where['group_id'] = 0;
			}			
		}
		$info = $this->field('*,count(uid) as num')->group('group_id')->where($where)->select();
		foreach ($info as $k => &$v){
			$data = $model->getData($v['group_id']);
			if (empty($data['title'])){
				unset($info[$k]);
			} else {
				$v['title'] = $data['title'];
			}
			$v['description'] = $data['description'];
		}
		return $info;
	}
	
	/*
	 * 获取用户组名称
	 * @date 2016-8-4
	 * @author yao
	 * @param $uid 管理员id
	 * return array
	 */
	public function getGroupName($uid){
		$where['uid'] = $uid;
		$data = $this->where($where)->find();
		$dataa = D('AuthGroup')->getData($data['group_id']);
		return $dataa;
	}
	
	/*
	 * 获取管理员id
	 * @date 2016-8-5
	 * @author yao
	 * @param $group_id 管理员id
	 * return array
	 */
	public function getUid($group_id){
		$where['group_id'] = $group_id;
		$data = $this->where($where)->select();
		return $data;
	}
	
	/*
	 * 根据uid获取用户组id
	 * @date 2016-8-5
	 * @author yao
	 * @param $uid 管理员id
	 * return array
	 */
	public function getGroupId($uid){
		$where['uid'] = $uid;
		$data = $this->where($where)->find();
		return $data;
	}
	
	
	
}