<?php
namespace Back\Controller;
class WorklwtController extends BaseController {
    /**
     * 广告列表
     */
    public function advList(){
        $name=I("name");
        $list = D("Worklwt")->advList($name);
        $this->assign("list",$list);
        $this->assign("name",$name);
    	$this->display("Adv:list");
    }
    /**
     * 广告添加
     */
    public function advAdd(){
        $masObj = D('Worklwt');
        $id = I("id");
        if($id == ''){
            $this->assign('token',$this->token(8));
        }else{
            $ss = $masObj ->AdvDel('C',$id);
            $this->assign("des",C('STATIC_PROPERTY.ADV_CONFIG')[$ss['adv_code']]);
            $this->assign('data',$ss);
        }
        $this->assign("sk",C('STATIC_PROPERTY.ADV_CONFIG'));
        $this->display("Adv:add");
    }
    /**
     * 广告数据添加
     */
    function adv_insert(){
        $masObj = D('Worklwt');
        $adv_img_id = I("adv_img_id");
        //$accs = json_decode(des_decrypt_php(session('master')),true);
        if($adv_img_id==''){
            //添加
            $code = des_decrypt_php(session('token'),true);
            $token = des_decrypt_php(I("token"),true);
            if($token == $code){
                $data['adv_img_code'] = get_code('AIC');
                $data['adv_img_title'] = I("title");
                $data['adv_img'] = I("adv_img");
                $data['adv_img_url'] = I("adv_img_url");
                $data['adv_code'] = I("adv_code");
                $data['adv_img_info'] = I("adv_img_info");
                $masObj = D('Worklwt');
                $res = $masObj->advAdd($data);
                //缺少权限添加
                if($res){
                    $this->success('添加成功',U('Worklwt/advList'));
                }else{
                    $this->error("添加失败");
                }
            }else{
                $this->error("历史数据重复提交",U('Worklwt/advList'));
            }
        }else{
            //修改
            $data['adv_img_title'] = I("title");
            $data['adv_img'] = I("adv_img");
            $data['adv_img_url'] = I("adv_img_url");
            $data['adv_code'] = I("adv_code");
            $data['adv_img_info'] = I("adv_img_info");
            $masObj = D('Worklwt');
            $res = $masObj->advUpdate($data,$adv_img_id);
            //缺少权限添加
            if($res){
                $this->success('修改成功',U('Worklwt/advList'));
            }else{
                $this->error("修改失败");
            }
        }
    }
    /**
     * 广告删除
     */
    function advDels(){
        $masObj = D('Worklwt');
        $id = I("id");
        $res = $masObj ->AdvDel('D',$id);
        if($res){
            $this->success('删除成功',U('Worklwt/advList'));
        }else{
            $this->error("删除失败");
        }
    }

    /**
     * 内容列表
     */
    public function contList(){
        $name=I("name");
        $type=I("type");
        $list = D("Worklwt")->contList($name,$type);
        $this->assign("sk",C('STATIC_PROPERTY.OTHER_INFO'));
        $this->assign("list",$list);
        $this->assign("name",$name);
        $this->assign("type",$type);
        $this->display("Cont:list");
    }
    /**
     * 内容添加
     */
    public function contAdd(){
        $masObj = D('Worklwt');
        $id = I("id");
        if($id == ''){
            $this->assign('token',$this->token(8));
        }else{
            $ss = $masObj ->contDel('C',$id);
            $this->assign("des",C('STATIC_PROPERTY.OTHER_INFO')[$ss['article_pid']]);
            $this->assign('data',$ss);
        }
        $this->assign("sk",C('STATIC_PROPERTY.OTHER_INFO'));
        $this->display("Cont:add");
    }
    /**
     * 内容数据添加
     */
    function cont_insert(){
        $masObj = D('Worklwt');
        $article_id = I("article_id");
        
        //$accs = json_decode(des_decrypt_php(session('master')),true);
        if($article_id==''){
            //添加
            $code = des_decrypt_php(session('token'),true);
            $token = des_decrypt_php(I("token"),true);
            if($token == $code){
                $data['article_code'] = get_code('AC');
                $data['title'] = I("title");
                $data['content'] = $_POST['contents'];
                $data['mob_cont'] = $_POST['mob_cont'];
                $data['key_words'] = I("key_words");
                $data['article_pid'] = I("article_pid");
                $data['article_img'] = I("article_img");
				if(I("desc") != ""){
					$data['article_desc'] = I("desc");
				}
                $data['article_time'] = date('Y-m-d H:i:s',time());
                $masObj = D('Worklwt');
                $res = $masObj->contAdd($data);
                //缺少权限添加
                if($res){
                    $this->success('添加成功',U('Worklwt/contList'));
                }else{
                    $this->error("添加失败");
                }
            }else{
                $this->error("历史数据重复提交",U('Worklwt/contList'));
            }
        }else{
            //修改
            $data['title'] = I("title");
            $data['content'] = $_POST['contents'];
            $data['mob_cont'] = $_POST['mob_cont'];
            $data['key_words'] = I("key_words");
            $data['article_pid'] = I("article_pid");
            $data['article_img'] = I("article_img");
            $data['article_time'] = date('Y-m-d H:i:s',time());
            $data['article_desc'] = I("desc");
            $masObj = D('Worklwt');
            $res = $masObj->contUpdate($data,$article_id);
            //缺少权限添加
            if($res){
                $this->success('修改成功',U('Worklwt/contList'));
            }else{
                $this->error("修改失败");
            }
        }
    }
    /**
     * 意见反馈列表
     */
    public function ideaList(){
        $start=I("start");
        $end = I("end");
        $list = D("Worklwt")->ideaList($start,$end);
        $this->assign("list",$list);
        $this->assign("start",$start);
        $this->assign("end",$end);
        $this->display("Idea:list");
    }
    /**
     * 意见反馈详情
     */
    public function ideaInfo(){
        $id = I("id");
        $info = D("Worklwt")->ideaInfo($id);
        $this->assign("info",$info);
        $this->display("Idea:info");
    }
    /**
     * 系统设置
     */
    public function setSystem(){
        $info = D("Worklwt")->getSystem();
        $this->assign("info",$info);
        $this->display("System:info");
    }
    /**
     * 系统设置修改
     */
    public function systemUpdate(){
        $data['title'] = I("title");
        $data['keywords'] = I("keywords");
        $data['description'] = I("description");
        $data['icp'] = I("icp");
        $data['address'] = I("address");
        $data['tel'] = I("tel");
        $data['qrcode'] = I("qrcode");
        $data['acale'] = I("acale");
        $data['acale_clent']=I("acale_clent");
        $data['pay_time']=I("pay_time");
        $data['vat_rate'] =I("vat_rate");
        $data['tar_rate'] =I("tar_rate");
        $masObj = D('Worklwt');
        $res = $masObj->systemUpdate($data);
        if($res){
            $this->success('修改成功',U('Worklwt/setSystem'));
        }else{
            $this->error("修改失败");
        }
    }
    //上传文件
    function upload(){
        $upload = new \Think\Upload(C('UPLOAD_CONFIG'));// 实例化上传类
        // 上传文件
        $info =   $upload->upload();
        $data['flag'] = false;
        if(!$info) {// 上传错误提示错误信息
            $data['msg'] = '上传失败';
            $this->ajaxReturn($data);
        }else{// 上传成功
            $data['flag'] = true;
            $data['fileurl'] = '/Upload/'.$info['files']['savepath'].$info['files']['savename'];
            $this->ajaxReturn($data);
        }
    }
    /**
     * 潜在客户添加
     */
    function latencyMemberAdd(){
        $masObj = D('Worklwt');

        $this->assign("cart",$masObj->getCar());
        $this->assign('city',$masObj->getCitys());
        $this->display("Late:add");
    }
    /**
     * 获取用户是否下单
     */
    function getOrder(){
        $val = I("val");
        $masObj = D('Worklwt');
        $data = $masObj->getOrder($val);
        $this->ajaxReturn($data);
    }
    /**
     * 获取车型
     */
    function getCarXing(){
        $id = I("id");
        $masObj = D('Worklwt');
        $this->ajaxReturn($masObj->getCar($id));
    }
    /**
     * 获取城市区域
     */
    function getCitys(){
        $id = I("id");
        $masObj = D('Worklwt');
        $this->ajaxReturn($masObj->getCitys($id));
    }
    /**
     * 获取价格
     */
    function getPrice(){
        $data['car_baojia'] = I("car_baojia")*1000000;
        $data['car_xing'] = I("car_xing");
        $data['city_shi'] = I("city_shi");
        $data['city_jie_shi'] = I("city_jie_shi");
        $data['smsc'] = I("smsc");
        $data['city_qus'] = I("city_qus");
        $data['way'] = I("way");
        $masObj = D('Worklwt');
        $this->ajaxReturn($masObj->getPrice($data));
    }
    /**
     * 潜在用户订单提交
     */
    function setOrder(){
        $masObj = D('Worklwt');
        $accs = json_decode(des_decrypt_php(session('master')),true);
        $data['order_code'] = get_code("TO");
        $time = date("Y-m-d H:i:s",time());
        $mobile = I("mobile");
        $data_m['user_code'] = get_code("UC");
        //$data_m['user_name'] = $mobile;
        $data_m['tel'] = $mobile;
        $data_m['addtime'] = $time;
        $data_m['role'] = "C";

        $data['user_name'] = $mobile;
        $data['user_code'] = $data_m['user_code'];
        $data['user_tel'] = $mobile;
        $data['admin_code'] = $accs['admin_code'];
        $data['admin_name'] = $accs['admin_name'];
        $data['order_time'] = $time;
        $data['order_status'] = "S";
        $data['pay_status'] = 'W';
        $data['order_way'] = I('way');
        $data['mark_c'] = 'C';

        $datas['order_code'] = $data['order_code'];
        $datas['order_info_code'] = get_code("TOI");
        $datas['order_info_brand'] = I("car_pin");
        $datas['order_info_type'] = I("car_xing");
        $datas['order_info_carmark'] = I("carmark");
        $datas['order_info_zj'] = I("order_info_zj");
        $datas['order_info_price'] = I("order_info_price");
        $datas['order_info_c_car'] = I("order_info_c_car");
        $datas['order_info_t_car'] = I("order_info_t_car");
        $datas['order_info_s_car'] = I("order_info_s_car");
        $datas['order_smsc_car'] = I("order_smsc_car");
        $datas['order_info_add_price'] = I("order_info_add_price");
        $datas['order_info_bxd'] = I("order_info_bxd");
        $datas['order_info_smsc'] = I("smsc");
        $datas['order_info_star'] = I("order_info_star");
        $datas['order_info_star_address'] = I("order_info_star_address");
        $datas['order_info_end'] = I("order_info_end");
        $datas['order_info_smscd'] = I("order_info_smscd");
        $datas['order_info_end_address'] = I("city_addres");
        $datas['order_info_remark'] = I("order_info_remark");
        $datas['order_info_margin'] = I("order_info_margin");
		$datas['order_info_carmark'] = I("carmark");//车牌号码

        $ret = $masObj->setOrder($data,$datas,$data_m);
        if($ret){
            $this->success('添加成功',U('Worklwt/orderinfo',array('order_code'=>$data['order_code'])));
        }else{
            $this->error("添加失败",U('Worklwt/latencyMemberList'));
        }
    }
    //查看详细订单
    public function orderinfo(){
        $code = I('order_code');
        $model = D('Area');
        $omodel = D('Order');
        $info = $omodel->getAll($code);
        //车总价
        $info['price'] = $info['OrderInfo']['order_info_zj']/100;
        //车价
        $info['cj'] = $info['OrderInfo']['order_info_price']/100;
        //接车费
        $info['jc'] = $info['OrderInfo']['order_info_t_car']/100;
        //运车费
        $info['yc'] = $info['OrderInfo']['order_info_c_car']/100;
        //送车价
        $info['sc'] = $info['OrderInfo']['order_info_s_car']/100;
        //毛利
        $info['ml'] = $info['OrderInfo']['order_info_margin']/100;
        //车型加价
        $info['cxjj'] = $info['OrderInfo']['order_info_add_price']/100;
        //保险费
        $info['bx'] = $info['OrderInfo']['order_info_bxd']/100;
    
        //起始省
        $info['p'] = $info['OrderInfo']['order_info_star'][0];
        //起始市
        $info['c'] = $info['OrderInfo']['order_info_star'][1];
        //起始区
        $info['b'] = $info['OrderInfo']['order_info_star'][2];
        //目的地联系信息
        $info['stinfo'] = array_flip(array_flip(explode(',',$info['OrderInfo']['order_info_tclxr'])));
        //目的地省
        $info['pe'] = $info['OrderInfo']['order_info_end'][0];
        //目的地市
        $info['ce'] = $info['OrderInfo']['order_info_end'][1];
        //目的地联系信息
        $info['eninfo'] = array_flip(array_flip(explode(',',$info['OrderInfo']['order_info_sclxr'])));
        //提车人信息
        $info['tcr'] = D('CarHeader')->getData($info['CarOrder']['car_code']);
        //车型信息
        $cmodel = D('Carxing');
        $arr = array_flip(array_flip(explode(',',$info['CarOrder']['car_info_pai'])));
        $info['brand'] = $cmodel->getData($arr[0]);
        $info['type'] = $cmodel->getData($arr[1]);
        //分割图片
        $arrimg = array_flip(array_flip(explode(',',substr($info['CarOrder']['car_order_img'], 0,-1))));
        //价格
        foreach ($info['YunDan'] as $v){
            $v['yd_price'] = $v['yd_price']/100;
        }
        $this->assign('data',$info);
        $this->assign("yundan",$info['YunDan']);
        $this->assign('img',$arrimg);
        $this->display('Late:orderinfo');
    }
    /**
     * 修改订单
     */
    function updateOrder(){
        $code = I('code');
        $data['order_info_tclxr'] = I('ss');
        $data['order_info_sclxr'] = I('tt');
        $data['order_info_remark'] = I("cont");
        $map['order_code'] = array('eq',$code);
        $ret = M("order_info")->where($map)->save($data);
        if($ret){
            $msg['flag'] = true;
        }else{
            $msg['flag'] = false;
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 潜在用户列表
     */
    function latencyMemberList(){
        $name=I("name");
        $list = D("Worklwt")->latencyMemberList($name);
		//var_dump($list);
        $this->assign("name",$name);
        $this->assign("list",$list);
        $this->display("Late:list");
    }
    /**
     * 查看订单信息
     */
    function checkLateInfo(){
        $id = I("id");
        $info = D("Worklwt")->checkLateInfo($id);
        $this->assign("info",$info);
        $this->display("Late:info");
    }
    /**
     * 潜在用户发送短信
     */
    function sendMobile(){
        $mob = I("mob");
        $startd = I("start");
        $endd = I("end");
        $price = I("price");
        $car = I("car");
        $masObj = D('Worklwt');
        /* print_log('1212121212121212121212121212121212121212121212121212'.$startd);
        print_log('1212121212121212121212121212121212121212121212121212'.$endd); */
        $start = $masObj->getCityInfo($startd);
        $end = $masObj->getCityInfo($endd);
        $str = $mob.'您好，您咨询的'.$car.'从'.$start.'到'.$end.'托运价格为'.($price/100).'，客服电话：400-8771107，期待为您服务';
		if($mob != "" && $startd != "" && $endd != "" && $price != "" && $car != ""){
			send_mobile_sms($mob,$str);
			$data="短信发送成功";
			$this->ajaxReturn($data);
		}else{
			$data="短信发送失败";
			$this->ajaxReturn($data);
		}

    }
    /**
     * 大客户下单
     */
    function comOrder(){
        $uid = I("id");
        $masObj = D('Worklwt');

        $this->assign("user",D("user")->getOneMemInfo($uid));
        $this->assign("cart",$masObj->getCar());
        $this->assign('city',$masObj->getCitys());
        $this->display("Late:company_add");
    }
    /**
     * 大用户订单提交
     */
    function setMemberOrder(){
        $masObj = D('Worklwt');
        $accs = json_decode(des_decrypt_php(session('master')),true);
        $data['order_code'] = get_code("TO");
        $time = date("Y-m-d H:i:s",time());
        $mobile = I("mobile");
        $data_m['tel'] = I("tel_s");

        $data['user_name'] = I("user_name");
        $data['user_tel'] = $mobile;
        $data['admin_code'] = $accs['admin_code'];
        $data['admin_name'] = $accs['admin_name'];
        $data['order_time'] = $time;
        $data['order_status'] = "S";
        $data['pay_status'] = 'W';
        $data['order_way'] = I('way');
        $data['user_tel_t'] = I("tmobile");
        $data['mark_c'] = 'C';

        $datas['order_code'] = $data['order_code'];
        $datas['order_info_code'] = get_code("TOI");
        $datas['order_info_brand'] = I("car_pin");
        $datas['order_info_type'] = I("car_xing");
        $datas['order_info_carmark'] = I("carmark");
        $datas['order_info_zj'] = I("order_info_zj");
        $datas['order_info_price'] = I("order_info_price");
        $datas['order_info_c_car'] = I("order_info_c_car");
        $datas['order_info_t_car'] = I("order_info_t_car");
        $datas['order_info_s_car'] = I("order_info_s_car");
        $datas['order_smsc_car'] = I("order_smsc_car");
        $datas['order_info_add_price'] = I("order_info_add_price");
        $datas['order_info_bxd'] = I("order_info_bxd");
        $datas['order_info_smsc'] = I("smsc");
        $datas['order_info_star'] = I("order_info_star");
        $datas['order_info_star_address'] = I("order_info_star_address");
        $datas['order_info_end'] = I("order_info_end");
        $datas['order_info_smscd'] = I("order_info_smscd");
        $datas['order_info_end_address'] = I("city_addres");
        $datas['order_info_remark'] = I("order_info_remark");
        $datas['order_info_margin'] = I("order_info_margin");

        $ret = $masObj->setOrder($data,$datas,$data_m);
        if($ret){
            $this->success('添加成功',U('Worklwt/orderinfo'),array('order_code'=>$data['order_code']));
        }else{
            $this->error("下单失败",U('Member/getComMem'));
        }
    }

    //价格规则
    public function price(){
        $search = I('search');
        if ($search){
            $where['group_star'] = array('like','%'.$search.'%');
            $where['group_end'] = array('like','%'.$search.'%');
            $where['_logic'] = 'OR';
        }
        $masObj = D('Worklwt');
        $list = $masObj->priceList($where);
        $this->assign('list',$list['list']);
        $this->assign('page',$list['page']);
        $this->assign('search',$search);
        $this->display('System:price');
    }

    //设置价格规则
    public function setprice(){
        $model = M('system_group');
        $code = I('code');
        $fdpd_send = I('group_star');
        $img = I("imgs");
        //$fdpd_end = I('group_end');
        $send = I('send');
        $end = I('end');
        $fdpd_discount = I('group_scale');
        if (empty($fdpd_send)){
            $this->error("数量不能为空！");
        } /* elseif (empty($fdpd_end)){
            $this->error("末尾天数不能为空！");
        }  elseif (empty($fdpd_discount) or $fdpd_discount >'100' or $fdpd_discount < '0' or !is_numeric($fdpd_discount)){
            $this->error("折扣填写错误！");
        }*/
        $data = array(
            'group_star' => $fdpd_send,
            'group_url' => $img,
            //'group_end' => $fdpd_end,
            'group_scale' => $fdpd_discount*100,
        );
        if ($code){
            if (($fdpd_send != $send)){
                if (!empty(D('Worklwt')->jianPrice($fdpd_send))){
                    $this->error("数据已经存在！");
                }
            }
            if ($model->where(array('group_code'=>$code))->save($data)){
                $this->success('修改成功',U('Worklwt/price'));
            } else {
                $this->error("修改失败");
            }
        } else {
            if (!empty(D('Worklwt')->jianPrice($fdpd_send))) $this->error("数据已经存在！");
            $data['group_code'] = create_random_code(7);
            if ($model->add($data)){
                $this->success('添加成功',U('Worklwt/price'));
            } else {
                $this->error("添加失败");
            }
        }
    }

    //删除价格规则
    public function pricedel(){
        $did = I('post.did');
        $where['group_code'] = $did;
        $del = M('system_group')->where($where)->delete();
        if ($del){
            $data = '删除成功';
        } else {
            $data = '删除失败';
        }
        $this->ajaxReturn($data);
    }
    /*
     * 友情链接
     */
    function link(){
        $name = I('name');
        $model = D('Worklwt');
        $info = $model->getLink($name);
        $this->assign('list',$info['list']);
        $this->assign("name",$name);
        $this->assign('page',$info['page']);
        $this->display('Adv:link');
    }

    /*
     * 添加友情
     */
    function linkadd(){
        $fid = I('id');
        $model = M('link');
        if ($fid){
            $data = $model->where(array('fl_id'=>$fid))->find();
            $this->assign('data',$data);
        }
        $this->display('Adv:linkadd');
    }

    /*
     * 添加修改处理
     */
    function add_act(){
        $model = M('link');
        $fl_name = I('fl_name');
        $fl_link = I('fl_link');
        $fl_status = I('fl_status');
        $fl_sort = I('fl_sort');
        $fl_id = I('fl_id');
        $fl_img = I('fl_img');
        $fl_img1 = I('fl_img1');
        $data = array(
            'fl_name' =>	$fl_name,
            'fl_link' =>	$fl_link,
            'fl_status' =>	$fl_status,
            'fl_sort' =>	$fl_sort,
            'fl_img' =>     $fl_img,
            'fl_img1' =>     $fl_img1,
        );
        if ($_POST){
            if ($fl_id){
                if ($model->where(array('fl_id'=>$fl_id))->save($data)){
                    $this->success('修改成功！');
                } else {
                    $this->error('修改失败！');
                }
            } else {
                if ($model->add($data)){
                    $this->success('添加成功！');
                } else {
                    $this->error('添加失败！');
                }
            }
        }
    }

    /**
     * 友情删除
     */
    function linkDel(){
        $did = I('post.code');
        $where['fl_id'] = $did;
        $del = M('link')->where($where)->delete();
        if ($del){
            $data = '删除成功';
        } else {
            $data = '删除失败';
        }
        echo json_encode($data);
    }
    /**
     * 导入
     */
    function daoru(){
        $area = M("area");
        $area->where('1')->delete();
        $cc = array(
            'maxSize'=>3145728,
            'rootPath'=>'./Upload/',
            'saveName'=>array('uniqid',''),
            'exts'=>array('csv','xls'),
            'autoSub'=>true,
            'subName'=>array('date','Y-m-d'),
        );
        if($_FILES['csvFile']['tmp_name'] !=null){
            $upload = new \Think\Upload($cc);// 实例化上传类
            $info   =   $upload->uploadOne($_FILES['csvFile']);
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功 获取上传文件信息
                $url =  "Upload/".$info['savepath'].$info['savename'];
            }
        }
        $RootDir = $_SERVER['DOCUMENT_ROOT'];
        $csvFile = fopen($RootDir.$url,"r");
        $arr = array();
        while($da = fgetcsv($csvFile)){
            $arr[]=$da;
        }
        if(!empty($arr[1])){
            foreach($arr as $k=>$v){
                if($k == 0){
                    continue;
                }
                $data['area_id'] = $v[0];
                $data['area_name'] = iconv("gb2312","utf-8//IGNORE",$v[1]);
                $data['area_pid'] = $v[2];
                $data['area_type'] = $v[3];
                $data['area_add_time'] = date("Y-m-d H:i:s",time());
                $ret = $area -> add($data);
            }
            $this->success("添加成功");
        }else{
            $this->error('操作失败');
        }
    }
    /**
     * 导出
     */
    function daochu(){
        $ret = M("area")->select();
        $data['xlsName']  = "城市区域--导出".date("Y-m-d H:i:s",time());
        $data['xlsCell']  = array(
            array('area_id','id'),
            array('area_name','省市名称'),
            array('area_pid','父级id'),
            array('area_type','级别(省份1城市2区县3)'),
            array('area_set','可到达'),
            array('area_get','可提车')
        );
        $size = count($ret);
        for($i=0;$i<$size;$i++){
            $data['xlsData'][$i]['area_id'] = $ret[$i]['area_id'];
            $data['xlsData'][$i]['area_name'] = $ret[$i]['area_name'];
            $data['xlsData'][$i]['area_pid'] = $ret[$i]['area_pid'];
            $data['xlsData'][$i]['area_type'] = $ret[$i]['area_type'];
            $data['xlsData'][$i]['area_set'] = $ret[$i]['area_set']== 'Y' ? '是' : '';
            $data['xlsData'][$i]['area_get'] = $ret[$i]['area_get'] == 'Y' ? '是' : '';
        }
        exportExcel($data['xlsName'],$data['xlsCell'],$data['xlsData']);
    }
}