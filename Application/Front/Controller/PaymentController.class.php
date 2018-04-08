<?php
namespace Front\Controller;
/**
 * PC端支付控制器
 * @author Administrator
 *
 */
class PaymentController extends BaseController {
    public function _initialize(){
        header("Content-type:text/html;charset=utf-8");
        import('Vendor.Alipay.alipayCore','','.php');
        import('Vendor.Alipay.alipayMd5','','.php');
        import('Vendor.Alipay.alipayNotify','','.php');
        import('Vendor.Alipay.alipaySubmit','','.php');
    }
    
    /**
     * 支付宝接口---------------------------------------------------------------------------------------
     */
    //alipay支付接口  //参数额外配置数组$configs
    public function alipayapi($configs){
        /****************************************************/
        //>>>>>>>>>>>>第一步
        //根据alipay源文件加载顺序依次加载配置
        $alipay_config = C('alipay_config');
    
        /**************************请求参数配置**************************/
        //支付类型
        $payment_type = C('alipay.payment_type');
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = C('alipay.notify_url');
        //需http://格式的完整路径，不能加?id=123这类自定义参数
    
        //卖家支付宝帐户
        $seller_email = C('alipay.seller_email');
    
        //必填
        //页面跳转同步通知页面路径
        $return_url = $configs['return_url'];
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        /****************************************************/
        //>>>>>>>>>>>>第二步
        //接收动态订单数据
        //商户订单号
        $out_trade_no = $configs['out_trade_no'];
        //商户网站订单系统中唯一订单号，必填
    
        //订单名称
        $subject = $configs['subject'];
        //必填
    
        //付款金额
        $total_fee = $configs['total_fee'];
        //必填
    
        //订单描述
        $body = $configs['body'];
        //商品展示地址
        $show_url = $configs['show_url'];
        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html
    
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        //防钓鱼时间戳
        $anti_phishing_key = $alipaySubmit->query_timestamp();
        //若要使用请调用类文件submit中的query_timestamp函数
    
        //客户端的IP地址
        $exter_invoke_ip = get_client_ip();   //Thinkphp3.2 系统集成的获取客户端ip方法
        //非局域网的外网IP地址，如：221.0.0.1
        /************************************************************/
        //>>>>>>>>>>>>第三步
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "payment_type"	=> $payment_type,
            "notify_url"	=> $notify_url,
            "return_url"	=> $return_url,
            "seller_email"	=> $seller_email,
            "out_trade_no"	=> $out_trade_no,
            "subject"	=> $subject,
            "total_fee"	=> $total_fee,
            "body"	=> $body,
            "show_url"	=> $show_url,
            "anti_phishing_key"	=> $anti_phishing_key,
            "exter_invoke_ip"	=> $exter_invoke_ip,
            "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );
    
        //建立请求
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        echo $html_text;
    }
    
    public function usersurl(){
        //计算得出通知验证结果
        $alipay_config = C('alipay_config');   //必须
    
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            //商户订单号
            $out_trade_no = $_GET['out_trade_no'];
            
            //支付宝交易号
            $trade_no = $_GET['trade_no'];
    
            //交易状态
            $trade_status = $_GET['trade_status'];
    
            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                $obj = M('order');
                $asObj = M("order_assistant");
                $map['order_code'] = array('eq',$out_trade_no);
                $info = $asObj->where($map)->find();
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                if($info['pay_status'] == "W"){
                    //$infos = $iObj->where($maps) ->find();
                    $datas['pay_time'] = date('Y-m-d H:i:s',time());
                    $datas['pay_status'] = "Y";
                    $reb = $asObj -> where($map) -> save($datas);
                    $ret = $obj->where($map)->save($datas);
                    if($reb && $ret){
                        $this->success('充值成功!',U("MyOrder/index"));
                        //echo '支付成功';
                    }else{
                        $this->error('充值异常(01)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                    }
                }else{
                    $this->error('充值异常(02)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                }
            }
            else {
                //echo "trade_status=".$_GET['trade_status'];
                echo '非法状态！';
            }
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "无法接收通知！（身份验证失败，可能是客服端网络异常）";
        }
        session('order',null);
    }
    
     public function notifyurl(){
        //计算得出通知验证结果
        $alipay_config = C('alipay_config');	//必须
    
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
    
        if($verify_result) {//验证成功
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代
             
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
             
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
             
            //商户订单号
    
            $out_trade_no = $_POST['out_trade_no'];
    
            //支付宝交易号
    
            $trade_no = $_POST['trade_no'];
    
            //交易状态
            $trade_status = $_POST['trade_status'];
    
            if($_POST['trade_status'] == 'TRADE_FINISHED') {
            //判断该笔订单是否在商户网站中已经做过处理
                $obj = M('order');
                $asObj = M("order_assistant");
                $map['order_code'] = array('eq',$out_trade_no);
                $info = $asObj->where($map)->find();
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                if($info['pay_status'] == "W"){
                    //$infos = $iObj->where($maps) ->find();
                    $datas['pay_time'] = date('Y-m-d H:i:s',time());
                    $datas['pay_status'] = "Y";
                    $reb = $asObj -> where($map) -> save($datas);
                    $ret = $obj->where($map)->save($datas);
                    if($reb && $ret){
                        $this->success('充值成功!',U("MyOrder/index"));
                        //echo '支付成功';
                    }else{
                        $this->error('充值异常(01)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                    }
                }else{
                    $this->error('充值异常(02)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                }
            }
            else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
            //判断该笔订单是否在商户网站中已经做过处理
                $obj = M('order');
                $asObj = M("order_assistant");
                $map['order_code'] = array('eq',$out_trade_no);
                $info = $asObj->where($map)->find();
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序
                if($info['pay_status'] == "W"){
                    //$infos = $iObj->where($maps) ->find();
                    $datas['pay_time'] = date('Y-m-d H:i:s',time());
                    $datas['pay_status'] = "Y";
                    $reb = $asObj -> where($map) -> save($datas);
                    $ret = $obj->where($map)->save($datas);
                    if($reb && $ret){
                        $this->success('充值成功!',U("MyOrder/index"));
                        //echo '支付成功';
                    }else{
                        $this->error('充值异常(01)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                    }
                }else{
                    $this->error('充值异常(02)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                }
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            echo "success";		//请不要修改或删除
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "fail";
            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    } 
    /**
     * 支付宝接口---------------------------------------------------------------------------------------
     */
    /**
     * 微信接口---------------------------------------------------------------------------------------
     */
    public function wxpayapi($res='',$fee=''){
        $order = session('order')['order'];
        $this ->unifiedPaymentNativeTwo($res,$fee);
        $order = session('order')['order'];
        $wxpay = session('wxpay');
        $this -> assign('wxpay',$wxpay);
        $this -> assign('code',$res);
        //$this -> assign('total',$order['total']);
        $this -> display('Order:wxpay');
    }
    /**
     * 统一支付(扫码模式2)
     */
    public function unifiedPaymentNativeTwo($res='',$fee=''){
        $appid = C('appid');
        $mch_id =C('SH_HAO');
        $order = session('order')['order'];
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        //传进来的数据
        //$info = S('product_id');
        $body = '妥妥运车-微信支付';
        $fee = $fee;//$order['total']*100; $fee
    
        $out_trade_no =$res; //$this -> getTradeNum();
        $nonce_str = get_code('wx');//$this -> getStr();
        $ip = $_SERVER["REMOTE_ADDR"];//获取终端ip
        $notify_url = 'http://www.tuotuoyunche.com/Front/Payment/notifyPay';//该方法要在支付授权目录下
        $type = "NATIVE";
        //这一项可以在生成二维码的时候传进来
        $product_id =1;//此字段作为生成订单的ID
        $arr = array(
            'appid'=>$appid,
            'body'=>$body,
            'mch_id'=>$mch_id,
            'nonce_str'=>$nonce_str,
            'notify_url'=>$notify_url,
            'out_trade_no'=>$out_trade_no,
            'product_id'=>$product_id,
            'spbill_create_ip'=>$ip,
            'total_fee'=>$fee,
            'trade_type'=>$type,
        );
        //$sign = $this ->getSign($appid,$body,$ip,$notify_url,$mch_id,$nonce_str,$fee,$out_trade_no,$product_id,$type);
        $sign = $this -> getWxSign($arr);
        $xml = '<xml>
            <appid>%s</appid>
            <mch_id>%s</mch_id>
            <body>%s</body>
            <nonce_str>%s</nonce_str>
            <sign>%s</sign>
            <out_trade_no>%s</out_trade_no>
            <total_fee>%s</total_fee>
            <spbill_create_ip>%s</spbill_create_ip>
            <notify_url>%s</notify_url>
            <trade_type>%s</trade_type>
            <product_id>%s</product_id>
            </xml>';
        $xml = sprintf($xml,$appid,$mch_id,$body,$nonce_str,$sign,$out_trade_no,$fee,$ip,$notify_url,$type,$product_id);
        //print_log("46456546546546546546546459999999999999999".$xml);
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        
        $returnInfo = $this -> curlPost($url, $xml);
        //print_log("4645654654654654654654645888888888888".$returnInfo);
        $res = simplexml_load_string($returnInfo, 'SimpleXMLElement', LIBXML_NOCDATA);
        $res = json_encode($res);
        $res = json_decode($res,true);
        //return $res['code_url'];
        //$info = S('product_id');
        $order['url'] = $res['code_url'];
        
        session('order',null);
        $order = array('order'=>$order,'userInfo'=>$userInfo);
        session('order',$order);
    
    }
    /**
     * curl Post请求
     * @param unknown $url
     * @param unknown $post
     * @return mixed
     */
    public function curlPost($url,$post){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
    
        $returnInfo = curl_exec($ch);
        curl_close ($ch);
        return $returnInfo;
    }
    /**
     * 支付回调
     */
    public function notifyPay(){
        //print_log("-----------------------------进入支付回调");
        //获取通知的数据
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $postObj = json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA));
        print_log("----------------------------支付回调参数:".$postObj);
        echo json_decode($postObj,'true')['result_code'];
        if(json_decode($postObj,'true')['result_code']=='SUCCESS'){
            $userInfo = json_decode(des_decrypt_php(session('userData')),true);
            $usercode = $userInfo['usercode'];
            $out_trade_no = json_decode($postObj,'true')['out_trade_no']; //订单code
            $transaction_id = json_decode($postObj,'true')['transaction_id'];//微信支付订单号
            $obj = M('order');
            $iObj = M('order_info');
            $map['order_code'] = array('eq',$out_trade_no);
            $info = $obj->where($map)->find();
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //如果有做过处理，不执行商户的业务程序
            if($info['pay_status'] == "W"){
                if($info['guanliancode'] == ""){
                    $maps['order_code'] = array('eq',$out_trade_no);
                    //$infos = $iObj->where($maps) ->find();
                
                    $reb = $iObj -> where($maps) -> setField('pay_time',date('Y-m-d H:i:s',time()));
                    $ret = $obj->where($map)->setField('pay_status','Y');
                    if($reb && $ret){
                        //$this->success('充值成功!',U("MyOrder/index"));
                        $sign = 'S';
                    }else{
                        //$this->error('充值异常(02)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                        $sign = 'E1';
                    }
                }else{
                        $result = $this -> batchUpdate($info['guanliancode']);
                        if($result=='S'){
                            //$this->success('充值成功!',U("MyOrder/index"));
                            $sign = 'S';
                        }else if($result=='E01'){
                            //此异常为主表同批生成订单的订单付费状态不统一
                            //$this->error('充值异常(03)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                            $sign = 'E3';
                        }else if($result=='E02'){
                            //写入问题
                            //$this->error('充值异常(01)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
                            $sign = 'E1';
                        }
                    }
            }else{
                    $sign = 'E2';
                    //$this->error('充值异常(02)，请联系客服或管理员。（需提供当前订单号【'.$out_trade_no.'】和支付宝交易号【'.$trade_no.'】）');
            }
            $array = array('sign'=>$sign,'out_trade_no'=>$out_trade_no,'transaction_id'=>$transaction_id);
            S($usercode.'wxpay',$array);
        }
    }
    /**
     * 生成二维码图片(扫码2)
     */
    function makeQRImgTwo(){
        vendor('phpqrcode.phpqrcode');
        /* $url = $_GET['url'];
         $url = des_decrypt_php($url); */
        $order = session('order')['order'];
        $url = $order['url'];
        $array = array('body'=>'妥妥运车-微信支付','fee'=>$order['total']*100,'product_id'=>1,);
        // 纠错级别：L、M、Q、H
        $level = 'L';
        // 点的大小：1到10,用于手机端4就可以了
        $size = 4;
        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
        $path = "__FRONT__/images/";
        // 生成的文件名
        $fileName = $path.$size.'.png';
        \QRcode::png($url,false, $level, $size);
    }
    /**
     * 生成微信签名
     * @param 签名中需要的字段生成的关联数组 $array
     * @return string
     */
    public function getWxSign($array){
        ksort($array);
        $keys = C('SECRETS');
        $strData = '';
        foreach($array as $key=>$value){
            $strData.=$key.'='.$value.'&';
        }
        $str = $strData.'key='.$keys;
        $str = md5($str);
        $sign = strtoupper($str);
        return $sign;
    }
    /**
     * 检测支付状态
     * @date: 2016-9-28 上午11:38:02
     * @author: liuxin
     */
    public function checkStatus(){
        $userInfo = json_decode(des_decrypt_php(session('userData')),true);
        $usercode = $userInfo['usercode'];
        $map['order_code'] = array('eq',I('post.code'));
        $res = M('order') -> where($map) -> field('pay_status') -> find();
        $data['pay_status'] = $res['pay_status'];
        $data['wxpay'] = S($usercode.'wxpay');
        $this -> ajaxReturn($data);
    }
    /**
     * 检测支付结果（wx）
     * @date: 2016-9-28 上午11:38:34
     * @author: liuxin
     */
    public function wxRes(){
        if(I('get.res')=='s'){
            $this -> success('支付成功',U("MyOrder/index"));
        }else if(I('get.res')=='e1'){
            $this -> success('支付出现问题,请联系客服',U("MyOrder/index"));
        }else if(I('get.res')=='e2'){
            $this -> error('重复支付,请联系客服',U("MyOrder/index"));
        }
        session('order',null);
    }
    /**
     * 批量更新订单数据
     * @date: 2016-9-28 上午11:39:06
     * @author: liuxin
     */
    public function batchUpdate($update=''){
        $obj = M('order');
        $iobj = M('order_info');
        $map['guanliancode'] = array('eq',$update);
        $data = $obj -> where($map) -> select();
        
        $sign1 = 1;
        //判断投标数据是否全为未支付状态
        for($i=0;$i<count($data);$i++){
            if($data[$i]['pay_status']=='W'){
                $signs = true;
                $sign1 = $sign1&&$signs;
            }else{
                $signs = false;
                $sign1 = $sign1&&$signs;
            }
        }
        
        if(!$sign1){
            $return = 'E01';//第一种数据错误 头表数据出现问题
            return $return;
        }
        $sign2 = 1;
        for($i=0;$i<count($data);$i++){
            $maps['order_code'] = array('eq',$data[$i]['order_code']);
            $res = $obj -> where($maps) -> setField('pay_status','Y');
            $res1 = $iobj -> where($maps) -> setField('pay_time',date('Y-m-d H:i:s',time()));
            $signs = $sign2&&$res&&res1;
        }
        if($sign2){
            return 'S';
        }else{
            return 'E02';
        }
        
    }
}