<?php
namespace Back\Controller;
class MemberyjhController extends BaseController{
    /**
     * 获取用户列表
     * @date: 2016-8-6 下午4:06:57
     * @author: liuxin
     */
    public function getUserList(){
        $user_name = I('get.user_name');
        $obj = D('User');
        $info = $obj -> getCommonMem($user_name);
        $this -> assign('info',$info['info']);
        $this -> assign('name',$user_name);
        $this -> assign('num',$info['num']);
        $this -> assign('page',$info['page']);
        $this -> display();
    }
    /**
     * 获取单一用户数据
     * @date: 2016-8-6 下午4:07:27
     * @author: liuxin
     */
    public function userEdit(){
        $id = I('get.id');
        $obj = D('User');
        $info = $obj -> getOneMemInfo($id);
        $this -> assign('info',$info);
        $this -> display();
        
    }
    /**
     * 添加普通用户页面
     * @date: 2016-8-6 下午4:08:00
     * @author: liuxin
     */
    public function userAdd(){
        $this -> display();
    }
    /**
     * 添加普通用户
     * @date: 2016-8-6 下午4:08:33
     * @author: liuxin
     */
    public function doAdd(){
        $user_name = I('post.user_name');
        $user_pwd = I('post.user_pwd');
        $email = I('post.email');//邮箱
        $identity = I('post.identity');//身份证
        $tel = I('post.tel');   //电话
        $portrait = ""; //头像
        if($user_name==''||$user_pwd==''||$tel==''){
           // $this -> error('数据错误',U('Member/commonMemAdd'));
            parent::error('数据错误',U('Memberyjh/userAdd'));
        }
        $obj = D('User');
        $res = $obj -> commonMemAdd($user_name,$user_pwd,$email,$identity,$tel,$portrait);
        if($res){
            //$this -> success('添加成功',U('Member/getCommonMem'));
            parent::success('添加成功',U('Memberyjh/getUserList'));
        }else{
            //$this -> error('添加失败',U('Member/commonMemAdd'));
            parent::error('添加失败',U('Memberyjh/userAdd'));
        } 
    }
    /**
     * 编辑普通用户
     * @date: 2016-8-6 下午4:09:22
     * @author: liuxin
     */
    public function doEdit(){
        $user_name = I('post.user_name');
        $user_pwd = I('post.user_pwd');
        $email = I('post.email');
        $identity = I('post.identity');
        $tel = I('post.tel');
        $portrait = "";
        $id = I('post.id');
        
        if($user_name==''||$tel==''||$id==''){
           // $this -> error('数据错误',U('Member/getOneMemInfo',array('id'=>$id)));
            parent::error('数据错误');
        }
        $obj = D('User');
        $res = $obj -> commonMemEdit($user_name,$user_pwd,$email,$identity,$tel,$portrait,$id);
        if($res){
            //$this -> success('更改成功',U('Member/getCommonMem'));
            parent::success('修改成功',U('Memberyjh/getUserList'));
        }else{
            //$this -> error('更改失败',U('Member/getOneMemInfo',array('id'=>$id)));
            parent::error('修改失败');
        }
    }
    
   
    /**
     * 普通用户删除
     * @date: 2016-8-6 下午4:12:02
     * @author: liuxin
     */
    public function commonMemDel(){
        $uid = I('post.uid');
        $obj = D('User');
        $res = $obj -> commonMemDel($uid);
        $this -> ajaxReturn($res);
    }
    /**
     * 获取咨询记录和下单记录
     */
    public function getHistory(){
        $id=I("id");
        $data=D('User')->getHistory($id);
        if($data!=''&&$data!=null){
            $this->ajaxReturn($data);
        }
    }
    /**
     * 查看定位地图
     */
    public function getMap(){
        $tel=I("code");
        $data=D("User")->getMap($tel);
        //dump($data);die();
        $this->assign("data",$data['str']);
        $this->assign("lon",$data['log']==""?"116.417854":$data['log']);
        $this->assign("lat",$data['lat']==""?"39.921988":$data['lat']);
        $this->display();
    }
    function ceshi(){
        $obj = D('User');
        $res = $obj -> ceshi();
    }
}