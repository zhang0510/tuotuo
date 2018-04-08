<?php
namespace Front\Controller;
//use Think\Controller;
class OrderController extends BaseObjController{
    /**
     * 快速下单(详情添加)第二页
     * @date: 2016-9-7 上午8:17:31
     * @author: liuxin
     */
    public function quickOrder(){
        $name = I('qname');
        $phone = I('qphone');
        $carprice = I('qcarprice');
        $tprice = I('tprice');
        $maoli = I('maoli');
        if(session('jump')==null){
            $eprice = I('eprice') + $maoli;//这里将毛利和附加费合并
        }else{
            $eprice = I('eprice');
        }
        $sprice = I('sprice');
        $startid = I('qsre');
        $cobj = D('Index');
        $start = I('qsrc');
        $endid = I('qere');
        $end = I('qerc');
        $type = I('qsctc');
        $brand = I('qscte');
        $total = I('total');
        $carInfo = I('carInfo');
        $feet = I('ti');
        $fees = I('song');
        $sans = I('sans');
        $sane = I('sane');
        $feesan = I('feesan');
        $tid = I('tid');
        $sid = I('sid');
        $order = array('name'=>$name,'phone'=>$phone,'carprice'=>$carprice,'tprice'=>$tprice,
            'eprice'=>$eprice,'sprice'=>$sprice,'startid'=>$startid,'endid'=>$endid,
            'start'=>$start,'end'=>$end,'type'=>$type,'brand'=>$brand,'total'=>$total,'carInfo'=>$carInfo,
            'feet'=>$feet,'fees'=>$fees,'sans'=>$sans,'sane'=>$sane,'feesan'=>$feesan,'tid'=>$tid,'sid'=>$sid,
            'maoli'=>$maoli,
        );
        session('jump',null);
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        $neworder = session('neworder')['phone']==""?"":session('neworder');
        //echo $userInfo['user_code'];
        if($userInfo['user_code']){
        	//dump(session("order"));
        	session("order",null);
            $order = $order['phone']==""||$order['phone']==null?$neworder:$order;
            session("order",$order);
            $usercode = $userInfo['user_code'];
            $coupon = $cobj -> getUserConpon($usercode,$tid,$sid,$sans,$sane);
            //dump($coupon);
            $this -> assign('coupon',$coupon);
        }else{
            $jump = array('order'=>$order,'method'=>'Order/quickOrder');
            session('jump',$jump);
            session('order',null);
            session('neworder',null);
            session('order',$order);
            session('neworder',$order);
            $obj = A('Login');
            $obj -> pclogin();
            exit;
        }
        $orderInfo = array('order'=>$order,'userInfo'=>$userInfo);
        session("xinjia",$orderInfo);
        session('order',null);
        $endid = $endid==""||$endid==null?$order['endid']:$endid;
        $arr = explode(',',$endid);
        $block = $cobj -> getBlock($arr[1]);
        $this -> assign('block',$block);
        $this -> assign('tstart',explode('-',$order['start'])[0]);
        $this -> assign('tend',explode('-',$order['end'])[0]);
        $this -> assign('order',$orderInfo);
        $this -> assign('user',$userInfo);
        $this -> display('Order:quick_step_two');
    }
    /**
     * 使用优惠券（废）
     * @date: 2016-9-7 上午8:19:48
     * @author: liuxin
     */
    public function useCoupon(){
        $obj = D('Order');
        $code = I('post.code');
        $num = I('post.num');
        $res = $obj -> useCoupon($code,$num);
        if($res){
            $data = '';
        }
        
    }
    /**
     * 查询上门送车信息
     * @date: 2016-9-7 上午8:20:17
     * @author: liuxin
     */
    public function getVisit(){
        $start = I('post.start');
        $end = I('post.end');
        $obj = D('Order');
        $res = $obj -> getVisit($start,$end);
        $this -> ajaxReturn($res);
    }
    /**
     * 快速下单 详情添加第三页面
     * @date: 2016-9-7 上午8:20:49
     * @author: liuxin
     */
    public function quickOrderT(){
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        $cityarea = session("xinjia");
        $startcityarea = $cityarea['order']['start'];
        $endcityarea = $cityarea['order']['end'];
        $carInfo = $cityarea['order']['carInfo'];
        $carprice = $cityarea['order']['carprice'];
        $linkMan=M("linkman");
        $map['user_code']=$userInfo['user_code'];
        $linkList=$linkMan->where($map)->select();
        $this->assign("linkList",$linkList);
        
        if(empty($userInfo['user_code'])){
            $obj = A('Login');
            $obj -> pclogin();
        }
        $endBlock = I('post.end_block');
        $order_info_smsc = I('post.order_info_smsc');//是否上门送车 Y/N
        $order_way = I('post.order_way');//提/取车方式 S:司机 X 小板
        $newti = I('post.newti');
        $newsong = I('post.newsong');
        $visit = I('post.visit');//上门送车价
        $coupon = I('post.coupon');//优惠券id
        $couponNum = I('couponNum');//优惠券钱数
        $totalt = I('post.totalt');//
        $totalf = I('post.totalf');
        $newtprice = I('post.newtprice');
        $newsprice = I('post.newsprice');
        $newend = I('newend');//上门送车地址
        $newcarprice = I('newcarprice');
        $oldorder = session('order')['order']==""||session('order')['order']==null?$cityarea['order']:session('order')['order'];
        if($newcarprice!=$oldorder['carprice']&&$newcarprice!=0){
            $oldorder['carprice'] = $newcarprice;
        }
        if($newti!=0){
            $oldorder['feet'] = $newti;
        }
        if($newsong!=0){
            $oldorder['fees'] = $newsong;
        }
        $oldorder['total'] = $totalt;
        if($newsprice!=$oldorder['sprice']&&$newsprice!=0){
            $oldorder['sprice'] = $newsprice;
        }
        if($newtprice!=$oldorder['tprice']&&$newtprice!=0){
            $oldorder['tprice'] = $newtprice;
        }
        $oldorder['end_block'] = $endBlock;
        $oldorder['order_info_smsc'] = $order_info_smsc;
        $oldorder['order_way'] = $order_way;
        $oldorder['visit'] = $visit;
        $oldorder['coupon'] = $coupon;
        $oldorder['couponNum'] = $couponNum;
        $oldorder['totalf'] = $totalf;
        $oldorder['newend'] = $newend;
        $oldorder['brand'] = explode('-',$carInfo)[0];
        $oldorder['type'] = explode('-',$carInfo)[1];
        $oldorder['carprice'] = $carprice;
        $oldorder['end'] = $endcityarea;
        $oldorder['start'] = $startcityarea;
     
        $order = array('order'=>$oldorder,'userInfo'=>$userInfo);
        session('order',null);
        session('order',$order);
        $this -> assign('tstart',explode('-',$startcityarea)[0]);
        $this -> assign('tend',explode('-',$endcityarea)[0]);
        $this -> assign('order',$oldorder);
        $this -> assign('user',$userInfo);
        $this -> display('Order:quick_step_three');
    }
    /**
     * 快速下单(详情)第四页面
     * @date: 2016-9-7 上午8:22:33
     * @author: liuxin
     */
    public function quickOrderTh(){
        $token = $this -> token(4);
        session('token',$token);
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        if(empty($userInfo['user_code'])){
            $obj = A('Login');
            $obj -> pclogin();
        }
        $fname = I('fname');
        $sname = I('sname');
        $fphone = I('fphone');
        $sphone = I('sphone');
        $fiden = I('fiden');
        $siden = I('siden');
        $plate = I('plate');
        $faddress = I('faddress');
        $saddress = I('saddress');
        $note = I('note');
        if($fname==''||$sname==''||$fphone==''||$sphone==""||$fiden==""||$siden==""||$plate==""||$faddress==""){
            //$this->error("数据错误");
            parent::showErrorPage('数据错误');
        }
        $oldorder = session('order')['phone']==""||session('order')['phone']==null?session('order')['order']:session('order');
        if($fname!=$oldorder['name']){
            $oldorder['name'] = $fname;
        }
        if($fphone!=$oldorder['phone']){
            $oldorder['phone'] = $fphone;
        }
        $oldorder['address'] = $faddress;
        $oldorder['saddress'] = $saddress;
        $oldorder['sname'] = $sname;
        $oldorder['sphone'] = $sphone;
        $oldorder['plate'] = $plate;
        $oldorder['note'] = $note;
        $oldorder['fiden'] = $fiden;
        $oldorder['siden'] = $siden;
        $oldorder['siden'] = $siden;
        $oldorder['all_price'] = $oldorder['eprice']/100+$oldorder['tprice'];
        //dump($oldorder);
        //价格补充
        $cityarea = session("xinjia");
        session("xinjia",null);
        //echo $oldorder['tprice'];
        $order = array('order'=>$oldorder,'userInfo'=>$userInfo);
        session('order',null);
        session('order',$order);
        $this -> assign('order',$oldorder);
        $this -> assign('user',$userInfo);
        $this -> assign('token',$token);
        $this -> display('Order:quick_step_four');
    }
    /**
     * 生成快速订单
     * @date: 2016-9-7 上午8:24:05
     * @author: liuxin
     */
    public function getQuickOrder(){
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        if(empty($userInfo['user_code'])){
            $obj = A('Login');
            $obj -> pclogin();
        }
        $payway = I('payway');
        $token = I('token');
        $ftoken = session('token');
        if($token != $ftoken){
            $this->error('订单已提交，请勿重复提交');
            //echo '订单已提交，请勿重复提交';
            die;
        }
        session('token',null);
        $order = session('order')['order'];
        //dump($order);
        $prices = $order['totalf']==""||$order['totalf']==null?$order['total']:$order['totalf'];
        $objOr = D("Order");
        $star_id = $objOr->getcityId($order['start']);
        $end_id = $objOr->getcityId($order['end']);
        $star_id_id = $order['startid']==""||$order['startid']==null?$star_id:$order['startid'];
        $end_id_id = $order['endid']==""||$order['endid']==null?$end_id:$order['endid'];
        $order['payway'] = $payway;
        $arrH = array('user_code'=>$userInfo['user_code'],'user_name'=>$userInfo['user_name'],
            'user_tel'=>$userInfo['user_tel'],'user_identity'=>$userInfo['user_identity'],
            'order_time'=>date('Y-m-d H:i:S',time()),'order_status'=>'S','pay_way'=>$payway,
            'order_way'=>$order['order_way'],'pay_status'=>'W',
        );
        $arrI = array('order_info_brand'=>$order['brand'],'order_info_type'=>$order['type'],
            'order_info_carmark'=>$order['plate'],'order_info_zj'=>$prices*100,
            'order_info_price'=>$order['carprice']*1000000,'order_info_c_car'=>$order['feesan']*100,
            'order_info_t_car'=>$order['feet']*100,'order_info_s_car'=>$order['fees']*100,
            'order_smsc_car'=>$order['visit']*100,'order_info_margin'=>$order['maoli'],
            'order_info_add_price'=>$order['eprice']-$order['maoli'],'order_info_bxd'=>$order['sprice']*100,
            'order_info_smsc'=>$order['visit']==0?'N':'Y','pay_people'=>$userInfo['role'] =='Q'?$userInfo['user_name']:'',
            'fav_code'=>$order['conpon'],'order_info_star'=>$star_id_id,
            'order_info_tclxr'=>$order['name'].','.$order['fiden'].','.$order['phone'],
            'order_info_star_address'=>$order['address'],'order_info_end'=>$end_id_id,
            'order_info_sclxr'=>$order['sname'].','.$order['siden'].','.$order['sphone'],
            'order_info_smscd'=>$order['end_block']==''?'':$order['endid'].','.$order['end_block'],
            'order_info_end_address'=>$order['saddress'],'order_info_remark'=>$order['note'],
        );
		print_log("");
        $obj = D('Order');
        //dump($arrH);dump($arrI);die();
        $res = $obj -> geQuickOrder($order,$arrH,$arrI,$userInfo);
        if(!$res){
            //$this -> error('错误');
            $this -> error('错误');
        }else{
            //echo $res;
            
            if($payway=='H'){
                $this -> success('操作成功',U('OrderDetail/index',array('order_code'=>$res)));
            }else if($payway=='Z'){
                //echo 111;
                $payobj = A('Payment');
                $configs = array(
                    'return_url'	=>C("DOMAINNAME").'/Front/Payment/usersurl',	//服务器同步通知页面路径(必填)
                    //'notify_url'	=>'',	//服务器异步通知页面路径(必填)     //若模块下配置文件已经配置则注释掉
                    'out_trade_no'	=>$res,	//商户订单号(必填)
                    'subject'		=>'车妥妥支付',	//订单名称(必填)
                    'total_fee'		=>$prices,	//付款金额(必填)
                    'body'			=>'车妥妥在线支付',	//订单描述
                    //'show_url'		=>'',	//商品展示地址
                );
                
                //调用支付宝接口
                $payobj->alipayapi($configs);
            }else if($payway=='W'){
                $fee = $order['total']*100;
                $payobj = A('Payment');
                $payobj->wxpayapi($res,$fee);
            }
            //$this -> success('成功');
            //$this -> display('Public:success');
        }
        
    }
    /**
     * 快速下单第二页面
     * @date: 2016-9-7 上午8:38:55
     * @author: liuxin
     */
    public function quickOrderGo(){
        $name = I('qname');
        $phone = I('qphone');
        $carprice = I('qcarprice');
        $tprice = I('tprice');
        $maoli = I('maoli');
        if(session('jump')==null){
            $eprice = I('eprice') + $maoli;//这里将毛利和附加费合并
        }else{
            $eprice = I('eprice');
        }
        $sprice = I('sprice');
        $startid = I('qsre');
        $endid = I('qere');
        $arr = explode(',',$endid);
        $cobj = D('Index');
        $block = $cobj -> getBlock($arr[1]);
        $this -> assign('block',$block);
        $start = I('qsrc');
        $end = I('qerc');
        $type = I('qsctc');
        $brand = I('qscte');
        $total = I('total');
        $carInfo = I('carInfo');
        $feet = I('ti');
        $fees = I('song');
        $sans = I('sans');
        $sane = I('sane');
        $feesan = I('feesan');
        $tid = I('tid');
        $sid = I('sid');
        $order = array('name'=>$name,'phone'=>$phone,'carprice'=>$carprice,'tprice'=>$tprice,
            'eprice'=>$eprice,'sprice'=>$sprice,'startid'=>$startid,'endid'=>$endid,
            'start'=>$start,'end'=>$end,'type'=>$type,'brand'=>$brand,'total'=>$total,'carInfo'=>$carInfo,
            'feet'=>$feet,'fees'=>$fees,'sans'=>$sans,'sane'=>$sane,'feesan'=>$feesan,'tid'=>$tid,'sid'=>$sid,
            'maoli'=>$maoli,
        );
        
        session('jump',null);
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        
        $linkMan=M("linkman");
        $map['user_code']=$userInfo['user_code'];
        $linkList=$linkMan->where($map)->select();
        $this->assign("linkList",$linkList);
        $neworder = session('neworder')==""?"":session('neworder');
        if($userInfo['user_code']){
        	session("order",null);
            $order = $order['phone']==""||$order['phone']==null?$neworder:$order;
            session("order",$order);
            if(session("order")['phone']=="" || session("order")['phone']==null){
                $aaa = array('order'=>$order);
                session("order",$aaa);
            }
            $usercode = $userInfo['user_code'];
            $coupon = $cobj -> getUserConpon($usercode,$tid,$sid,$sans,$sane);
            $this -> assign('coupon',$coupon['list']);
            $this -> assign('cnum',$coupon['cnum']);
        }else{
            $jump = array('order'=>$order,'method'=>'Order/quickOrderGo');
            session('jump',$jump);
            session('order',null);
            session('neworder',null);
            session('order',$order);
            session('neworder',$order);
            $obj = A('Login');
            $obj -> pclogin();
            exit;
        }
        $orderInfo = array('order'=>$order,'userInfo'=>$userInfo);
        //session('order',null);
        $this -> assign('tstart',explode('-',$order['start'])[0]);
        $this -> assign('tend',explode('-',$order['end'])[0]);
        $this -> assign('order',$order);
        $this -> assign('user',$userInfo);
        $this -> display('Order:quick_step_three');
    }
    
    
    /**
     * 正常下单第二页面
     * @date: 2016-9-7 上午8:39:34
     * @author: liuxin
     */
    public function normal(){
        $tprice = I('tpricez');
        $maoli = I('maoliz');
        if(session('jumpz')==null){
            $eprice = I('epricez') + $maoli;//这里将毛利和附加费合并
        }else{
            $eprice = I('epricez');
        }
        $startid = I('qsrez');
        
        $cobj = D('Index');
        $endid = I('qerez');
        $start = I('qsrcz');
        $end = I('qercz');
        $type = I('qsctcz');
        $brand = I('qsctez');
        $total = I('totalz');
        $carInfo = I('carInfoz');
        $feet = I('tiz');
        $fees = I('songz');
        $sans = I('sansz');
        $sane = I('sanez');
        $feesan = I('feesanz');
        $tid = I('tidz');
        $sid = I('sidz');
        $order = array('tprice'=>$tprice,
            'eprice'=>$eprice,'startid'=>$startid,'endid'=>$endid,
            'start'=>$start,'end'=>$end,'type'=>$type,'brand'=>$brand,'total'=>$total,'carInfo'=>$carInfo,
            'feet'=>$feet,'fees'=>$fees,'sans'=>$sans,'sane'=>$sane,'feesan'=>$feesan,'tid'=>$tid,'sid'=>$sid,
            'maoli'=>$maoli,
        );
        
        session('jumpz',null);
        $neworder = session('neworder')==""?"":session('neworder');
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        if($userInfo['user_code']){
        	session("order",null);
        	
            $order = $order['startid']==""||$order['startid']==null?$neworder:$order;
            session("order",$order);
            //dump(session("jumpz"));
            $usercode = $userInfo['user_code'];
            $coupon = $cobj -> getUserConpon($usercode,$tid,$sid,$sans,$sane);
            //dump($coupon);
            $this -> assign('coupon',$coupon['list']);
            $this -> assign('cnum',$coupon['cnum']);
        }else{
            $jump = array('order'=>$order,'method'=>'Order/normal');
            session('jumpz',$jump);
            session('order',null);
            session('neworder',null);
            session('order',$order);
            session('neworder',$order);
            $obj = A('Login');
            $obj -> pclogin();
            exit;
        }
        $orderInfo = array('order'=>$order,'userInfo'=>$userInfo);
        session("xinjia",$orderInfo);
        $endid = $endid==""||$endid==null?$order['endid']:$endid;
        $arr = explode(',',$endid);
        $block = $cobj -> getBlock($arr[1]);
        $this -> assign('block',$block);
        $this -> assign('tstart',explode('-',$order['start'])[0]);
        $this -> assign('tend',explode('-',$order['end'])[0]);
        $this -> assign('order',$orderInfo);
        $this -> assign('user',$userInfo);
        $this -> display('Order:normal_step_two');
    }
    /**
     * 正常下单第三页面
     * @date: 2016-9-7 上午8:40:15
     * @author: liuxin
     */
    public function normalOrderT(){
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        $cityarea = session("xinjia");
        $startcityarea = $cityarea['order']['start'];
        $endcityarea = $cityarea['order']['end'];
        $carInfo = $cityarea['order']['carInfo'];
        
        $linkMan=M("linkman");
        $map['user_code']=$userInfo['user_code'];
        $linkList=$linkMan->where($map)->select();
        $this->assign("linkList",$linkList);
        
        if(empty($userInfo['user_code'])){
            $obj = A('Login');
            $obj -> pclogin();
        }
        $endBlock = I('post.end_block');
        $order_info_smsc = I('post.order_info_smsc');//是否上门送车 Y/N
        $order_way = I('post.order_way');//提/取车方式 S:司机 X 小板
        $newti = I('post.newti');
        $newsong = I('post.newsong');
        $visit = I('post.visit');//上门送车价
        $coupon = I('post.coupon');//优惠券id
        $couponNum = I('couponNum');//优惠券钱数
        $totalt = I('post.totalt');//
        $totalf = I('post.totalf');
        $newtprice = I('post.newtprice');
        $newsprice = I('post.newsprice');
        $newend = I('newend');//上门送车地址
        $newcarprice = I('newcarprice');
        $oldorder = session('order');
        $oldorder['carprice'] = $newcarprice;
        if($newti!=0){
            $oldorder['feet'] = $newti;
        }
        if($newsong!=0){
            $oldorder['fees'] = $newsong;
        }
        $oldorder['total'] = $totalt;
        $oldorder['sprice'] = $newsprice;
        if($newtprice!=$oldorder['tprice']&&$newtprice!=0){
            $oldorder['tprice'] = $newtprice;
        }
        $oldorder['end_block'] = $endBlock;
        $oldorder['order_info_smsc'] = $order_info_smsc;
        $oldorder['order_way'] = $order_way;
        $oldorder['visit'] = $visit;
        $oldorder['coupon'] = $coupon;
        $oldorder['couponNum'] = $couponNum;
        $oldorder['totalf'] = $totalf;
        $oldorder['newend'] = $newend;
        $oldorder['brand'] = explode('-',$carInfo)[0];
        $oldorder['type'] = explode('-',$carInfo)[1];
        $oldorder['start'] = $startcityarea;
        $oldorder['end'] = $endcityarea;
        $oldorder['all_price'] = $cityarea['order']['eprice']/100+$cityarea['order']['tprice'];
        $order = array('order'=>$oldorder,'userInfo'=>$userInfo);
        session('order',null);
        session('order',$order);
        $this -> assign('tstart',explode('-',$startcityarea)[0]);
        $this -> assign('tend',explode('-',$endcityarea)[0]);
        $this -> assign('order',$oldorder);
        $this -> assign('user',$userInfo);
        $this -> display('Order:normal_step_three');
    }
    /**
     * 正常下单第四页面
     * @date: 2016-9-7 上午8:40:37
     * @author: liuxin
     */
    public function normalOrderTh(){
        $token = $this -> token(4);
        session('token',$token);
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        if(empty($userInfo['user_code'])){
            $obj = A('Login');
            $obj -> pclogin();
            exit;
        }
        $fname = I('fname');
        $sname = I('sname');
        $fphone = I('fphone');
        $sphone = I('sphone');
        $fiden = I('fiden');
        $siden = I('siden');
        $plate = I('plate');
        $faddress = I('faddress');
        $saddress = I('saddress');
        $note = I('note');
        if($fname==''||$sname==''||$fphone==''||$sphone==""||$fiden==""||$siden==""||$plate==""||$faddress==""){
            //$this->error("数据错误");
            parent::showErrorPage('数据错误');
        }
        
        $oldorder = session('order')['order'];
        $oldorder['name'] = $fname;
        $oldorder['phone'] = $fphone;
        $oldorder['address'] = $faddress;
        $oldorder['saddress'] = $saddress;
        $oldorder['sname'] = $sname;
        $oldorder['sphone'] = $sphone;
        $oldorder['plate'] = $plate;
        $oldorder['note'] = $note;
        $oldorder['fiden'] = $fiden;
        $oldorder['siden'] = $siden;
        
        $order = array('order'=>$oldorder,'userInfo'=>$userInfo);
        session('order',null);
        session('order',$order);
        $this -> assign('order',$oldorder);
        $this -> assign('user',$userInfo);
        $this -> assign('token',$token);
        $this -> display('Order:quick_step_four');
    }
    public function paynow(){
        $payway = I('post.payway');
        $fee = I('post.fee');
        $code = I('post.code');
        if($payway=='Z'){
            //echo 111;
            $payobj = A('Payment');
            $configs = array(
                'return_url'	=>C("DOMAINNAME").'/Front/Payment/usersurl',	//服务器同步通知页面路径(必填)
                //'notify_url'	=>'',	//服务器异步通知页面路径(必填)     //若模块下配置文件已经配置则注释掉
                'out_trade_no'	=>$code,	//商户订单号(必填)
                'subject'		=>'车妥妥支付',	//订单名称(必填)
                'total_fee'		=>$fee,	//付款金额(必填)
                'body'			=>'车妥妥在线支付',	//订单描述
                //'show_url'		=>'',	//商品展示地址
            );
        
            //调用支付宝接口
            $payobj->alipayapi($configs);
        }else if($payway=='W'){
            $fee = $fee*100;
            $payobj = A('Payment');
            $payobj->wxpayapi($code,$fee);
        }
    }
    
}