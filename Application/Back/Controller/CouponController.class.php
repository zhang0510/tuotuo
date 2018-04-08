<?php
namespace Back\Controller;
class CouponController extends BaseController{
    /**
     * 获取优惠券信息
     * @date: 2016-8-9 下午2:24:01
     * @author: liuxin
     */
    public function couponList(){
        $status = I('get.status');
        if($status ==''){
            $status = 'Y';
        }
        $type = I('get.type');
        $code = I('get.code');
        $obj = D('Favorable');
        $list = $obj -> getCouponList($status,$type,$code);
        $this -> assign('page',$list['page']);
        $this -> assign('num',$list['num']);
        $this -> assign('list',$list['list']);
        $this -> assign('code',$code);
        $this -> assign('status',$status);
        $this -> assign('type',$type);
        $this -> display("Coupon:coupon_manage");
    }
    /**
     * 优惠券添加
     * @date: 2016-8-9 下午2:24:27
     * @author: liuxin
     */
    public function couponAdd(){
        $sign = I('get.rr1');
        $obj = D('Favorable');
        $res = $obj -> provinceQuery();
        switch($sign){
            case 1:
                $this->assign('list',$res);
                $this->assign('Fstatus','a');
                $this->display('Coupon:coupon_start_add');
                break;
            case 2:
                $this->assign('list',$res);
                $this->assign('Fstatus','a');
                $this->display('Coupon:coupon_end_add');
                break;
            case 3:
                $this->assign('list',$res);
                $this->assign('Fstatus','a');
                $this->display('Coupon:coupon_route_add');
                break;
            case 4:
                $this->assign('list',$res);
                $this->assign('Fstatus','a');
                $this->display('Coupon:coupon_all_add');
                break;
            default:
                echo 111;
        }
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
     * 起始地优惠券添加
     * @date: 2016-8-9 下午2:25:38
     * @author: liuxin
     **/
    public function couponDoAdd(){
        $obj = D('Favorable');
        $fav_num = I('post.fav_num');
        $fav_price = I('post.fav_price');
        $start = I('post.fav_startime');
        $end = I('post.fav_endtime');
        $type = I('type');
        $types = I('types');
        switch($type){
            case 's':
                $province = I('post.province');
                $city = I('post.city');
                if($types=='a'){
                    $ge_num = I('post.ge_num');
                    $ge_num = (int)$ge_num;
                    if($ge_num==''){
                        parent::error('请输入生成数量');
                        //$this -> error('请输入生成数量');
                    }else if(!is_int($ge_num)){
                        parent::error('请输入正确的数量格式');
                        //$this -> error('请输入正确的数量格式');
                    }
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end&&$province!=''&&$city!=''){ 
                        $res = $obj -> couponStartAdd($fav_num,$fav_price,$start,$end,$province,$city,$ge_num);
                        if($res){
                            $this -> assign('type','C');
                            parent::success('添加成功',U('Coupon/couponList',array('type'=>'C')));
                            //$this -> success('添加成功',U('Coupon/couponList',array('type'=>'C')));
                        }else{
                            //$this -> error('添加失败');
                            parent::error('添加失败');
                        }
                    
                    }else{
                        parent::error('数据错误');
                        //$this -> error('数据错误');
                    }
                   
                }else{
                    $id = I('post.id');
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end&&$province!=''&&$city!=''){
                        $res = $obj -> couponStartEdit($fav_num,$fav_price,$start,$end,$province,$city,$id);
                        if($res){
                            $this -> assign('type','C');
                            parent::success('修改成功',U('Coupon/couponList',array('type'=>'C')));
                        }else{
                            parent::error('修改失败');
                        }
                    }else{
                       parent::error('数据错误');
                    }
                }
                break;
            case 'e':
                $province = I('post.province');
                $city = I('post.city');
                if($types=='a'){
                    $ge_num = I('post.ge_num');
                    $ge_num = (int)$ge_num;
                    if($ge_num==''){
                        parent::error('请输入生成数量');
                    }else if(!is_int($ge_num)){
                        parent::error('请输入正确的数量格式');
                    }
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end&&$province!=''&&$city!=''){
                        $res = $obj -> couponEndAdd($fav_num,$fav_price,$start,$end,$province,$city,$ge_num);
                        if($res){
                            $this -> assign('type','M');
                             parent::success('添加成功',U('Coupon/couponList',array('type'=>'M')));
                        }else{
                            parent::error('添加失败');
                        }
                
                    }else{
                        parent::error('数据错误');
                    }
                     
                }else{
                    $id = I('post.id');
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end&&$province!=''&&$city!=''){
                        $res = $obj -> couponEndEdit($fav_num,$fav_price,$start,$end,$province,$city,$id);
                        if($res){
                            $this -> assign('type','M');
                            parent::success('修改成功',U('Coupon/couponList',array('type'=>'M')));
                        }else{
                            parent::error('修改失败');
                        }
                    }else{
                        parent::error('数据错误');
                    }
                }
                break;
            case 'r':
                $province = I('post.province');
                $city = I('post.city');
                $sprovince = I('post.sprovince');
                $scity = I('post.scity');
                $block = I('post.block');
                if($types=='a'){
                    $ge_num = I('post.ge_num');
                    $ge_num = (int)$ge_num;
                    if($ge_num==''){
                        parent::error('请输入生成数量');
                    }else if(!is_int($ge_num)){
                        parent::error('请输入正确的数量格式');
                    }
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end&&$province!=''&&$city!=''&&$sprovince!=''&&$scity&&$block){
                        $res = $obj -> couponRouteAdd($fav_num,$fav_price,$start,$end,$province,$city,$ge_num,$sprovince,$scity,$block);
                        if($res){
                            $this -> assign('type','J');
                            parent::success('添加成功',U('Coupon/couponList',array('type'=>'J')));
                        }else{
                            parent::error('添加失败');
                        }
                
                    }else{
                        parent::error('数据错误');
                    }
                     
                }else{
                    $id = I('post.id');
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end&&$province!=''&&$city!=''&&$sprovince!=''&&$scity&&$block){
                        $res = $obj -> couponRouteEdit($fav_num,$fav_price,$start,$end,$province,$city,$id,$sprovince,$scity,$block);
                        if($res){
                            $this -> assign('type','J');
                            parent::success('修改成功',U('Coupon/couponList',array('type'=>'J')));
                        }else{
                            parent::error('修改失败');
                        }
                    }else{
                        parent::error('数据错误');
                    }
                }
                break;
            case 't':
                //$province = I('post.province');
                //$city = I('post.city');
                if($types=='a'){
                    $ge_num = I('post.ge_num');
                    $ge_num = (int)$ge_num;
                    if($ge_num==''){
                        parent::error('请输入生成数量');
                    }else if(!is_int($ge_num)){
                        parent::error('请输入正确的数量格式');
                    }
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end){
                        $res = $obj -> couponAllAdd($fav_num,$fav_price,$start,$end,$ge_num);
                        if($res){
                            $this -> assign('type','W');
                            parent::success('添加成功',U('Coupon/couponList',array('type'=>'W')));
                        }else{
                            parent::error('添加失败');
                        }
                
                    }else{
                        parent::error('数据错误');
                    }
                     
                }else{
                    $id = I('post.id');
                    if($fav_num!=''&&$fav_price!=''&&$start!=''&&$end!=''&&$start<$end){
                        $res = $obj -> couponAllEdit($fav_num,$fav_price,$start,$end,$id);
                        if($res){
                            $this -> assign('type','W');
                            parent::success('修改成功',U('Coupon/couponList',array('type'=>'W')));
                        }else{
                            parent::error('修改失败');
                        }
                    }else{
                        parent::error('数据错误');
                    }
                }
                break;
                
                
            /* default:
                echo 111; */
        }
    }
    /**
     * 打开优惠券编辑页面
     * @date: 2016-8-9 下午2:26:25
     * @author: liuxin
     */
    public function couponEdit(){
        $type = I('get.type');
        $id = I('get.id');
        $obj = D('Favorable');
        $res = $obj -> provinceQuery();
        switch($type){
            case 'C':
                $list = $obj -> getStartInfo($id);
                $this -> assign('list',$res);
                $this -> assign('info',$list['info']);
                $this -> assign('pro',$list['pro']);
                $this -> assign('city',$list['city']);
                $this -> assign('type','edit');
                $this -> assign('Fstatus','e');
                $this -> assign('proId',$list['proId']);
                $this -> assign('cityId',$list['cityId']);
                $this -> display('Coupon:coupon_start_add');
            break;
            case 'M':
                $list = $obj -> getEndInfo($id);
                $this -> assign('list',$res);
                $this -> assign('info',$list['info']);
                $this -> assign('pro',$list['pro']);
                $this -> assign('city',$list['city']);
                $this -> assign('type','edit');
                $this -> assign('Fstatus','e');
                $this -> assign('proId',$list['proId']);
                $this -> assign('cityId',$list['cityId']);
                $this -> display('Coupon:coupon_end_add');
            break;
           case 'J':
               $list = $obj -> getRouteInfo($id);
               $this -> assign('list',$res);
               $this -> assign('info',$list['info']);
               $this -> assign('pro',$list['pro']);
               $this -> assign('city',$list['city']);
               $this -> assign('type','edit');
               $this -> assign('Fstatus','e');
               $this -> assign('proId',$list['proId']);
               $this -> assign('cityId',$list['cityId']);
               $this -> assign('spro',$list['spro']);
               $this -> assign('scity',$list['scity']);
               $this -> assign('sproId',$list['sproId']);
               $this -> assign('scityId',$list['scityId']);
               $this -> assign('block',$list['block']);
               $this -> assign('blockId',$list['blockId']);
               $this -> display('Coupon:coupon_route_add');
               break;
           case 'W':
               $list = $obj -> getAllInfo($id);
               $this -> assign('list',$res);
               $this -> assign('info',$list['info']);
               /* $this -> assign('pro',$list['pro']);
               $this -> assign('city',$list['city']); */
               $this -> assign('type','edit');
               $this -> assign('Fstatus','e');
               /* $this -> assign('proId',$list['proId']);
               $this -> assign('cityId',$list['cityId']); */
               $this -> display('Coupon:coupon_all_add');
        }        
    }
    /**
     * 优惠券删除
     * @date: 2016-8-9 下午2:26:48
     * @author: liuxin
     */
    public function del(){
        $id = I('post.id');
        $obj = D('Favorable');
        $res = $obj -> del($id);
        if($res){
            $data['sign'] = 'Y';
            $data['msg'] = '删除成功';
        }else{
            $data['sign'] = 'N';
            $data['msg'] = '删除失败';
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
            $data['sign'] = 'Y';
            $data['msg'] = '删除成功';
        }else{
            $data['sign'] = 'N';
            $data['msg'] = '删除失败';
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
                $data['msg'] = '无此用户';
            }elseif($res=='Y'){
                $data['sign'] = 'Y';
                $data['msg'] = '添加成功';
            }else{
                $data['sign'] = 'N';
                $data['msg'] = '添加失败';
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
            array('coupon_type','优惠券类型'),
            array('coupon_star','优惠券开始时间'),
            array('coupon_end','优惠券结束时间'),
            array('coupon_times','可使用次数'),
            array('coupon_values','优惠券面值'),
        );
        $list=$list['list'];
        for($i=0;$i<count($list);$i++){
            $data['xlsData'][$i]['coupon_code'] = $list[$i]['fav_code'];
            $data['xlsData'][$i]['coupon_type'] = $list[$i]['fav_type'];
            if($list[$i]['fav_type'] == "W"){
                $data['xlsData'][$i]['coupon_type']="通用优惠券";
            }else if($list[$i]['fav_type'] == "J"){
                $data['xlsData'][$i]['coupon_type']="出发目的地";
            }else if($list[$i]['fav_type'] == "C"){
                $data['xlsData'][$i]['coupon_type']="出发地优惠券";
            }else{
                $data['xlsData'][$i]['coupon_type']="目的地优惠券";
            }
            $data['xlsData'][$i]['coupon_star'] = $list[$i]['fav_startime'];
            $data['xlsData'][$i]['coupon_end'] = $list[$i]['fav_endtime'];
            $data['xlsData'][$i]['coupon_times'] = $list[$i]['fav_num'];
            $data['xlsData'][$i]['coupon_values'] = $list[$i]['fav_price']/100;
        }
        exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
    }
}