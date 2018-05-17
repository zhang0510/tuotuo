<?php
namespace Front\Controller;

class MyCouponController extends BaseController {
    //加载页面
    public function index(){
        //取session判断其是否登录
        $session_User = jiema(session('userData'));
        if($session_User['id']>0){
            //接收参数//查询
            $myArray['user_code'] = $session_User['tel'];
            $myArray['fav_flag'] = 'Y';
            $mObj = D("MyCoupon");
            $myList = $mObj -> mycoupon_list($myArray);
            $time = time();
            
            for($i=0;$i<count($myList['list']);$i++){
                if(strtotime($myList['list'][$i]['fav_startime']) == '' && strtotime($myList['list'][$i]['fav_endtime']) ==''){
                    $myList['list'][$i]['msg'] = "未用";
                }elseif(strtotime($myList['list'][$i]['fav_startime']) <= $time && strtotime($myList['list'][$i]['fav_endtime']) >$time){
                    if($myList['list'][$i]['fav_status'] == 'Y'){
                        $myList['list'][$i]['msg'] = "已用";
                    }else{
                        $myList['list'][$i]['msg'] = "未用";
                    }
                }else{
                    $myList['list'][$i]['msg'] = "失效";
                }
                if(strtotime($myList['list'][$i]['fav_startime']) == '' && strtotime($myList['list'][$i]['fav_endtime']) ==''){
                    $myList['list'][$i]['fav_startime'] = '';
                    $myList['list'][$i]['fav_endtime'] = "长期有效";
                }else{
                    $myList['list'][$i]['fav_startime'] = str_replace("-",".",substr($myList['list'][$i]['fav_startime'],0,10));
                    $myList['list'][$i]['fav_endtime'] = str_replace("-",".",substr($myList['list'][$i]['fav_endtime'],0,10));
                }

            }
            $this -> assign('show',$myList['show']);
            $this -> assign('cList',$myList['list']);
            $this -> assign('num',$myList['number']);
            $this->display("MyCoupon:my_coupon");
        }else{
            //进入页面
            $this->display("Login:pc_login");
        }
    }
    
    //优惠券列表
    public function couponList($myArray){
        //初始化Model
        $mObj = D("MyCoupon");
        $myList = $mObj -> mycoupon_list($myArray);
        return $myList;
    }
}