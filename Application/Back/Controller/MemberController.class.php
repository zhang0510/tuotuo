<?php
namespace Back\Controller;
class MemberController extends BaseController{
    /**
     * 获取普通用户数据
     * @date: 2016-8-6 下午4:06:57
     * @author: liuxin
     */
    public function getCommonMem(){
        $user_name = I('get.user_name');
        $obj = D('User');
        $info = $obj -> getCommonMem($user_name);
        $this -> assign('info',$info['info']);
        $this -> assign('name',$user_name);
        $this -> assign('num',$info['num']);
        $this -> assign('page',$info['page']);
        $this -> display('member:common_member_show');
    }
    /**
     * 获取单一用户数据
     * @date: 2016-8-6 下午4:07:27
     * @author: liuxin
     */
    public function getOneMemInfo(){
        $id = I('get.id');
        $obj = D('User');
        $info = $obj -> getOneMemInfo($id);
        $this -> assign('info',$info);
        $this -> display('member:common_member_edit');
        
    }
    /**
     * 添加普通用户页面
     * @date: 2016-8-6 下午4:08:00
     * @author: liuxin
     */
    public function commonMemAdd(){
        $this -> display('member:common_member_add');
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
            parent::error('数据错误',U('Member/commonMemAdd'));
        }
        $obj = D('User');
        $res = $obj -> commonMemAdd($user_name,$user_pwd,$email,$identity,$tel,$portrait);
        if($res){
            //$this -> success('添加成功',U('Member/getCommonMem'));
            parent::success('添加成功',U('Member/getCommonMem'));
        }else{
            //$this -> error('添加失败',U('Member/commonMemAdd'));
            parent::error('添加失败',U('Member/commonMemAdd'));
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
            parent::success('修改成功',U('Member/getCommonMem'));
        }else{
            //$this -> error('更改失败',U('Member/getOneMemInfo',array('id'=>$id)));
            parent::error('修改失败');
        }
    }
    
    
    /* public function ceshi(){
        $a = D('User')->ceshi();
        dump($a);
    } */
    /**
     * 获取大客户数据
     * @date: 2016-8-6 下午4:09:42
     * @author: liuxin
     */
    public function getComMem(){
        $company_name = I('get.company_name');
        $obj = D('User');
        $list =  $obj -> getComMem($company_name);
        //dump($list['info']);
        $this -> assign('name',$company_name);
        $this -> assign('page',$list['page']);
        $this -> assign('info',$list['info']);
        $this -> assign('num',$list['num']);
        $this -> display('member:company_member_show');
    }
    /**
     * 大客户数据添加页面
     * @date: 2016-8-6 下午4:09:56
     * @author: liuxin
     */
    public function companyMemAdd(){
        $this->display('member:company_member_add');
    }
    /**
     * 添加大客户
     * @date: 2016-8-6 下午4:10:18
     * @author: liuxin
     */
    public function companyDoAdd(){
        $user_name = I('post.user_name');
        $identity = I('post.identity');
        $user_pwd = I('post.user_pwd');
        $email = I('post.email');
        $tel = I('post.tel');
        $company_name = I('post.company_name');
        $company_business = I('post.company_business');
        $coupon_price = I('post.coupon_price');
        $company_document = I('post.company_document');
        $identity_img = I('post.identity_img');
        if(!$user_name&&$identity&&$user_pwd&&$email&&$tel&&$company_name&&$company_business&&$coupon_price&&$company_document&&$identity_img){
            //$this -> error('数据错误',U('Member/companyMemAdd'));
            parent::error('数据错误');
        }
        $obj = D('User');
        $res = $obj -> companyMemAdd($user_name,$identity,$user_pwd,$email,$tel,$company_name,$company_business,$coupon_price,$company_document,$identity_img);
        if($res){
            //$this -> success('添加成功',U('Member/getComMem'));
            parent::success('添加成功',U('Member/getComMem'));
        }else{
            //$this -> error('添加失败',U('Member/companyMemAdd'));
            parent::error('添加失败');
        }
    }
    /**
     * 大客户编辑页面
     * @date: 2016-8-6 下午4:10:36
     * @author: liuxin
     */
    public function companyMemEdit(){
        $id = I('get.id');
        $obj = D('User');
        $list =  $obj -> getComDetail($id);
        $this -> assign('list',$list);
        $this -> display('member:company_member_edit');
    }
    /**
     * 大客户编辑
     * @date: 2016-8-6 下午4:10:56
     * @author: liuxin
     */
    public function companyDoEdit(){
        $user_name = I('post.user_name');
        $identity = I('post.identity');
        $user_pwd = I('post.user_pwd');
        $email = I('post.email');
        $tel = I('post.tel');
        $company_name = I('post.company_name');
        $company_business = I('post.company_business');
        $coupon_price = I('post.coupon_price');
        $company_document = I('post.company_document');
        $identity_img = I('post.identity_img');
        $id = I('post.id');
        $uid = I('post.uid');
        if(!$user_name&&$identity&&$user_pwd&&$email&&$tel&&$company_name&&$company_business&&$coupon_price&&$company_document&&$identity_img){
            //$this -> error('数据错误',U('Member/companyMemEdit',array('id'=>$id)));
            parent::error('数据错误');
        }
        $obj = D('User');
        $res = $obj -> companyMemEdit($user_name,$identity,$user_pwd,$email,$tel,$company_name,$company_business,$coupon_price,$company_document,$identity_img,$id,$uid);
        if($res){
            //$this -> success('修改成功',U('Member/getComMem'));
            parent::success('修改成功',U('Member/getComMem'));
        }else{
            //$this -> error('修改失败',U('Member/companyMemEdit',array('id'=>$id)));
            parent::error('修改失败');
        }
    }
    /**
     * 大客户升级页面
     * @date: 2016-8-6 下午4:11:17
     * @author: liuxin
     */
    public function upgrade(){
        $id = I('get.id');
        $this -> assign('id',$id);
        $this -> display('member:upgrade_company_member');
    }
    /**
     * 大客户升级
     * @date: 2016-8-6 下午4:11:33
     * @author: liuxin
     */
    public function companyMemUp(){
        $id = I('post.id');
        $company_name = I('post.company_name');
        $company_business = I('post.company_business');
        $coupon_price = I('post.coupon_price');
        $company_document = I('post.company_document');
        $identity_img = I('post.identity_img');
        if(!$company_name&&$company_business&&$coupon_price&&$company_document&&$identity_img){
            //$this -> error('数据错误',U('Member/upgrade',array('id'=>$id)));
            parent::error('数据错误');
        }
        $obj = D('User');
        $res = $obj -> upgrade($id,$company_name,$company_business,$coupon_price,$company_document,$identity_img);
        if($res){
            //$this -> success('升级成功',U('Member/getComMem'));
            parent::success('升级成功',U('Member/getComMem'));
        }else{
            //$this -> error('升级失败',U('Member/upgrade',array('id'=>$id)));
            parent::error('升级失败');
        }
    }
    /**
     * 大客户删除
     * @date: 2016-8-6 下午4:11:47
     * @author: liuxin
     */
    public function companyMemDel(){
        $uid = I('post.uid');
        $cid = I('post.cid');
        $obj = D('User');
        $res = $obj -> companyMemDel($uid,$cid);
        $this -> ajaxReturn($res);
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
    function ceshi(){
        $obj = D('User');
        $res = $obj -> ceshi();
    }
}