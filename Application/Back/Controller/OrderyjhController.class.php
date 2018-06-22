<?php
namespace Back\Controller;
class OrderyjhController extends BaseController{
    //订单列表
    public function orderList(){
        $oc = "";
        $jg = "";
        $star = I('star');
        $end = I('end');
        $service = I('service');
        $order_status = I('get.order_status');
        $provincea=I('provincea');
        $admin_name=I('admin_name');
        print_log("订单---条件---查询:".$order_status);
        $order = I('get.order');
        $model = D('Area');
        $omodel = D('OrderAssistant');
        if($provincea!='f' && $provincea!=''){
            $where1['order_info_star']=array('like','%'.$provincea.'%');
            $where1['order_info_end']=array('like','%'.$provincea.'%');
            $where1['_logic'] = 'or';
            $where['_complex'] = $where1;
        }
        if ($order){
            //订单号
            $map['order_code'] = array('like','%'.$order.'%');//订单号
            //车型
            $map['order_info_type'] = array('like','%'.$order.'%');
            //车牌
            $map['order_info_carmark'] = array('like','%'.$order.'%');
            //线路
            $map['order_info_star'] = array('like','%'.','.$order.','.'%');
            $map['order_info_end'] = array('like','%'.','.$order.','.'%');
            //手机号
            $map['user_code'] = array('like','%'.$order.'%');
            
            $map['_logic'] = 'or';
            $where['_complex'] = $map;
        }
        
        if ($order_status){
            print_log("订单---条判断条件中的件---查询:".$order_status);
            if($order_status=='V'){
                $where['visit'] = array('eq','Y');
	            $where['is_visit'] = array('eq','N');
            }else if($order_status=='R'){
                $where['receipt'] = array('eq','Y');
	            $where['is_hui'] = array('eq','N');
            }else if($order_status == 'S'){
                $where['order_status'] = array('eq',$order_status);
                $where['sh_status'] = array('eq','');
            }else if($order_status == 'Z'){
                $where['verify'] = array('eq',"N");
                $where['order_status'] = array('eq',"T");
            }else if($order_status == 'C'){
                $maps['_string'] = "(order_status='Y') OR (order_status='M') OR (order_status='N') OR (order_status='B') OR (order_status='G') OR (order_status='D')";
                $maps['_logic'] = 'or';
                $where['_complex'] = $maps;
            }else if($order_status == 'DIE'){
                $where['order_status'] = array('eq','S');
                $where['sh_status'] = array('eq','N');
            }else if($order_status == 'NUN'){
                $where['order_status'] = array('eq','DIE');
            }else{
                $where['order_status'] = array('eq',$order_status);
            }
        }else{
            $where['sh_status']=array("neq",'N');
            $where['order_status'] =array("neq",'DIE');
        }
        if ($star!=0 && $end!=0){$where['order_time'] = array('between',array($star,$end));}
        if($admin_name){
            $where['admin_name'] = array('like',"%$admin_name%");
        }
        $where[] = "1=1";
        print_log("订单条件查询:".json_encode($where));
        $info = $omodel->getInfo($where);
        
        
        print_log("查询条件:".json_encode($where));
        
        //print_log("订单列表:".json_encode($info['list']));
        foreach ($info['list'] as &$v){
            if ($v['OrderInfo']!=""){
                //车品牌
                $v['brand'] = $v['order_info_brand'];
                //车型
                $v['type'] = $v['order_info_type'];
                //车牌
                $v['carmark'] = $v['order_info_carmark'];
                //客户名
                $user = M("user")->where("tel=".$v['user_code'])->field("user_name")->find();
                $v['username'] = $user['user_name'];
            }else{
                //车品牌
                $v['brand'] = "";
                //车型
                $v['type'] = "";
                //车牌
                $v['carmark'] = "";
                //起始地
                $v['star'] = "";
                //目的地
                $v['end'] = "";
                //总金额
                $v['price'] = "";
                $v['username'] ="";
            }
                    $order_code=$v['order_code'];
                    $sper =M("yundan") ->where("order_code = '$order_code' and yd_type ='C'") ->order("yd_id desc") ->limit(1)->find();
                    $v['sper'] =$sper['yd_name'];
        }
        $num['num'] = $omodel->getNum();//总订单数
        $num['s'] = $omodel->getNum('S');//待审核总订单数
        $num['a'] = $omodel->getNum('A');//待安排总订单数
        $num['t'] = $omodel->getNum('T');//待提车总订单数
        $num['z'] = $omodel->getNums('Z');//待装板总订单数
        
        $num1 = $omodel->getNum('Y');//运输中待装板总订单数
        $num2 = $omodel->getNum('M');//运输中待中转总订单数
        $num3 = $omodel->getNum('N');//运输中待到达总订单数
        $num4 = $omodel->getNum('B');//运输中待送车总订单数
        $num5 = $omodel->getNum('G');//运输中待交车总订单数
        $num6 = $omodel->getNum('D');//运输中已到达总订单数
        
        $num['y'] = $num1+$num2+$num3+$num4+$num5+$num6;//运输中总订单数
        
        $num['w'] = $omodel->getNum('W');//已完成总订单数
        
        $num['v'] = $omodel->getVisitNum();//待回访总订单数
        $num['r'] = $omodel->getReceiptNum();//需回单总订单数
        $num['die'] = $omodel->getDieNum();//审核不通过订单数
        $num['nun'] = $omodel->getNunNum();//作废订单数
        if(count($info['list'])>0){
            $this->assign('page',$info['page']);
        }
        $provincea = $model->getArea(1);

        $this->assign("provincea",$provincea);
        $this->assign('list',$info['list']);
        $this->assign('order',$order);
        $this->assign('admin_name',$admin_name);
        //$this->assign('pay',$pay);
        $this->assign('num',$num);
        $this->assign('order_status',$order_status);
        $this->display();
    }
    //查看详细订单
    public function orderinfo(){
        $code = I('order_code');
        $this -> assign('code',$code);
        $model = D('Area');
        $omodel = D('OrderAssistant');
        $info = $omodel->getAll($code);
        //提车费
        $info['tc'] = $info['order_info_t_car']/100;
        //送车价
        $info['sc'] = $info['order_info_s_car']/100;
        //上门
        $info['sm'] = $info['order_smsc_car']/100;
        //集散费
        $info['js'] =$info['order_info_c_car']/100;
        //毛利
        $info['ml'] = $info['order_info_margin']/100;
        //运输费
        $info['yc'] = $info['tc']+$info['sc']+$info['sm']+$info['js']+$info['ml'];
        //总费用
        $info['zf']=$info['yc']+$info['order_info_bxd']/100+$info['bill_price']/100-$info['fav_price']/100;
        //起始省
        $info['p'] = $info['order_info_stars'][0];
        //起始市
        $info['c'] = $info['order_info_stars'][1];
        //起始区
        $info['b'] = $info['order_info_stars'][2];
        //目的地联系信息
        $info['stinfo'] = array_flip(array_flip(explode(',',$info['order_info_tclxr'])));
        //目的地省
        $info['pe'] = $info['order_info_ends'][0];
        //目的地市
        $info['ce'] = $info['order_info_ends'][1];
        //出发地联系人信息
        $info['order_info_tclxr']=explode(",",$info['order_info_tclxr']);
        //目的地联系信息
        $info['order_info_sclxr']=explode(",",$info['order_info_sclxr']);
        //使用优惠卷优惠金额
        $fav_price=M("favorable")->where("fav_code='".$info['fav_code']."'")->field("fav_price")->find();
        $info['fav_price']= $fav_price['fav_price'];
        //车型信息
        
        $cmodel = D('Carxing');
        $arr = array_flip(array_flip(explode(',',$info['CarOrder']['car_info_pai'])));
        $info['brand'] = $cmodel->getData($arr[0]);
        $info['type'] = $cmodel->getData($arr[1]);
        //分割图片
        $arrimg = array_flip(array_flip(explode(',',substr($info['CarOrder']['car_order_img'], 0,-1))));
        //价格
        foreach ($info['YunDan'] as &$v){
            $v['yd_price'] =empty($v['yd_price']) ? '-' : $v['yd_price'];
            $v['yd_name'] =empty($v['yd_name']) ? '-' : $v['yd_name'];
            $v['yd_line'] =empty($v['yd_line']) ? '-' : $v['yd_line'];
            $v['yd_j_gong'] =empty($v['yd_j_gong']) ? '-' : $v['yd_j_gong'];
            $v['yd_s_gong'] =empty($v['yd_s_gong']) ? '-' : $v['yd_s_gong'];
            $v['yd_tel'] =empty($v['yd_tel']) ? '-' : $v['yd_tel'];
            $v['yd_mark'] =empty($v['yd_mark']) ? '-' : $v['yd_mark'];
            $v['yd_indetity'] =empty($v['yd_indetity']) ? '-' : $v['yd_indetity'];
        }
        if($info['order_info_star'] !=''){
            $info['order_info_star_num'] =explode(",", $info['order_info_star']);
        }
        if($info['order_info_end'] !=''){
            $info['order_info_end_num'] =explode(",", $info['order_info_end']);
        }

        $arrive = M('arrive')->where("order_code='".$code."'")->find();

        //token验证 防止重复提交
        $this->assign("formToken",rand_token());
        $provincea = $model->getArea(1);
        $this->assign("provincea",$provincea);
        $this->assign('stut',$info['CarOrder']['car_info_status']);
        $this->assign('data',$info);
        $this->assign("position",$info['Position']);
        $this->assign("yundan",$info['YunDan']);
        $this->assign("unPaidList",$info['unpaidYunDan']);
        $this->assign("unpaidCount",$info['unpaidCount']['nums']);
        $this->assign("verify",$info['Verify']);
        //print_log("--图片:".json_encode($info['VerifyImg']));
        $this->assign("verifyImg",$info['VerifyImg']);
        $this->assign('img',$arrimg);
        $this->assign("times",date("Y-m-d",time()));
        $this->assign("path",C("DOMAINNAME"));
        $this->assign("log",D("Log")->getLogs($code));
        $this->assign("arrive",$arrive);
        $this->display();
    }
    /**
     * 修改订单
     */
    public function editOrder(){
        $data=I("post.");
        $wObj = D("Worktwo");
        print_log("------------------数组:".json_encode($data));
        $k = substr($data['keys'],0,strlen($data['keys'])-1);
        if($k == 'order_info_tclxr' || $k == 'order_info_sclxr'){
            $info = explode(",", $wObj->getOrderInfo($data['order_code'],$k));
        }
        $res=D("OrderAssistant")->editOrder($data);
        if($res){
            $ji['order_code'] = $data['order_code'];
            if($data['log_mark'] =="START"){
                $citys = explode(",",$data[$data['keys']]);
                $ss = explode(",",$data['cont_qian']);
                $ji['A'] = $wObj->getPlaceName($citys[1]);
                $ji['B'] = $wObj->getPlaceName($ss[1]);
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="END"){
                $citys = explode(",",$data[$data['keys']]);
                $ss = explode(",",$data['cont_qian']);
                $ji['A'] = $wObj->getPlaceName($citys[1]);
                $ji['B'] = $wObj->getPlaceName($ss[1]);
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="UPPRICE"){
                $ji['A'] = $data['order_info_zj'];
                $ji['B'] = $data['pr'];
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="DAISHOU"){
                $up_dir = '';
                if($_FILES['upfile']){
                    $img_name = explode('.',$_FILES['upfile']['name']);
                    $up_dir = time().'.'.$img_name['1'];
                    move_uploaded_file($_FILES['upfile']['tmp_name'], 'Upload/hzd/'.$up_dir);
                }
                $ji['A'] = $data['hui_man'];
                $ji['B'] = "无";
                $wObj->logsSet($data['log_mark'],$ji);
                //代收方
                $income = I("income");
                $hui_man = I("hui_man");
                $visit = I("visit");
                if($income ==""){
                    $A = "已收费";
                }else{
                    $A = '代收方-'.$income;
                }
                if($hui_man ==""){
                    $B = "不需要回单";
                }else{
                    $B = '回单人-'.$hui_man;
                }
                if($visit =="Y"){
                    $C = "需回访";
                }else{
                    $C = '不需要回访';
                }
                $strsh = C("STATIC_PROPERTY.LOGS")["JIAOCHE"];
                $strshs = sprintf($strsh[0],$data['order_code'],$A,$B,$C);
                $cobj = M('log');
                $admin = json_decode(des_decrypt_php(session('master')),true);
                $datas['admin_code'] = $admin['admin_name'];
                $datas['log_code'] = get_code('tl');
                $datas['log_time'] = date('Y-m-d H:i:s',time());
                $datas['log_content'] = $strshs;
                $datas['log_operation'] = $strsh[1];
                $datas['log_back_cont'] = "-";
                $datas['order_code'] = $data['order_code'];
                $ress = $cobj -> add($datas);

                $dataa['order_code'] = $data['order_code'];
                $dataa['arrive_img'] = $up_dir;
                $dataa['arrive_mark'] = $data['hfimg_mark'];
                M('arrive') -> add($dataa);

            }else if($data['log_mark'] =="UPSHOU"){
                $ji['A'] = $data['hui_man'];
                $ji['B'] = $data['cont_qian'];
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="CAR_XING"){
                $ji['A'] = $data[$data['keys']];
                $ji['B'] = $data['cont_qian'];
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="START_MAN"){
                $key = $data['keys'];
                if($key == 'order_info_tclxr0'){
                    $ji['A'] = $data[$key]." ".$info[1];
                }else{
                    $ji['A'] = $info[0]." ".$data[$key];
                }
                $ji['B'] = $info[0].' '.$info[1];
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="END_MAN"){
                $key = $data['keys'];
                if($key == 'order_info_sclxr0'){
                    $ji['A'] = $data[$key]." ".$info[1];
                }else{
                    $ji['A'] = $info[0]." ".$data[$key];
                }
                $ji['B'] = $info[0].' '.$info[1];
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="START_ADRES"){
                $ji['A'] = $data[$data['keys']];
                $ji['B'] = $data['cont_qian'];
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="END_ADRES"){
                $ji['A'] = $data[$data['keys']];
                $ji['B'] = $data['cont_qian'];
                $wObj->logsSet($data['log_mark'],$ji);
            }else if($data['log_mark'] =="HFANG"){
                $strsh = C("STATIC_PROPERTY.LOGS")["HFANG"];
                $strshs = sprintf($strsh[0],$data['order_code'],$data['visit_bei']);
                $cobj = M('log');
                $admin = json_decode(des_decrypt_php(session('master')),true);
                $datas['admin_code'] = $admin['admin_name'];
                $datas['log_code'] = get_code('tl');
                $datas['log_time'] = date('Y-m-d H:i:s',time());
                $datas['log_content'] = $strshs;
                $datas['log_operation'] = $strsh[1];
                $datas['log_back_cont'] = "-";
                $ress = $cobj -> add($datas);
            }else if($data['log_mark'] =="HUIDAN"){
                $strsh = C("STATIC_PROPERTY.LOGS")["HUIDAN"];
                $strshs = sprintf($strsh[0],$data['order_code']);
                $cobj = M('log');
                $admin = json_decode(des_decrypt_php(session('master')),true);
                $datas['admin_code'] = $admin['admin_name'];
                $datas['log_code'] = get_code('tl');
                $datas['log_time'] = date('Y-m-d H:i:s',time());
                $datas['log_content'] = $strshs;
                $datas['log_operation'] = $strsh[1];
                $datas['log_back_cont'] = "-";
                $ress = $cobj -> add($datas);
            }else if($data['log_mark'] =="DELORDER"){
                $strsh = C("STATIC_PROPERTY.LOGS")["DELORDER"];
                $strshs = sprintf($strsh[0],$data['order_code'],$data['cont']);
                $cobj = M('log');
                $admin = json_decode(des_decrypt_php(session('master')),true);
                $datas['admin_code'] = $admin['admin_name'];
                $datas['log_code'] = get_code('tl');
                $datas['log_time'] = date('Y-m-d H:i:s',time());
                $datas['log_content'] = $strshs;
                $datas['log_operation'] = $strsh[1];
                $datas['log_back_cont'] = "-";
                $ress = $cobj -> add($datas);
            }
            
            if(I("mark") == 'A'){
                $info = M("order_assistant")->where(array("order_code"=>$data['order_code']))->find();
                $us = M("user")->where(array("tel"=>$info['user_code']))->find();
                $str = sprintf(C("DUANXIN_MOBAN")['BXD'],
                $us['user_name'],
                $data['order_code'],
                '');//审核通过
                print_log("------------------上传保险发送:".$str);
               // $arr = explode(";",$info['mess_rec_man']);
               // foreach ($arr as $k=>$v){
                //    $ret = send_mobile_sms($v,$str);
               // }
               // if($ret['status']==0){
                    //$data['msg']="发送成功";
              //  }else{
                    //$data['msg']="发送失败";
               // }
            }
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "修改失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 管理员验车
     */
    public function verifyInfo(){
        $data=I("post.");
        $formToken=$data['formToken'];
        if(from_token($formToken)){
            unset($data['formToken']);
            $res=D("OrderAssistant")->verifyInfo($data);
            if($res){
                $msg['flag'] = true;
            }else{
                $msg['flag'] = false;
                $msg['msg'] = "修改失败";
            }
        }else{
            $msg['flag'] = false;
            $msg['msg'] = "修改失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 验车图片操作
     */
    public function verifyImg(){
        $data=I("post.");
        $res=D("OrderAssistant")->verifyImg($data);
        if($res){
            $this->ajaxReturn($res);
        }
    }
    /**
     * 删除验车图片
     */
    public function delVerImg(){
        $data=I("post.");
        $res=D("OrderAssistant")->delVerImg($data);
        if($res){
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "删除失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 审核
     */
    public function auditing(){
        $data=I("post.");
        $res=D("OrderAssistant")->auditing($data);
        if($res){
            $wObj = D("Worktwo");
            $wObj->auditingSend($data['order_code']);
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "审核失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 发送短信 通知位置
     */
    public function sendMessage(){
        $phone=I("phone");
        $content=I("content");
        $code = I("code");
        $info = M("order_assistant")->where(array("order_code"=>$code))->find();
        $us = M("user")->where(array("tel"=>$info['user_code']))->find();
        $str = sprintf(C("DUANXIN_MOBAN")['POSITION'],
                $us['user_name'],
                $code,
                $content);
        print_log("-----------------发送位置短信:".$str);
        $arr = explode(";",$phone);
        /* foreach ($arr as $k=>$v){
            $res = send_mobile_sms($v,$str)['status'];
        } */
        for ($i = 0; $i < count($arr); $i++) {
            if($arr[$i] != $arr[$i-1]){
                $res=send_mobile_sms($arr[$i],$str)['status'];
            }
        }
        if($res==0){
            $id=I("id");
            $data['is_send']='Y';
            $status=D("OrderAssistant")->editPosition($id,$data);
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "发送失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 运单添加
     */
    public function addYunDan(){
        $data=I("post.");
        $res=D("OrderAssistant")->addYunDan($data);
        if($res){
            D("Worktwo")->yunSend($data['order_code']);
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "添加失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 修改运单
     */
    public function editYunDan(){
        $data=I("post.");
        $res=D("OrderAssistant")->editYunDan($data);
        if($res){
            $wObj = D("Worktwo");
            $ji['order_code'] = $data['order_code'];
            $ji['yd_code'] = $data['yd_code'];
            $ji['A'] = $data['yd_name'];
            $ji['B'] = $data['old_yd_name'];
            $wObj->logsSet("YUNEDIT",$ji);
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "修改失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 作废运单
     */
    public function delYunDan(){
        $yd_code=I('post.yd_code');
        $res=D("OrderAssistant")->delYunDan($yd_code);
        if($res){
            /* $wObj = D("Worktwo");
            $ji['A'] = $yd_code;
            $wObj->logsSet("CHENGDEL",$ji); */
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "删除失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 添加位置跟踪
     */
    public function addPosition(){
        $data['order_code']=I("code");
        $data['content']=I("content");
        $data['text'] = I("text");
        $data['phone'] = I("phone");
        $admin_code=json_decode(des_decrypt_php($_SESSION['master']),true)['admin_code'];
        $data['admin_code']=$admin_code;
        $res=D("OrderAssistant")->addPosition($data);
        if($res){
            $msg['flag']= true;
        }else{
            $msg['flag']= false;
            $msg['msg'] = "操作失败";
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 查询司机
     */
    public function getCarList(){
        $proId=I("proid");
        $cityId=I("cityid");
        $text=I("text");
        $list=D("OrderAssistant")->getCarList($proId,$cityId,$text);
        if(!empty($list)){
            $this->ajaxReturn($list);
        }
    }
    /**
     * 获取物流公司
     */
    public function getCompanyList(){
        $text=I("text");
        $list=D("OrderAssistant")->getCompanyList($text);
        if($list){
            $this->ajaxReturn($list);
        }
    }
    /**
     * 确认提车
     */
    function completeYunDan(){
        $this->ajaxReturn(D("OrderAssistant")->completeYunDan(I("yd_id")));
    }
    /**
     * 价格查看
     */
    function checkPrice(){
        $data['flag'] = true;
        $this->ajaxReturn($data);
    }
    /**
     * 修改价格
     */
    function fuUpPrice(){
        $data['flag'] = true;
        $this->ajaxReturn($data);
    }
    /**
     * 运费价格查看
     */
    function checkYunPrice(){
        $data['flag'] = true;
        $this->ajaxReturn($data);
    }
}