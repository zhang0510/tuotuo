<?php
namespace Front\Model;
class MyCouponModel extends BaseModel{
    //查询列表
    function mycoupon_list($map){
        //初始化
        $sel = M("favorable");
       
        //获取条数
        $myCoupon['number'] = $sel -> where($map) -> count();
        //计算页数
        $myCoupon['page'] = set_page($myCoupon['number'],12);
        //查询
        $myCoupon['list'] = $sel -> where($map) -> order('fav_id desc') -> limit($myCoupon['page']->limit) -> select();
        //分页条
        $myCoupon['show'] = $myCoupon['page']->FrontPage();
        //返回结果
        return $myCoupon;
    }
}