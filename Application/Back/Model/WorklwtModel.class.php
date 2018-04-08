<?php
namespace Back\Model;
use Think\Model;
class WorklwtModel extends BaseModel{
	/**
     * 广告查询或删除
     */
    function AdvDel($mark='',$id=''){
        $masObj = M('adv_img');//分类
        $map['adv_img_id'] = array('eq',$id);
        if($mark=='C'){
            return $masObj->where($map) ->find();
        }else{
            $masObj->where($map) ->delete();
            return true;
        }
    }
    
    /**
     * 广告添加
     */
    function advAdd($data=''){
        $masObj = M('adv_img');
        $ret = $masObj->add($data);
        if($ret){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 广告修改
     */
    function advUpdate($data='',$id=''){
        $masObj = M('adv_img');
        $map['adv_img_id'] = array('eq',$id);
        $ret = $masObj->where($map)->save($data);
        if($ret){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 查询所有广告
     */
    function advList($ac=''){
        $ghwObj = M("adv_img");//作品表
        if($ac !=''){
         $map['adv_img_title'] = array('like','%'.$ac.'%');
         $par['name'] = $ac;
        }
        //$map['ga_mark'] = array('eq','A');
        $count = $ghwObj->where($map) ->count();
        $page = set_page($count,10);
        $list = $ghwObj
        //->join("left join gypt_adv_config ON gypt_adv_config.gac_code = gypt_adv.ga_adposition")
        ->where($map)->limit($page->limit)->order('adv_img_id asc')->select();
        $show = $page->BackPage();
        $size = count($list);
        for ($i = 0; $i < $size; $i++) {
            $list[$i]['dis'] = C('STATIC_PROPERTY.ADV_CONFIG')[$list[$i]['adv_code']];
        }
        if($size>0){
            $data['show'] = $show;
        }
        $data['list'] = $list;
        return $data;
    }
    /**
     * 内容查询或删除
     */
    function contDel($mark='',$id=''){
        $masObj = M('article');//分类
        $map['article_id'] = array('eq',$id);
        if($mark=='C'){
            return $masObj->where($map) ->find();
        }else{
            $masObj->where($map) ->delete();
            return true;
        }
    }
    
    /**
     * 内容添加
     */
    function contAdd($data=''){
        $masObj = M('article');
        $ret = $masObj->add($data);
        if($ret){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 内容修改
     */
    function contUpdate($data='',$id=''){
        $masObj = M('article');
        $map['article_id'] = array('eq',$id);
        $ret = $masObj->where($map)->save($data);
        if($ret){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 查询所有内容
     */
    function contList($ac='',$type=''){
        $ghwObj = M("article");//作品表
        if($ac !=''){
            $map['title'] = array('like','%'.$ac.'%');
            $par['name'] = $ac;
        }
        if($type !=""){
            $map['article_pid'] = array('eq',$type);
            $par['type'] = $type;
        }
        //$map['ga_mark'] = array('eq','A');
        $count = $ghwObj->where($map) ->count();
        $page = set_page($count,10);
        $list = $ghwObj
        //->join("left join gypt_adv_config ON gypt_adv_config.gac_code = gypt_adv.ga_adposition")
        ->where($map)->limit($page->limit)->order('article_time desc')->select();
        $show = $page->BackPage();
        $size = count($list);
        for ($i = 0; $i < $size; $i++) {
            $list[$i]['dis'] = C('STATIC_PROPERTY.OTHER_INFO')[$list[$i]['article_pid']];
        }
        if($size>0){
            $data['show'] = $show;
        }
        $data['list'] = $list;
		//var_dump($list);
		//exit;
        return $data;
    }
    /**
     * 查询所有意见反馈
     */
    function ideaList($start='',$end=''){
        $ghwObj = M("jyfk");//作品表
        if($start !='' && $end!=""){
            if($start == $end){
                $map['yj_time'] = array(array("EGT",date("Y-m-d H:i:s",strtotime($start)-1)),array("ELT",date("Y-m-d H:i:s",strtotime($end)+24*(3600-1))),"and");
            }else{
                $map['yj_time'] = array(array('egt',$start),array('elt',$end));
            }
            $par['start'] = $start;
            $par['end'] = $end;
        }
        //$map['ga_mark'] = array('eq','A');
        $count = $ghwObj->where($map) ->count();
        $page = set_page($count,10);
        $list = $ghwObj
        //->join("left join gypt_adv_config ON gypt_adv_config.gac_code = gypt_adv.ga_adposition")
        ->where($map)->limit($page->limit)->order('yj_time desc')->select();
        $show = $page->BackPage();
        $size = count($list);
        /* for ($i = 0; $i < $size; $i++) {
         $list[$i]['dis'] = C('STATIC_PROPERTY.ADV_CONFIG')[$list[$i]['adv_code']];
        } */
        if($size>0){
            $data['show'] = $show;
        }
        $data['list'] = $list;
        return $data;
    }
    /**
     * 反馈意见查看详情
     */
    function ideaInfo($id=''){
        $masObj = M('jyfk');//分类
        $map['yj_id'] = array('eq',$id);
        return $masObj->where($map) ->find();
    }
    /**
     * 系统设置
     */
    function getSystem(){
        $masObj = M('system');//分类
        return $masObj->find();
    }
    /**
     * 系统设置修改
     */
    function systemUpdate($data=''){
        $masObj = M('system');//分类
        $dd = $masObj->where("id=1")->save($data);
        if($dd){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取用户是否下单
     */
    function getOrder($val = ''){
        $masObj = M('order');
        $city = M("area");
        $map['user_tel'] = array('eq',$val);
        $map['pay_status'] = array('eq','W');
        $map['order_status'] = array('eq','S');
        $list = $masObj
                ->join("left join tuo_order_info ON tuo_order_info.order_code = tuo_order.order_code")
                -> where($map) -> order("order_time desc") ->limit("3") -> select();
        $num = count($list);
        for ($i = 0; $i < $num; $i++) {
            $star = explode(",",$list[$i]['order_info_star']);
            $end = explode(",",$list[$i]['order_info_end']);
            $map_s['area_id'] = array('eq',$star[1]);
            $map_e['area_id'] = array('eq',$end[1]);
            $s_area = $city->where($map_s)->find();
            $e_area = $city->where($map_e)->find();
            $list[$i]['start_city'] = $s_area['area_name'];
            $list[$i]['end_city'] = $e_area['area_name'];
        }
        $data['num'] = $masObj-> where($map) -> count();
        $data['data'] = $list;
        return $data;
    }
    /**
     * 获取车辆信息
     */
    function getCar($pid=0){
        $masObj = M('carxing');
        $map['cxjj_pid'] = array('eq',$pid);
        $data = $masObj->where($map) -> select();
        return $data;
    }
    /**
     * 获取城市区域
     */
    function getCitys($pid=1){
        $masObj = M('area');
        $map['area_pid'] = array('eq',$pid);
        $data = $masObj->where($map) -> select();
        return $data;
    }
    /**
     * 获取价格
     * @param return 
     * baopr 车辆报价
     * totel 总价
     * san_price 运输费
     * ti_price 提车费
     * song_price 送车费
     * sm_price 上门提车
     */
    function getPrice($data=''){
        $tiObj = M("ti");//提车费
        $soObj = M("song");//送车
        $smObj = M("sm");//上门提车
        $lsObj = M("line_san");//集散地
        $syObj = M("system");//保险
        $maObj = M("maoli");//毛利
        $map_ti['ti_star'] = array('eq',$data['city_shi']);//提车
        $ti = $tiObj -> where($map_ti) -> find();
        $map_so['song_end'] = array('eq',$data['city_jie_shi']);//送车
        $so = $soObj -> where($map_so) -> find();
        if($data['smsc'] == 'Y'){
            $map_sm['sm_end'] = array('eq',$data['city_qus']);//上门
            $map_sm['sm_star'] = array('eq',$data['city_jie_shi']);//上门
            $sm = $smObj -> where($map_sm) -> find();
        }
        $map_ls['san_star'] = array('eq',$ti['ti_end']);//集散
        $map_ls['san_end'] = array('eq',$so['song_star']);//集散
        $ls = $lsObj -> where($map_ls) -> find();
        $map_ma['ml_star'] = array('eq',explode(",",$data['city_shi'])[0]);
        $map_ma['ml_end'] = array('eq',explode(",",$data['city_jie_shi'])[0]);
        $mao = $maObj -> where($map_ma) -> find();
        
        $bao = $syObj ->where('id=1')->find();//保险
        $baopri = $data['car_baojia'] * $bao['acale']/100;
        if($data['way'] == 'S'){
            //司机
            if($data['smsc'] == 'Y'){
                $totel = $mao['ml_price'] + $ls['san_price'] + $ti['ti_platelets_price'] + $so['song_platelets_price'] + $sm['sm_platelets_price'] + $data['car_xing'] + $baopri;// +$data['car_baojia'];
                $list['san_price'] = $mao['ml_price'] + $ls['san_price'] + $ti['ti_platelets_price'] + $so['song_platelets_price'] + $sm['sm_platelets_price'] + $data['car_xing'];
            }else{
                $totel = $mao['ml_price'] + $ls['san_price'] + $ti['ti_platelets_price'] + $so['song_platelets_price'] + $data['car_xing'] + $baopri;// +$data['car_baojia'];
                $list['san_price'] = $mao['ml_price'] + $ls['san_price'] + $ti['ti_platelets_price'] + $so['song_platelets_price'] + $data['car_xing'];
            }
        }else{
            //小板
            if($data['smsc'] == 'Y'){
                $totel = $mao['ml_price'] + $ls['san_price'] + $ti['ti_driver_price'] + $so['song_driver_price'] + $sm['sm_driver_price'] + $data['car_xing'] + $baopri;// +$data['car_baojia'];
                $list['san_price'] = $mao['ml_price'] + $ls['san_price'] + $ti['ti_driver_price'] + $so['song_driver_price'] + $sm['sm_driver_price'] + $data['car_xing'];
            }else{
                $totel = $mao['ml_price'] + $ls['san_price'] + $ti['ti_driver_price'] + $so['song_driver_price'] + $data['car_xing'] + $baopri;// +$data['car_baojia'];
                $list['san_price'] = $mao['ml_price'] + $ls['san_price'] + $ti['ti_driver_price'] + $so['song_driver_price'] + $data['car_xing'];
            }
        }
        $list['baopr'] = $baopri;
        $list['totel'] = $totel;
        $list['ti_price'] = $data['way']=="S"?$ti['ti_platelets_price']:$ti['ti_driver_price'];//$ti['ti_price'];
        $list['song_price'] = $data['way']=="S"?$so['song_platelets_price']:$so['song_driver_price'];//$so['song_price'];
        $list['sm_price'] = $data['way']=="S"?$sm['sm_platelets_price']:$sm['sm_driver_price'];//$sm['sm_price'];
        $list['ml_price'] = $mao['ml_price'];
        return $list;
        
    }
    /**
     * 潜在用户生成订单
     */
    function setOrder($data='',$datas='',$data_m=''){
        $model = new Model();//开启事务
        $model -> startTrans();
        $obj = M("order");//订单表
        $oiObj = M("order_info");//明细表
        $miObj = M("user");//会员表
        $map['tel'] = array('eq',$data_m['tel']);
        $rll = $miObj -> where($map) ->find();
		$orderTouMap="1=1";
		$listTou = $obj->where($orderTouMap)->order('order_id desc')->select();
		$order_code = $listTou[0]['order_code'];//头表code
		$oiMap['order_code'] = array("eq",$order_code);
		$oiList = $oiObj->where($oiMap)->order('order_info_id desc')->select();
		$order_info_code = $oiList[0]['order_info_code'];;//头表code
		
		$order_code_linshi = $order_code + 1;
		$data['order_code'] = "0".$order_code_linshi;
		$order_info_code_linshi = $order_info_code + 1;
		$datas['order_info_code'] = "0".$order_info_code_linshi;
		$datas['order_code'] = $data['order_code'];
		
        if(!$rll){
            $resd = $miObj->add($data_m);
            $ret = $obj->add($data);
            $datas['order_id'] = $ret;
            $res = $oiObj->add($datas);
            if($ret&&$res&&$resd){
                $model->commit();
                return true;
            }else{
                $model->rollback();
                return false;
            }
        }else{
            $data['user_code'] = $rll['user_code'];
            $ret = $obj->add($data);
            $datas['order_id'] = $ret;
            $res = $oiObj->add($datas);
            if($ret&&$res){
                $model->commit();
                return true;
            }else{
                $model->rollback();
                return false;
            }
        }
        
    }
    /**
     * 查询所有潜在用户订单
     */
    function latencyMemberList($ac=''){
        $ghwObj = M("order");//作品表
		$oiObj = M("order_info");//明细表
        $arObj = M("area"); //地区表
        if($ac !=''){
            $map['user_tel'] = array('like',"%".$ac."%");
            $par['name'] = $ac;
        }
        $count = $ghwObj->where($map) ->count();
        $page = set_page($count,10);
        $list = $ghwObj
        ->where($map)->limit($page->limit)->order('order_time desc')->select();
        $show = $page->BackPage();
        $size = count($list);
		for($i=0;$i<count($list);$i++){
			$map['order_id'] = array('eq',$list[$i]['order_id']);
			$infos = $oiObj -> where($map) -> find();
			$list[$i]['order_info_brand'] = $infos['order_info_brand'];
			$list[$i]['order_info_type'] = $infos['order_info_type'];
			$list[$i]['order_info_carmark'] = $infos['order_info_carmark'];
			$sheng = explode(",",$infos['order_info_star']);
			$zhong = explode(",",$infos['order_info_end']);
			if($sheng[0] != ""){
				$list[$i]['c_sheng'] = $arObj -> where("area_id=".$sheng[0])->find()['area_name'];
				$list[$i]['c_shi'] = $arObj -> where("area_id=".$sheng[1])->find()['area_name'];
				$list[$i]['c_qu'] = $arObj -> where("area_id=".$sheng[2])->find()['area_name'];
			}else{
				$list[$i]['c_sheng'] = "";
				$list[$i]['c_shi'] = "";
				$list[$i]['c_qu'] = "";
			}
			if($zhong[0] != ""){
				$list[$i]['z_sheng'] = $arObj -> where("area_id=".$zhong[0])->find()['area_name'];
				$list[$i]['z_shi'] = $arObj -> where("area_id=".$zhong[1])->find()['area_name'];
			}else{
				$list[$i]['z_sheng'] = "";
				$list[$i]['z_shi'] = "";
			}
			$list[$i]['c_adres'] = $infos['order_info_star_address'];
			$list[$i]['order_info_smsc'] = $infos['order_info_smsc'];
			$list[$i]['order_way'] = $infos['order_way'];
			$list[$i]['order_info_end_address'] = $infos['order_info_end_address'];
			$list[$i]['order_info_price'] = $infos['order_info_price'];
			$list[$i]['order_info_c_car'] = $infos['order_info_c_car'];
			$list[$i]['order_info_bxd'] = $infos['order_info_bxd'];
			$list[$i]['order_info_zj'] = $infos['order_info_zj'];
			$list[$i]['order_info_remark'] = $infos['order_info_remark'];
		}
	//var_dump($list);
	//exit;
        if($size>0){
            $data['show'] = $show;
        }
        $data['list'] = $list;
        return $data;
    }
    /**
     * 查看订单信息
     */
    function checkLateInfo($id=''){
        $obj = M("order");//订单表
        $oiObj = M("order_info");//明细表
        $arObj = M("area");
        $map['order_id'] = array('eq',$id);
        $info = $obj -> where($map) -> find();
        $infos = $oiObj -> where($map) -> find();
        $data['user_tel'] = $info['user_tel'];
        $data['user_name'] = $info['user_name'];
        $data['order_info_brand'] = $infos['order_info_brand'];
        $data['order_info_type'] = $infos['order_info_type'];
        $data['order_info_carmark'] = $infos['order_info_carmark'];
        $sheng = explode(",",$infos['order_info_star']);
        $data['c_sheng'] = $arObj -> where("area_id=".$sheng[0])->find()['area_name'];
        $data['c_shi'] = $arObj -> where("area_id=".$sheng[1])->find()['area_name'];
        $data['c_qu'] = $arObj -> where("area_id=".$sheng[2])->find()['area_name'];
        $data['c_adres'] = $infos['order_info_star_address'];
        $zhong = explode(",",$infos['order_info_end']);
        $data['z_sheng'] = $arObj -> where("area_id=".$zhong[0])->find()['area_name'];
        $data['z_shi'] = $arObj -> where("area_id=".$zhong[1])->find()['area_name'];
        $data['order_info_smsc'] = $infos['order_info_smsc'];
        $data['order_way'] = $info['order_way'];
        $song = explode(",",$infos['order_info_smscd']);
        if($data['order_info_smsc'] =='Y'){
            $data['s_sheng'] = $arObj -> where("area_id=".$song[0])->find()['area_name'];
            $data['s_shi'] = $arObj -> where("area_id=".$song[1])->find()['area_name'];
            $data['s_qu'] = $arObj -> where("area_id=".$song[2])->find()['area_name'];
        }
        $data['order_info_end_address'] = $infos['order_info_end_address'];
        $data['order_info_price'] = $infos['order_info_price'];
        $data['order_info_c_car'] = $infos['order_info_c_car'];
        $data['order_info_bxd'] = $infos['order_info_bxd'];
        $data['order_info_zj'] = $infos['order_info_zj'];
        $data['order_info_remark'] = $infos['order_info_remark'];
        return $data;
    }
    /**
     * 获取区域
     */
    function getCityInfo($id){
        $arObj = M("area");
        $map['area_id'] = array('eq',$id);
        return $arObj ->where($map) -> find()['area_name'];
    }
    /**
     * 显示价格规则
     */
    function priceList($where){
        $model =M('system_group');
        $num = $model->where($where)->count();
        $page = set_page($num,10);
        $info['page'] = $page -> BackPage();
        $info['list'] = $model->limit($page->limit)->where($where)->select();
        return $info;
    }
    /**
     * 检测价格是否存在
     */
    function jianPrice($star){
        if (empty($star)) return "参数错误！";
        $dmodel = M('system_group');
        $map['group_star'] = array('eq',$star);
        //$map['group_end'] = array('eq',$end);
        return $dmodel->where($map)->find();
    }
    /*
     * 查询所有友情链接
     */
    function getLink($name){
        $model = M('Link');
        if ($name) $map['fl_name'] = array('like','%'.$name.'%');
        $count = $model->where($map) ->count();
        $page = set_page($count,20);
        $info['page'] = $page->BackPage();
        $info['list'] = $model->where($map)->limit($page->limit)->order('fl_sort desc')->select();
        return $info;
    }
}