<?php
namespace Back\Controller;
class AuthController extends BaseController{
	//管理角色列表
	public function grouplist(){
		$val = I('get.val');
		$list = D('AuthGroup')->getPage($val);	
		$this->assign('list',$list);
		$this->assign('val',$val);
		$this->display('Auth:grouplist');
	}
	
	//添加角色
	public function groupadd(){
		$pid = I('get.pid');
		if ($pid){
			$data = M('AuthGroup')->where(array('id'=>$pid))->find();
			$this->assign('data',$data);
		}
		$model = M('authRule');
		$info = $model->where("status=1")->select();
		//后期改动位置
		if($pid){
		    $compare = explode(',',$data['rules']);
		}else{
		    $compare = '';
		}
		$arr = recursionEx(0,pid,id,$info,$compare);
		$this->assign('arr',$arr);
		$this->display('Auth:groupadd');
	}
	
	//添加角色处理
	public function groupadd_act(){
		$id = I('pid');
		$title = I('title');
		$description = I('description');
		$data = array(
			'title' => $title,
			'description'	=>	$description,
			'status'	=>	1
		);
		foreach (I('prower') as $k=>$v){
			$str .= $v.',';
		}
		$data['rules'] = substr($str, 0,-1);
		if ($id){
			if (M('AuthGroup')->where(array('id'=>$id))->save($data)){
				$this->showSucceePage('更新成功！','grouplist');
			} else {
				$this->showSucceePage('更新失败！');
			}
		} else {
			if (M('AuthGroup')->add($data)){
				$this->showSucceePage('添加成功！','grouplist');
			} else {
				$this->showSucceePage('添加失败！');
			}
		}
	}
	
	//删除角色
	function group_del(){
		$pid = I('pid');
		$where['id'] = $pid;
		$del = M('AuthGroup')->where($where)->delete();
		if ($del){
			$data = '删除成功';
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
	//操作员列表
	public function operator(){
		$uidp = "";
		$sel = I('get.sel',0);
		$name = I('get.name');
		$model = D('AuthGroup');
		$agamodel = D('AuthGroupAccess');
		if ($sel){
			$uiddata = $agamodel->getUid($sel);
		}
		foreach ($uiddata as $vv){
			$uidp .=  $vv['uid'].',';
		}
		$uid = substr($uidp,0,-1);
		$nav = $model->getGroup();
		$list = D('Admin')->getInfo($name,$uid);
		foreach ($list['list'] as &$v){
			$data = $agamodel->getGroupName($v['admin_id']);	 
			$v['title'] = $data['title'];
		}
		$this->assign('sel',$sel);
		$this->assign('name',$name);
		$this->assign('list',$list['list']);
		$this->assign('page',$list['page']);
		$this->assign('nav',$nav);
		$this->display('Auth:operator');
	}
	
	//添加操作员
	public function operatoradd(){
		$uo = I('get.uo');
		$amodel = D('Admin');
		$data = $amodel->getData($uo);
		$group = D('AuthGroupAccess')->getGroupId($data['admin_id']);
		$data['gid'] = $group['group_id'];
		$this->assign('data',$data);
		$model = D('AuthGroup');
		$nav = $model->getGroup();
		$this->assign('nav',$nav);
		$this->display('Auth:operatoradd');
	}
	
	//添加操作员处理
	public function operatoradd_act(){
		$code = I('post.admin_code');
		$group = I('post.group');
		$admin_name = I('post.admin_name');
		$admin_acc = I('post.admin_acc');
		$admin_pwd = substr(md5(I('post.admin_pwd')),3,7);
		$data = array(
				'admin_name' => $admin_name,
				'admin_acc'	 => $admin_acc,
				'admin_pwd'  => $admin_pwd,
		);
		if ($_POST){
			if ($code){
				if (empty($admin_pwd)) unset($data['admin_pwd']);
				$save = M('Admin')->where(array('admin_code'=>$code))->save($data);
				if ($save){
					$info = M('Admin')->where(array('admin_code'=>$code))->find();
					$new_arr = array(
						'group_id'	=> $group
					);
					$new_save = M('AuthGroupAccess')->where(array('uid'=>$info['admin_id']))->save($new_arr);
					if ($new_save){
						$this->showSucceePage('更新成功！','operator');
					} else {
						$this->showErrorPage('更新关联用户组失败！','operator');
					}
				} else {
					$this->showErrorPage('更新失败！','operator');
				}
			} else {
				$data['admin_time'] = date('Y-m-d H:i:s',time());
				$data['admin_code'] = create_random_code(7);
				$data['admin_flag']  = 'Y';
				$add = M('Admin')->add($data);
				if ($add){
					$newarr = array(
							'uid' => $add,
							'group_id' => $group
					);
					$newadd = M('AuthGroupAccess')->add($newarr);
					if ($newadd){
						$this->showSucceePage('添加成功！','operatoradd');
					} else {
						$this->showErrorPage('添加关联用户组失败！','operator');
					}				
				} else {
					$this->showErrorPage('添加失败！','operatoradd');
				}
			}
		}
	}
	
	//删除操作员
	public function operatordel(){
		$admin_id = I('post.admin_id');
		if (empty($admin_id)){
			$adminid = I('post.did');
		} else {
			$adminid = substr($admin_id,0,-1);
		}		
		$where['admin_id'] = array('in',$adminid);
		$del = M('Admin')->where($where)->delete();
		if ($del){
			$data = '删除成功'; 
		} else {
			$data = '删除失败';
		}
		$this->ajaxReturn($data);
	}
	
}