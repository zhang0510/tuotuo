<?php
namespace Back\Model;
use Back\Model\BaseModel;
use Think\Model\RelationModel;
class UserModel extends RelationModel{
    protected $_link = array( 
        'Company'=>array( 
            'mapping_type' => self::HAS_ONE,
            'class_name'   => 'Company',
            'foreign_key ' => 'user_id',
         ),        
     );
    
    /*
     * 测试
     */
    public function ceshi(){
        $info = $this->relation('Company')->select();
        dump($info);
    }
    
    /**
     * 获取用户数据列表
     * @date: 2016-8-6 下午3:53:46
     * @author: liuxin
     * @param string $user_name 用户名
     * @return array
     */
    public function getCommonMem($user_name=''){
        if($user_name!=''){
            $maps['user_name'] = array('like','%'.$user_name.'%');
            $maps['tel'] = array('like','%'.$user_name.'%');
            $maps['_logic'] = 'or';
            $map['_complex'] = $maps;
        }
        $num = $this -> where($map) -> count();
        $page = set_page($num,10);
        $info = $this -> where($map) -> order("addtime desc")->limit($page->limit) -> select();
        $page = $page -> BackPage();
        $data['num'] = $num;
        $data['page'] = $page;
        $data['info'] = $info;
        return $data;
    }
    /**
     * 添加普通用户
     * @date: 2016-8-6 下午3:54:17
     * @author: liuxin
     * @param string $user_name 用户名
     * @param string $user_pwd  用户密码
     * @param string $email 用户邮箱
     * @param string $identity  用户身份证号
     * @param string $tel   用户手机号
     * @param string $portrait  用户头像
     * @return int 
     */
    public function commonMemAdd($user_name='',$user_pwd='',$email='',$identity='',$tel='',$portrait=''){
        $user_pwd = md5($user_pwd);
        $data['user_name'] = $user_name;
        $data['user_pwd'] = $user_pwd;
        $data['email'] = $email;
        $data['identity'] = $identity;
        $data['portrait'] = $portrait;
        $data['tel'] = $tel;
        $data['user_code'] = get_code('TU');
        $data['role'] = 'P';
        $data['addtime'] = date('Y-m-d H:i:s',time());
        $res = $this -> add($data);
        return $res;
    }
    /**
     * 编辑普通用户
     * @date: 2016-8-6 下午3:56:32
     * @author: liuxin
     * @param string $user_name 用户名
     * @param string $user_pwd  密码
     * @param string $email 邮箱
     * @param string $identity  身份证号
     * @param string $tel   手机号
     * @param string $portrait  头像
     * @param string $id    用户id
     * @return int
     */
    public function commonMemEdit($user_name='',$user_pwd='',$email='',$identity='',$tel='',$portrait='',$id=''){
        if($user_pwd!=''){
            $user_pwd = md5($user_pwd);
            $data['user_pwd'] = $user_pwd;
        }
        $map['id'] = array('eq',$id);
        $data['user_name'] = $user_name;
        $data['email'] = $email;
        $data['identity'] = $identity;
        $data['portrait'] = $portrait;
        $data['tel'] = $tel;
        $res = $this -> where($map) ->save($data);
        return $res;
    }
    /**
     * 获取编辑用户原数据
     * @date: 2016-8-6 下午3:58:02
     * @author: liuxin
     * @param string $id 用户id
     * @return array
     */
    public function getOneMemInfo($id=''){
        $map['id'] = array('eq',$id);
        $info = $this -> where($map) -> find();
        return $info;
    }
    /**
     * 获取大客户数据
     * @date: 2016-8-6 下午3:58:54
     * @author: liuxin
     * @param string $company_name 公司名
     * @return Ambigous <\Think\mixed, boolean, string, NULL, mixed, multitype:, unknown, object>
     */
    public function getComMem($company_name=''){
        $obj = M('company');
        $map[] = '1=1';
        if($company_name !=''){
            $map['company_name'] = array('like','%'.$company_name.'%');
        }
        $num = $obj ->field('*,tuo_user.id as uid,tuo_company.id as id')->join('tuo_user on tuo_user.id = tuo_company.user_id') -> where($map)-> count();
        $page = set_page($num,10);
        $info = $obj ->field('*,tuo_user.id as uid,tuo_company.id as id')->join('tuo_user on tuo_user.id = tuo_company.user_id') ->limit($page->limit) -> where($map)-> select();
        $page = $page ->BackPage();
        $data['info'] = $info;
        $data['num'] = $num;
        $data['page'] = $page;
        return $data;
    }
    /**
     * 添加大客户
     * @date: 2016-8-6 下午4:00:09
     * @author: liuxin
     * @param string $user_name 用户名
     * @param string $identity  身份证号
     * @param string $user_pwd  密码
     * @param string $email 邮箱
     * @param string $tel   电话
     * @param string $company_name  公司名
     * @param string $company_business  公司业务
     * @param string $coupon_price  优惠度
     * @param string $company_document  记录执照
     * @param string $identity_img  企业法人身份证图片
     * @return boolean
     */
    public function companyMemAdd($user_name='',$identity='',$user_pwd='',$email='',$tel='',$company_name='',$company_business='',$coupon_price='',$company_document='',$identity_img=''){
        $data['user_code'] = get_code('TU');
        $data['user_name'] = $user_name;
        $data['identity'] = $identity;
        $data['user_pwd'] = md5($user_pwd);
        $data['tel'] = $tel;
        $data['email'] = $email;
        $data['role'] = 'Q';
        $data['addtime'] = date('Y-m-d H:i:s',time());
        $res = $this -> add($data);
        if($res){
            $map['user_code'] = array('eq',$data['user_code']);
            $user_id = $this -> field('id') -> where($map) -> find();
        }else{
            $sign = false;
            return $sign;
        }
        $datas['company_code'] = get_code('TC');
        $datas['company_name'] = $company_name;
        $datas['company_business'] = $company_business;
        $datas['company_document'] = $company_document;
        $datas['user_id'] = $user_id['id'];
        $datas['coupon_price'] = $coupon_price*100;
        $datas['identity_img'] = $identity_img;
        $datas['company_create'] = date('Y-m-d H:i:s',time());
        $comobj = M('company');
        $comres = $comobj -> add($datas);
        if($comres){
            $sign = true;
            return $sign;
        }else{
            $sign = false;
            return $sign;
        }
    }
    /**
     * 获取单一大客户数据
     * @date: 2016-8-6 下午4:01:42
     * @author: liuxin
     * @param string $id 大客户id
     * @return Ambigous <\Think\mixed, boolean, NULL, multitype:, mixed, unknown, string, object>
     */
    public function getComDetail($id=''){
        $map['tuo_company.id'] = array('eq',$id);
        $obj = M('company');
        $info = $obj ->field('*,tuo_user.id as uid,tuo_company.id as id')->join('tuo_user on tuo_user.id = tuo_company.user_id') -> where('tuo_company.id='.$id) -> find();
        //dump($info);
        return $info;
    }
    /**
     * 大客户编辑
     * @date: 2016-8-6 下午4:02:22
     * @author: liuxin
     * @param string $user_name 用户名
     * @param string $identity  身份证号
     * @param string $user_pwd  密码
     * @param string $email 邮箱
     * @param string $tel   手机
     * @param string $company_name  公司名
     * @param string $company_business  公司业务
     * @param string $coupon_price  优惠率
     * @param string $company_document  记录执照
     * @param string $identity_img 企业法人身份证图片
     * @param string $id 大客户id
     * @param string $uid   客户id
     * @return boolean
     */
    public function companyMemEdit($user_name='',$identity='',$user_pwd='',$email='',$tel='',$company_name='',$company_business='',$coupon_price='',$company_document='',$identity_img='',$id='',$uid=''){
        $data['user_name'] = $user_name;
        $data['identity'] = $identity;
        $data['user_pwd'] = md5($user_pwd);
        $data['tel'] = $tel;
        $data['email'] = $email;
        $map['id'] = array('eq',$uid);
        $res = $this -> where($map) ->save($data);
        
        $datas['company_name'] = $company_name;
        $datas['company_business'] = $company_business;
        $datas['company_document'] = $company_document;
        $datas['user_id'] = $uid;
        $datas['coupon_price'] = $coupon_price*100;
        $datas['identity_img'] = $identity_img;
        $maps['id'] = array('eq',$id);
        $obj = M('company');
        $ress = $obj -> where($maps) -> save($datas);
        return $res||$ress;
    }
    /**
     * 大客户升级
     * @date: 2016-8-6 下午4:03:54
     * @author: liuxin
     * @param string $id 用户id
     * @param string $company_name 公司名
     * @param string $company_business  公司业务
     * @param string $coupon_price  优惠率
     * @param string $company_document 记录执照
     * @param string $identity_img 企业法人身份证图片
     * @return boolean
     */
    public function upgrade($id='',$company_name='',$company_business='',$coupon_price='',$company_document='',$identity_img=''){
        $datas['company_code'] = get_code('TC');
        $datas['company_name'] = $company_name;
        $datas['company_business'] = $company_business;
        $datas['company_document'] = $company_document;
        $datas['user_id'] = $id;
        $datas['coupon_price'] = $coupon_price;
        $datas['identity_img'] = $identity_img;
        $datas['company_create'] = date('Y-m-d H:i:s',time());
        $comobj = M('company');
        $comres = $comobj -> add($datas);
        $map['id'] = array('eq',$id);
        $res = $this -> where($map) -> setField('role','Q');
        if($comres&&$res){
            $sign = true;
            return $sign;
        }else{
            $sign = false;
            return $sign;
        }
    }
    /**
     * 大客户删除
     * @date: 2016-8-6 下午4:05:06
     * @author: liuxin
     * @param string $uid 用户id
     * @param string $cid 公司id
     * @return string
     */
    public function companyMemDel($uid='',$cid=''){
        $ures = $this -> delete($uid);
        $obj = M('company');
        $cres = $obj -> delete($cid);
        if($ures&&$cres){
            $data['sign'] = 'Y';
            $data['info'] = '删除成功';
        }else{
            $data['sign'] = 'N';
            $data['info'] = '删除失败';
        }
        return $data;
    }
    /**
     * 普通用户删除
     * @date: 2016-8-6 下午4:06:09
     * @author: liuxin
     * @param string $uid 用户id
     * @return string
     */
    public function commonMemDel($uid=''){
        $res = $this -> delete($uid);
        if($res){
            $data['sign'] = 'Y';
            $data['info'] = '删除成功';
        }else{
            $data['sign'] = 'N';
            $data['info'] = '删除失败';
        }
        return $data;
    }
    /**
     * 获取普通用户数量
     * @date: 2016-8-9 下午2:56:28
     * @author: liuxin
     * @return int
     */
    public function getCommonUserNum(){
        $map['role'] = array('eq','P');
        $num = $this -> where($map) -> count();
        return $num;
    }
    /**
     * 获取大客户数量
     * @date: 2016-8-9 下午2:56:56
     * @author: liuxin
     * @return int
     */
    public function getCompanyUserNum(){
        $map['role'] = array('eq','Q');
        $num = $this -> where($map) -> count();
        return $num;
    }
    /**
     * 获取咨询历史和下单历史
     */
    public function getHistory($id){
        $userInfo=$this->where("id =".$id)->find();
        if(empty($userInfo['opin'])){
                $userInfo['opin']='-';
            }
            if(empty($userInfo['user_name'])){
                $userInfo['user_name']='-';
            }
        $list=array();
        $userTel=$userInfo['tel'];
        //查询质询
        $refer=M("refer")->where("tr_tel='".$userTel."'")->order("tr_duan asc")->select();
        if($refer){
            foreach ($refer as $va){
                $list[]=$va['tr_duan']."，查询".$va['tr_start']."发".$va['tr_end']."价格，报价".$va['tr_bao']."元。".$va['tr_bei'];
            }
        }
        //查询下单
        $order=M("order_assistant")->where("user_code='".$userTel."'")->order("order_time asc")->select();
        if($order){
            foreach ($order as $vo){
                $list[]=$vo['order_time']."，下单".$vo['order_code']."，订单状态：".getOrderStatus($vo['order_status']);
            }
        }
        $data['userinfo']=$userInfo;
        $data['list']=$list;
        return $data;
    }
    /**
     * 查看用户定位地图
     */
    function getMap($tel){
        $where['car_code']=$tel;
        $where['carh_flag']='S';
        $res=M("position_car")->where($where)->field("car_lon,car_lat,time")->select();
        $str='';
        if($res){
            foreach ($res as $va){
                $str.='['.$va['car_lon'].','.$va['car_lat'].',"'.$va['time'].'"],';
            }
        }
        $str=trim($str,",");
        $str='['.$str.']';
        $data['str'] = $str;
        $data['log'] = $res[0]['car_lon'];
        $data['lat'] = $res[0]['car_lat'];
        return $data;
    }
}