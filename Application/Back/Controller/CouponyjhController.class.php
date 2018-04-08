<?php
namespace Back\Controller;
class CouponyjhController extends BaseController{
    /**
     * 获取优惠券信息
     * @date: 2016-8-9 下午2:24:01
     * @author: liuxin
     */
    public function couponList(){
        $code = I('get.code');
        $obj = D('Favorable');
        $list = $obj -> getCouponList($status,$type,$code);
        $this -> assign('page',$list['page']);
        $this -> assign('num',$list['num']);
        $this -> assign('list',$list['list']);
        $this -> assign('code',$code);
        $this -> assign('type',$type);
        $this -> display();
    }
    /**
     * 优惠券添加
     * @date: 2016-8-9 下午2:24:27
     * @author: liuxin
     */
    public function addFav(){
       $user_name=I('text');
       //获取会员列表
       $info = D("Favorable") -> getCommonMem($user_name);
       if($user_name!=''&&$user_name!=null){
           $this->ajaxReturn($info);
       }
       $this->assign("userList",$info);
       $this->display();
    }
    
    
    /**
     * 获取地区信息ajax
     * @date: 2016-8-9 下午2:25:04
     * @author: liuxin
     **/
    public function cityQuery(){
        $pro = I('post.pro');
        $obj = D('Favorable');
        $res = $obj -> cityQuery($pro);
        $this -> ajaxReturn($res);
    }
    /**
     * 优惠券添加
     * @date: 2016-8-9 下午2:25:38
     * @author: liuxin
     **/
    public function couponDoAdd(){
        $obj = D('Favorable');
        $data=I("post.");
        $res = $obj -> addFav($data);
        if($res){
            $this->ajaxReturn('Y');
        }
    }
    /**
     * 打开优惠券编辑页面
     * @date: 2016-8-9 下午2:26:25
     * @author: liuxin
     */
    public function couponEdit(){
        $id = I('get.id');
        $obj = D('Favorable');
        $res = $obj -> getAllInfo($id);
        $this->assign("info",$res);
        $this -> display();
    }
    public function couponInsert(){
        $data=I("post.");
        $res =D('Favorable') ->couponEdit($data);
        if($res){
            $this->success("修改成功",'couponList');
        }else{
            $this->error("未改变");
        }
    }
    /**
     * 优惠券作废
     * @date: 2016-8-9 下午2:26:48
     * @author: liuxin
     */
    public function del(){
        $id = I('post.id');
        $obj = D('Favorable');
        $res = $obj -> del($id);
        if($res){
            $data['sign'] = 'Y';
            $data['cont'] = '作废成功';
        }else{
            $data['sign'] = 'N';
            $data['cont'] = '作废失败';
        }
        $this -> ajaxReturn($data);
    }
    /**
     * 优惠券批量删除
     * @date: 2016-8-9 下午2:27:05
     * @author: liuxin
     */
    public function delAll(){
        $arr = I('post.arr');
        //$arr = json_encode($arr);
        $obj = D('Favorable');
        $res = $obj -> delAll($arr);
        if($res){
            $data = 'Y';
        }else{
            $data= 'N';
        }
        $this -> ajaxReturn($data);
        
    }
    /**
     * 优惠券分配
     * @date: 2016-8-9 下午2:27:24
     * @author: liuxin
     */
    public function assigns(){
        $id = I('post.codeId');
        $num = I('post.phoneNum');
        $obj = D('Favorable');
        if($id==''||$num==''){
            $this -> error('数据错误');
        }else{
            $res = $obj -> assigns($id,$num);
            if($res=='E'){
                $data['sign'] = 'E';
                $data['con'] = '无此用户';
            }elseif($res=='Y'){
                $data['sign'] = 'Y';
                $data['con'] = '添加成功';
            }else{
                $data['sign'] = 'N';
                $data['con'] = '添加失败';
            }
        }
        $this -> ajaxReturn($data);
    }
    /*
     *列表导出
     */
    
    function daochu(){
        $status="";
        $type="";
        $code=I("get.code");
        //$code="TF14706556508NM4,TF1470655650L659,TF1470655650W7ER";
        $obj = D('Favorable');
        $list = $obj -> getCouponList($status,$type,$code);
        //var_dump($list['list']);
        //exit;
        $data['xlsName']  = "优惠券管理--导出".date("Y-m-d H:i:s",time());
        $data['xlsCell']  = array(
            array('coupon_code','优惠券编码'),
            array('coupon_star','优惠券开始时间'),
            array('coupon_end','优惠券结束时间'),
            array('coupon_values','优惠券面值'),
        );
        $list=$list['list'];
        for($i=0;$i<count($list);$i++){
            $data['xlsData'][$i]['coupon_code'] = $list[$i]['fav_code'];
            $data['xlsData'][$i]['coupon_star'] = $list[$i]['fav_startime'];
            $data['xlsData'][$i]['coupon_end'] = $list[$i]['fav_endtime'];
            $data['xlsData'][$i]['coupon_values'] = $list[$i]['fav_price']/100;
        }
        exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
    }
}