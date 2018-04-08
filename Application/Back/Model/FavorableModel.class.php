<?php
namespace Back\Model;
class FavorableModel extends BaseModel{
    /**
     * 获取优惠券列表
     * @date: 2016-8-8 下午8:46:22
     * @author: liuxin
     * @param string $status 优惠券状态
     * @param string $type  优惠券种类
     * @param string $code  优惠券code
     * @return array
     */
    public function getCouponList($status='',$type='',$code=''){
        if($status=='Y'||$status=='N'){
            $map['fav_flag'] = array('eq',$status);
        }else if($status=='U'){
            $map['fav_status'] = array('eq',$status);
        }
        if($type!=''){
            $map['fav_type'] = array('eq',$type);
            $par = array('fav_type'=>$type);
        }
        if($code!=''){
            $map['fav_code'] = array('in',$code);
        }
        $map['fav_flag']='Y';
        $map[] = '1=1';
        $num = $this -> where($map) -> count();
        $page = set_page($num, 10, $par);
        $list = $this -> where($map) ->order("fav_id desc")-> limit($page->limit) -> select();
        $page = $page -> BackPage();
        $data['page'] = $page;
        $data['num'] = $num;
        $data['list'] = $list;
        return $data;
    }
    /**
     * 获取普通用户数据
     * @date: 2016-8-6 下午3:53:46
     * @author: liuxin
     * @param string $user_name 用户名
     * @return array
     */
    public function getCommonMem($user_name=''){
        $map['role'] = 'P';
        if($user_name!=''){
            $maps['user_name'] = array('like','%'.$user_name.'%');
            $maps['tel'] = array('like','%'.$user_name.'%');
            $maps['_logic'] = 'or';
            $map['_complex'] = $maps;
        }
        $info = M("user") -> where($map) -> order("addtime desc") -> select();
        return $info;
    }
    /**
     * 获取省信息
     * @date: 2016-8-9 下午2:15:38
     * @author: liuxin
     * @return Ambigous <\Think\mixed, boolean, string, NULL, mixed, multitype:, unknown, object>
     */
    public function provinceQuery(){
        $obj = M('area');
        $map['area_pid'] = array('eq',1);
        $list = $obj -> where($map) -> select();
        return $list;
    }
    /**
     * 获取地区列表 并拼装
     * @date: 2016-8-8 下午8:51:07
     * @author: liuxin
     * @param string $pro 地区id
     * @return string   
     */
    public function cityQuery($pro=''){
        $obj = M('area');
        $map['area_pid'] = array('eq',$pro);
        $list = $obj -> where($map) -> select();
        foreach($list as $key=>$vo){
            $str.="<option value='{$vo['area_id']}' class='city'>{$vo['area_name']}</option>";
        }
        return $str;
    }
    /**
     * 起始地优惠券添加
     * @date: 2016-8-8 下午8:52:07
     * @author: liuxin
     * @param string $fav_num 使用次数
     * @param string $fav_price 优惠券金额
     * @param string $start 开始时间
     * @param string $end   结束时间
     * @param string $province  省
     * @param string $city  市
     * @param string $ge_num    同时添加条数
     * @return boolean
     */
    public function couponStartAdd($fav_num='',$fav_price='',$start='',$end='',$province='',$city='',$ge_num=''){
        
        $des = $province.','.$city;
        for($i=0;$i<$ge_num;$i++){
            $data['fav_code'] = get_code('TF');
            $data['fav_type'] = 'C';
            $data['fav_startime'] = $start;
            $data['fav_endtime'] = $end;
            $data['fav_star'] = $des;
            $data['fav_flag'] = 'Y';
            $data['fav_num'] = $fav_num;
            $data['fav_left'] = $fav_num;
            $data['fav_price'] = $fav_price*100;
            $res[$i] = $this -> add($data);
            if($i==0){
                $result = $res[$i];
            }else{
                $result = $res[$i]&&$res[$i-1];
            }
        }
        return $result;
    }
    /**
     * 获取起始地优惠券信息
     * @date: 2016-8-8 下午8:53:58
     * @author: liuxin
     * @param unknown $id 优惠券id
     * @return array
     */
    public function getStartInfo($id){
        $map['fav_id'] = array('eq',$id);
        $list = $this -> where($map) -> find();
        $proId = $list['fav_star'];
        $arr[] = explode(',',$proId);
        $areaObj = M('area');
        $maps['area_id'] = array('eq',$arr[0][0]);
        $mapss['area_id'] = array('eq',$arr[0][1]);
        $pro = $areaObj -> where($maps) -> find();
        $city = $areaObj -> where($mapss) -> find();
        $data['pro'] = $pro['area_name'];
        $data['city'] = $city['area_name'];
        $data['proId'] = $arr[0][0];
        $data['cityId'] = $arr[0][1];
        $data['info'] = $list;
        return $data;
    }
    /**
     * 修改起始地优惠券
     * @date: 2016-8-8 下午8:54:36
     * @author: liuxin
     * @param string $fav_num 使用次数
     * @param string $fav_price 优惠券金额
     * @param string $start 开始时间
     * @param string $end   结束时间
     * @param string $province  省
     * @param string $city  市
     * @param string $id 优惠券id
     * @return Ambigous <boolean, unknown>
     */
    public function couponStartEdit($fav_num='',$fav_price='',$start='',$end='',$province='',$city='',$id=''){
        $des = $province.','.$city;
        $map['fav_id'] = array('eq',$id);
        $data['fav_type'] = 'C';
        $data['fav_startime'] = $start;
        $data['fav_endtime'] = $end;
        $data['fav_star'] = $des;
        //$data['fav_flag'] = 'Y';
        $data['fav_num'] = $fav_num;
        $data['fav_price'] = $fav_price*100;
        $res = $this -> where($map) -> save($data);
        return $res;
    }
    /**
     * 删除优惠券
     * @date: 2016-8-8 下午8:55:46
     * @author: liuxin
     * @param string $fav_id 优惠券id
     * @return Ambigous <\Think\mixed, boolean, unknown>
     */
    public function del($fav_id=''){
        $map['fav_id'] = array('eq',$fav_id);
        $data['fav_flag']='N';
        $res = $this -> where($map) ->save($data);
        return $res;
    }
    /**
     * 目的地优惠券添加
     * @date: 2016-8-8 下午8:56:14
     * @author: liuxin
     * @param string $fav_num 使用次数
     * @param string $fav_price 优惠券金额
     * @param string $start 开始时间
     * @param string $end   结束时间
     * @param string $province  省
     * @param string $city  市
     * @param string $ge_num 添加数量
     * @return boolean
     */
    public function couponEndAdd($fav_num='',$fav_price='',$start='',$end='',$province='',$city='',$ge_num=''){
    
        $des = $province.','.$city;
        for($i=0;$i<$ge_num;$i++){
            $data['fav_code'] = get_code('TF');
            $data['fav_type'] = 'M';
            $data['fav_startime'] = $start;
            $data['fav_endtime'] = $end;
            $data['fav_end'] = $des;
            $data['fav_flag'] = 'Y';
            $data['fav_num'] = $fav_num;
            $data['fav_left'] = $fav_num;
            $data['fav_price'] = $fav_price*100;
            $res[$i] = $this -> add($data);
            if($i==0){
                $result = $res[$i];
            }else{
                $result = $res[$i]&&$res[$i-1];
            }
        }
        return $result;
    }
    public function addFav($data){
        $data['fav_code']=$this->getTablecode('F');
        $data['fav_flag']='Y';
        $data['fav_status']='N';
        $data['time']=date('Y-m-d H:i:s',time());
        $data['fav_price']=$data['fav_price']*100;
        $res = $this-> add($data);
        
        $str = sprintf(C("DUANXIN_MOBAN")['YOUHUI'],
            "1",
            $data['fav_price']/100,
            $data['fav_code']);
        print_log("------------------发送优惠:".$str."---发送人:".$data['user_code']);
        $ret = send_mobile_sms($data['user_code'],$str);
        if($ret['status']==0){
            //$data['msg']="发送成功";
        }else{
            //$data['msg']="发送失败";
        }
        return $res;
    }
    /**
     * 获取目的地优惠券信息
     * @date: 2016-8-8 下午8:57:03
     * @author: liuxin 
     * @param unknown $id 优惠券id
     * @return array
     */
    public function getEndInfo($id){
        $map['fav_id'] = array('eq',$id);
        $list = $this -> where($map) -> find();
        $proId = $list['fav_end'];
        $arr[] = explode(',',$proId);
        $areaObj = M('area');
        $maps['area_id'] = array('eq',$arr[0][0]);
        $mapss['area_id'] = array('eq',$arr[0][1]);
        $pro = $areaObj -> where($maps) -> find();
        $city = $areaObj -> where($mapss) -> find();
        $data['pro'] = $pro['area_name'];
        $data['city'] = $city['area_name'];
        $data['proId'] = $arr[0][0];
        $data['cityId'] = $arr[0][1];
        $data['info'] = $list;
        return $data;
    }
    /**
     * 目的地优惠券编辑
     * @date: 2016-8-8 下午8:57:44
     * @author: liuxin
     * @param string $fav_num 使用次数
     * @param string $fav_price 优惠券金额
     * @param string $start 开始时间
     * @param string $end   结束时间
     * @param string $province  省
     * @param string $city  市
     * @param string $id 优惠券id
     * @return Ambigous <boolean, unknown>
     */
    public function couponEndEdit($fav_num='',$fav_price='',$start='',$end='',$province='',$city='',$id=''){
        $des = $province.','.$city;
        $map['fav_id'] = array('eq',$id);
        $data['fav_type'] = 'C';
        $data['fav_startime'] = $start;
        $data['fav_endtime'] = $end;
        $data['fav_end'] = $des;
        //$data['fav_flag'] = 'Y';
        $data['fav_num'] = $fav_num;
        $data['fav_price'] = $fav_price*100;
        $res = $this -> where($map) -> save($data);
        return $res;
    }
    /**
     * 添加集散地优惠券
     * @date: 2016-8-8 下午8:58:26
     * @author: liuxin
     * @param string $fav_num  使用次数
     * @param string $fav_price 优惠券金额
     * @param string $start     开始时间
     * @param string $end  结束时间
     * @param string $province  结束省
     * @param string $city  结束市
     * @param string $ge_num    添加数量
     * @param string $sprovince 开始省 
     * @param string $scity 开始市
     * @param string $block 开始区
     * @return boolean
     */
    public function couponRouteAdd($fav_num='',$fav_price='',$start='',$end='',$province='',$city='',$ge_num='',$sprovince='',$scity='',$block=''){
        $sdes = $sprovince.','.$scity.','.$block;
        $des = $province.','.$city;
        for($i=0;$i<$ge_num;$i++){
            $data['fav_code'] = get_code('TF');
            $data['fav_type'] = 'J';
            $data['fav_startime'] = $start;
            $data['fav_endtime'] = $end;
            $data['fav_star'] = $sdes;
            $data['fav_end'] = $des;
            $data['fav_flag'] = 'Y';
            $data['fav_num'] = $fav_num;
            $data['fav_left'] = $fav_num;
            $data['fav_price'] = $fav_price*100;
            $res[$i] = $this -> add($data);
            if($i==0){
                $result = $res[$i];
            }else{
                $result = $res[$i]&&$res[$i-1];
            }
        }
        return $result;
    }
    /**
     * 获取集散地优惠券信息
     * @date: 2016-8-9 下午2:17:22
     * @author: liuxin
     * @param unknown $id 优惠券id
     * @return array
     */
    public function getRouteInfo($id){
        $map['fav_id'] = array('eq',$id);
        $list = $this -> where($map) -> find();
        $sproId = $list['fav_star'];
        $proId = $list['fav_end'];
        $sarr[] = explode(',',$sproId);
        $arr[] = explode(',',$proId);
        $areaObj = M('area');
        $maps['area_id'] = array('eq',$arr[0][0]);
        $mapss['area_id'] = array('eq',$arr[0][1]);
        $mas['area_id'] = array('eq',$sarr[0][0]);
        $mass['area_id'] = array('eq',$sarr[0][1]); 
        $masss['area_id'] = array('eq',$sarr[0][2]);
        $pro = $areaObj -> where($maps) -> find();
        $city = $areaObj -> where($mapss) -> find();
        $spro = $areaObj -> where($mas) -> find();
        $scity = $areaObj -> where($mass) -> find();
        $block = $areaObj -> where($masss) -> find();
        $data['pro'] = $pro['area_name'];
        $data['city'] = $city['area_name'];
        $data['proId'] = $arr[0][0];
        $data['cityId'] = $arr[0][1];
        $data['spro'] = $spro['area_name'];
        $data['scity'] = $scity['area_name'];
        $data['sproId'] = $sarr[0][0];
        $data['scityId'] = $sarr[0][1];
        $data['block'] = $block['area_name'];
        $data['blockId'] = $sarr[0][2];
        $data['info'] = $list;
        return $data;
    }
    /**
     * 编辑集散地优惠券信息
     * @date: 2016-8-9 下午2:18:01
     * @author: liuxin
     * @param string $fav_num  使用次数
     * @param string $fav_price 优惠券金额
     * @param string $start     开始时间
     * @param string $end  结束时间
     * @param string $province  结束省
     * @param string $city  结束市
     * @param unknown $id  优惠券id
     * @param string $sprovince 开始省 
     * @param string $scity 开始市
     * @param string $block 开始区
     * @return Ambigous <boolean, unknown>
     */
    public function couponRouteEdit($fav_num,$fav_price,$start,$end,$province,$city,$id,$sprovince,$scity,$block){
        $des = $province.','.$city;
        $sdes = $sprovince.','.$scity.','.$block;
        $map['fav_id'] = array('eq',$id);
        $data['fav_type'] = 'J';
        $data['fav_startime'] = $start;
        $data['fav_endtime'] = $end;
        $data['fav_star'] = $sdes;
        $data['fav_end'] = $des;
        //$data['fav_flag'] = 'Y';
        $data['fav_num'] = $fav_num;
        $data['fav_price'] = $fav_price*100;
        $res = $this -> where($map) -> save($data);
        return $res;
    }
    /**
     * 获取通用优惠券信息
     * @date: 2016-8-9 下午2:19:46
     * @author: liuxin
     * @param unknown $id 优惠券id
     * @return array
     */
    public function getAllInfo($id){
        $map['fav_id'] = array('eq',$id);
        $list = $this -> where($map) -> find();
        return $list;
    }
    /**
     * 通用优惠券编辑
     * @date: 2016-8-9 下午2:20:19
     * @author: liuxin
     * @param string $fav_num 使用次数
     * @param string $fav_price 优惠金额
     * @param string $start 开始时间
     * @param string $end   结束时间
     * @param string $id    优惠券id
     * @return string
     */
    public function couponAllEdit($fav_num='',$fav_price='',$start='',$end='',$id=''){
       // $des = $province.','.$city;
        $map['fav_id'] = array('eq',$id);
        $data['fav_type'] = 'W';
        $data['fav_startime'] = $start;
        $data['fav_endtime'] = $end;
       // $data['fav_end'] = $des;
        //$data['fav_flag'] = 'Y';
        $data['fav_num'] = $fav_num;
        $data['fav_price'] = $fav_price*100;
        $res = $this -> where($map) -> save($data);
        return $res;
    }
    public function couponEdit($data){
        $id=$data['fav_id'];
        $where['fav_id']=$id;
        if($data['fav_price']){
            $data['fav_price']=$data['fav_price']*100;
        }
        $res=$this -> where($where) -> save($data);
        return $res;
    }
    /**
     * 添加通用优惠券
     * @date: 2016-8-9 下午2:21:25
     * @author: liuxin
     * @param string $fav_num 使用次数
     * @param string $fav_price 优惠金额
     * @param string $start 开始时间
     * @param string $end   结束时间
     * @param string $ge_num 添加数量
     * @return Ambigous <boolean, unknown>
     */
    public function couponAllAdd($fav_num='',$fav_price='',$start='',$end='',$ge_num=''){
    
        //$des = $province.','.$city;
        for($i=0;$i<$ge_num;$i++){
            $data['fav_code'] = get_code('TF');
            $data['fav_type'] = 'W';
            $data['fav_startime'] = $start;
            $data['fav_endtime'] = $end;
            //$data['fav_end'] = $des;
            $data['fav_flag'] = 'Y';
            $data['fav_num'] = $fav_num;
            $data['fav_left'] = $fav_num;
            $data['fav_price'] = $fav_price*100;
            $res[$i] = $this -> add($data);
            if($i==0){
                $result = $res[$i];
            }else{
                $result = $res[$i]&&$res[$i-1];
            }
        }
        return $result;
    }
    /**
     * 批量删除
     * @date: 2016-8-9 下午2:22:04
     * @author: liuxin
     * @param unknown $arr 批量删除的id组成的数组
     * @return string
     */
    public function delAll($arr){
        $map['fav_code'] = array('in',$arr);
        $res = $this -> where($map) -> delete();
        return $res;
    }
    /**
     * 分配优惠券
     * @date: 2016-8-9 下午2:22:53
     * @author: liuxin
     * @param string $id 优惠券id
     * @param string $num 用户电话号
     * @return string
     */
    public function assigns($id='',$num=''){
        $user = M('user');
        $map['tel'] = array('eq',$num);
        $info = $user -> where($map) -> find();
        if($info==null){
            return 'E';
        }
        $maps['fav_id'] = array('eq',$id);
        $infos = $this -> where($maps) -> find();
        $data['user_code'] = $info['user_code'];
        $data['fav_left'] = $infos['fav_num'];
        $data['fav_status'] = 'N';
        $data['fav_flag'] = 'N';
        $res = $this -> where($maps) -> save($data);
        if($res){
            return 'Y';
        }else{
            return 'N';
        }
        
    }
} 