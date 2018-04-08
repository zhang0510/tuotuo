<?php
namespace Back\Model;
use Think\Model;
/**
 * @author lwt
 *
 */
class WorktwoModel extends BaseModel {
    /*
     * 获取省份（妥妥）
     * @author: lwt
     * @return obj区域结果集
     */
    public function get_province(){
        //查询条件
        $map['area_pid'] = array('eq',1);
        //区域查询
        $pro = M('area') -> where($map) -> select();
        return $pro;
    }
    
    /**
     * 获取城市列表
     * @author: lwt
     * @param string $pid 省id
     * @return obj区域结果集
     */
    public function getCity($pid=''){
        //查询条件
        $map['area_pid'] = array('eq',$pid);
        //实例数据库
        $obj = M('area');
        //区域查询
        $list = $obj -> where($map) -> select();
        return $list;
    }
    /**
     * 获取区县列表
     * @author: lwt
     * @param string $pid 市id
     * @return obj区域结果集
     */
    public function getBlock($pid=''){
        //查询条件
        $map['area_pid'] = array('eq',$pid);
        //实例数据库
        $obj = M('area');
        //区域查询
        $list = $obj -> where($map) -> select();
        return $list;
    }
    /**
     * 验证区域是否可以提车
     * @param string 区域$id
     * @return msg状态信息  flag状态码true/false
     */
    public function checkGet($id='') {
        //初始化
        $obj = M('area');
        //查询条件
        $map['area_id'] = array('eq',$id);
        //查询数据
        $ret = $obj->where($map)->getField("area_get");
        if($ret=="Y"){
            $msg['flag'] = true;
        }else{
            $msg['flag'] = false;
            $msg['msg'] = "此区域暂不可提车";
        }
        return $msg;
    }
    /**
     * 验证区域是否可以送车
     * @param string 区域$id
     * @return msg状态信息  flag状态码true/false
     */
    public function checkSet($id='') {
        //初始化
        $obj = M('area');
        //查询条件
        $map['area_id'] = array('eq',$id);
        //查询数据
        $ret = $obj->where($map)->getField("area_set");
        if($ret=="Y"){
            $msg['flag'] = true;
        }else{
            $msg['flag'] = false;
            $msg['msg'] = "此区域暂不可送车";
        }
        return $msg;
    }
    /**
     * 判断路线类型
     * @param string $str起始点
     * @param string $end目的地
     * @return msg状态信息  flag状态码true/false product_type类型A:直发,B:常规
     */
    public function queryLine($str='',$end='') {
        //初始化
        $msg['flag'] = true;
        //查询集散地A
        $ti = $this->getTi($str);
        //查询直发路线
        $tl = $this->queryPrice($ti['ti_end'],$end);
        //查询集散地B
        $song = $this->getSong($end);
        //查询集散地
        $ls = $this->getSan($ti['ti_end'],$song['song_star']);
        //判断提车是否存在
        if($ti){
            //判断是直发还是常规
            if($tl){
                //直发
                $msg['product_type'] = "A";
            }else{
                //常规
                if($song && $ls){
                    $msg['product_type'] = "B";
                }else{
                    $msg['msg'] = "线路正在完善中";
                    $msg['flag'] = false;
                }
            }
        }else{
            //不存在
            $msg['msg'] = "线路正在完善中";
            $msg['flag'] = false;
        }
        return $msg;
    }
    /**
     * 查询直发
     * @param string $start 开始地点
     * @param string $end   结束地点
     * @return obj数据结果集
     */
    public function queryPrice($start='',$end=''){
        //查询条件
        $map['line_star'] = array('eq',$start);
        $map['line_end'] = array('eq',$end);
        //实例化数据库
        $obj = M('line');
        //查询
        $data = $obj -> where($map) -> find();
        return $data;
    }
    /**
     * 获取全部车辆信息
     */
    function getCar($pid=0){
        $masObj = M('carxing');
        $map['cxjj_pid'] = array('eq',$pid);
        $data = $masObj->where($map) -> select();
        return $data;
    }
    /**
     * 获取车辆型号
     * @param string $id车id
     * @return obj数据结果集
     */
    public function getType($id=''){
        //查询条件
        $map['cxjj_id'] = array('eq',$id);
        //实例化数据库
        $obj = M('carxing');
        //查询
        $list = $obj -> where($map) -> find();
        return $list;
    }
    /**
     * 计算保险费用
     * @param string $price 车费
     * @param string $type 类型
     * @return number
     */
    public function getSecu($price='',$type=''){
        //实例化数据库
        $obj = M('system');
        //查询
        $list = $obj->where("id=1") -> find();
        $per = $list[$type];
        $fee = ceil($price*($per/100));
        return $fee;
    }
    /**
     * 查询提车信息
     * @param string $start 开始地code串
     * @return obj数据结果集
     */
    public function getTi($start=''){
        //实例化数据库
        $obj = M('ti');
        $info="";
        if($start!=""){
            $map['ti_star'] = array('eq',$start);
            //查询
            $info = $obj -> where($map) -> find();
            //拆出省份id
            if(!empty($info['ti_id'])){
                $arr = explode(',',$info['ti_end']);
                $info['spro'] = $arr[0];
            }
        }
        return $info;
    }
    /**
     * 获取送车信息
     * @param string $end 终点地code串
     * @return obj数据结果集
     */
    public function getSong($end=''){
        //实例化数据库
        $obj = M('song');
        $map['song_end'] = array('eq',$end);
        //查询
        $info = $obj -> where($map) -> find();
        if(!empty($info['song_id'])){
            //拆出省份id
            $arr = explode(',',$info['song_star']);
            $info['epro'] = $arr[0];
        }
        return $info;
    }
    /**
     * 获取集散地之间运输信息
     * @param string $st 集散地开始
     * @param string $end   集散地结束
     * @return obj数据结果集
     */
    public function getSan($st='',$end=''){
        //实例化数据库
        $obj = M('line_san');
        $map['san_star'] = array('eq',$st);
        $map['san_end'] = array('eq',$end);
        //查询
        $info = $obj -> where($map) -> find();
        return $info;
    }
    /**
     * 查询优惠券金额
     * @param string $code 优惠券code
     * @return flag状态true/false price金额
     */
    public function getUserConpon($code=''){
        //实例化数据库
        $obj = M('favorable');
        $now = date('Y-m-d H:i:s',time());
        //查询条件
        $map['fav_code'] = array('eq',$code);
        $map['fav_status'] = array('eq','N');
        $map['fav_flag'] = array('eq','Y');
        $map['fav_startime'] = array('elt',$now);
        $map['fav_endtime'] = array('gt',$now);
        //查询
        $list = $obj -> where($map) -> find();
        if($list){
            $msg['flag'] = true;
            $msg['price'] = $list['fav_price']/100;
        }else{
            $msg['flag'] = false;
        }
        return $msg;
    }
    /**
     * 计算毛利信息
     * @param string $spro 起始地省id
     * @param string $epro  终点地省id
     * @param string $carid  车id
     * @return number金额
     */
    public function getMaoli($spro='',$epro='',$carid=''){
        //实例化数据库
        $obj = M('maoli');
        //获取车信息
        $car = $this->getType($carid);
        $map['ml_star'] = array('eq',$spro);
        $map['ml_end'] = array('eq',$epro);
        //查询
        $info = $obj -> where($map) -> find();
        //获取毛利
        $data = $info[$car['cxjj_category']];
        return $data;
    }
    /**
     * 获取上门送车费
     * @param string $s 起始地区
     * @param string $e 结束结束
     * @return obj数据结果集
     */
    function getsmPrice($s='',$e=''){
        //实例化数据库
        $smObj = M("sm");
        $map['sm_star'] = array('eq',$s);
        $map['sm_end'] = array('eq',$e);
        //查询
        print_log("----------------:".json_encode($map));
        $info = $smObj->where($map)->find();
        return $info;
    }
    /**
     * 将地名code转换成名称
     * @date: 2016-9-27 下午7:47:20
     * @author: liuxin
     * @param string $id
     * @return 地区名称
     */
    public function getPlaceName($id=''){
        //查询
        $map['area_id'] = array('eq',$id);
        $data = M('area') -> where($map) -> find();
        //返回地区名称
        return $data['area_name'];
    }
    /**
     * 获取订单状态名称
     * @param string $key状态吗
     * return name
     */
    public function getOrderStatusName($key=''){
        $bb = '';
        switch ($key){
            case 'S':
                $bb = "待审核";
                break;
            case 'A':
                $bb = "待安排";
                break;
            case 'T':
                $bb = "待提车";
                break;
            case 'Z':
                $bb = "待核实";
                break;
            case 'Y':
                $bb = "待装板";
                break;
            case 'M':
                $bb = "待中转";
                break;
            case 'N':
                $bb = "待到达";
                break;
            case 'D':
                $bb = "已到达";
                break;
            case 'B':
                $bb = "待送车";
                break;
            case 'G':
                $bb = "待交车";
                break;
            case 'W':
                $bb = "已完成";
                break;
        }
        return $bb;
    }
    /**
     * 获取用户咨询记录
     * @param string $tel手机号
     */
    public function getReferOrder($tel=''){
        //初始化
        $rObj = M("refer");
        $oObj = M("order_assistant");
        //查询用户咨询
        $map['tr_tel'] = array('eq',$tel);
        $data = $rObj->where($map)->order("tr_duan desc")->select();
        $str = '';
        $str1 = '';
        foreach ($data as $k=>$v){
            $str .= '<tr>';
            $str .= "<td>{$v['tr_duan']},查询{$this->getPlaceName(explode(",",$v['tr_start'])[1])}发{$this->getPlaceName(explode(',',$v['tr_end'])[1])}价格,报价".($v['tr_yun']/100)."元。{$v['tr_bei']};</td>";
            $str .= '</tr>';
        }
        //查询订单
        $map1['user_code'] = array('eq',$tel);
        $ret = $oObj->field("order_status,order_time,order_code")->where($map1)->order("order_time desc")->select();
        foreach ($ret as $k=>$v){
            $str1 .= '<tr>';
            $str1 .= "<td>{$v['order_time']},下单{$v['order_code']},订单状态:{$this->getOrderStatusName($v['order_status'])}</td>";
            $str1 .= '</tr>';
        }
        $str = $str.$str1;
        return $str;
    }
    /**
     * 下单第一步，判断&&价格
     * @param string $str 出发地
     * @param string $end 目的地
     * @param string $carid 车型id
     */
    public function getPrice($str='',$end='',$carid=''){
        //判断区域是否可提车
        $get = $this->checkGet(explode(",",$str)[2]);
        if(!$get['flag']){
            return $get;
        }
        //判断目的地是否可以送车
        $set = $this->checkGet(explode(",",$end)[1]);
        if(!$set['flag']){
            return $set;
        }
        //判断线路类型
        $lineType = $this->queryLine($str,$end);
        if(!$lineType['flag']){
            return $lineType;
        }
        //计算提车费
        $ti = $this->getTi($str);
        //计算毛利
        $mao = $this->getMaoli(explode(',',$str)[0],explode(',',$end)[0],$carid);
        //拼装中文地区
        $lineType['str_add'] = $this->getPlaceName(explode(',',$str)[0])." ".$this->getPlaceName(explode(',',$str)[1])." ".$this->getPlaceName(explode(',',$str)[2]);
        $lineType['end_add'] = $this->getPlaceName(explode(',',$end)[0])." ".$this->getPlaceName(explode(',',$end)[1]);
        //判断直发还是常规送车
        if($lineType['product_type'] == 'A'){
            //直发
            $line = $this->queryPrice($ti['ti_end'],$end);
            $lineType['ti'] = $ti['ti_platelets_price']/100;
            $lineType['line'] = $line['line_price']/100;
            $lineType['mao'] = $mao/100;
            $lineType['totel'] = ($ti['ti_platelets_price']+$line['line_price']+$mao)/100;
        }else{
            //常规
            //送车费
            $song = $this->getSong($end);
            //集散地
            $ji = $this->getSan($ti['ti_end'],$song['song_star']);
            $lineType['ti'] = $ti['ti_platelets_price']/100;
            $lineType['line'] = $ji['san_price']/100;
            $lineType['mao'] = $mao/100;
            $lineType['song'] = $song['song_platelets_price']/100;
            $lineType['totel'] = $lineType['ti']+$lineType['line']+$lineType['mao']+$lineType['song'];
        }
        return $lineType;
    }
    /**
     * 用户咨询存入数据库
     * @param unknown $_post 数据集合
     * return true/false
     */
    public function referInsert($_post){
        $rObj = M("refer");
        $ret = $rObj->add($_post);
        return $ret;
    }
    /**
     * 客服下单生成订单
     * @param array $data 订单表数据
     * @param array $data_m 用户表数据
     */
    public function setOrder($data='',$data_m=''){
        $model = new Model();//开启事务
        $model -> startTrans();
        $obj = M("order");//订单表
        $miObj = M("user");//会员表
        $oabj = M("order_assistant");
        //查询该会员是否存在
        $map['tel'] = array('eq',$data_m['tel']);
        $rll = $miObj -> where($map) ->find();
        
        if(!$rll){
            $resd = $miObj->add($data_m);
            $ret = $obj->add($data);
            $ref = $oabj->add($data);
            //发送短信
            $str = sprintf(C("DUANXIN_MOBAN")['XIACHENG'],$data['order_code']);
            print_log("--------------下单短信:".$str);
            $retgg = send_mobile_sms($data['user_code'],$str);
            if($retgg['status']==0){
                $reh = true;
            }else{
                $reh = false;
            }
            if($ret&&$resd && $ref&&$reh){
                $model->commit();
                return true;
            }else{
                $model->rollback();
                return false;
            }
        }else{
            $ret = $obj->add($data);
            $ref = $oabj->add($data);
            //发送短信
            $str = sprintf(C("DUANXIN_MOBAN")['XIACHENG'],$data['order_code']);
            print_log("--------------下单短信:".$str);
            $retgg = send_mobile_sms($data['user_code'],$str);
            if($retgg['status']==0){
                $reh = true;
            }else{
                $reh = false;
            }
            if($ret&& $ref&&$reh){
                $model->commit();
                return true;
            }else{
                $model->rollback();
                return false;
            }
        }
    }
    /**
     * 查询咨询记录
     * @param $mark 状态是否回电
     * @return list集合  show分页
     */
    public function referList($mark=''){
        $rObj = M("refer");//作品表
        $adObj = M("admin");//管理员
        if($mark !=''){
            $map['tr_mark'] = array('eq',$mark);
            $par['mark'] = $mark;
        }
        $count = $rObj->where($map) ->count();
        $page = set_page($count,20);
        $list = $rObj
        ->where($map)->limit($page->limit)->order('tr_duan desc')->select();
        $show = $page->BackPage();
        $size = count($list);
        for($i=0;$i<count($list);$i++){
            $maps['admin_code'] = array('eq',$list[$i]['tr_ke_code']);
            $list[$i]['adname'] = $adObj -> where($maps)->getField("admin_name");
            $list[$i]['line'] = $this->getPlaceName(explode(",",$list[$i]['tr_start'])[0])."-". $this->getPlaceName(explode(",",$list[$i]['tr_end'])[0]);
        }
        if($size>0){
            $data['show'] = $show;
        }
        $data['list'] = $list;
        return $data;
    }
    /**
     * 确认回电
     * @param $id 咨询id
     * @return true/false
     */
    public function checkRefer($id=''){
        $data['tr_mark'] = 'Y';
        $map['tr_id'] = array('eq',$id);
        $ret = M("refer") ->where($map)->save($data);
        if($ret){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 查询回访记录
     * @param $mark 状态是否回电
     * @return list集合  show分页
     */
    public function huiList($mark=''){
        $rObj = M("order_assistant");//作品表
        $adObj = M("admin");//管理员
        $uObj = M("user");//用户
        if($mark !=''){
            $map['is_visit'] = array('eq',$mark);
            $par['mark'] = $mark;
        }
        $map['visit'] = array('eq',"Y");
        $count = $rObj->where($map) ->count();
        $page = set_page($count,20);
        $list = $rObj
        ->where($map)->limit($page->limit)->order('order_time desc')->select();
        $show = $page->BackPage();
        $size = count($list);
        for($i=0;$i<count($list);$i++){
            //$maps['admin_code'] = array('eq',$list[$i]['tr_ke_code']);
            //$list[$i]['adname'] = $adObj -> where($maps)->getField("admin_name");
            $map2['tel'] = array('eq',$list[$i]['user_code']);
            $list[$i]['usname'] = $uObj -> where($map2)->getField("user_name");
            $list[$i]['line'] = $this->getPlaceName(explode(",",$list[$i]['order_info_star'])[0])."-". $this->getPlaceName(explode(",",$list[$i]['order_info_end'])[0]);
        }
        if($size>0){
            $data['show'] = $show;
        }
        $data['list'] = $list;
        return $data;
    }
    
    /**
     * 发送微信模板消息
     * @param string $opid
     * @param string $tmid 模板id
     * @param unknown $data 内容
     * @return boolean
     */
    function senWxTmedMages($opid='',$tmid='',$data){
        //if($us['opid']!="" && $us['opid']!=null){
        //$opid = '';//$us['opid'];
        $access_token = $this->getAccsenToken();
        print_log("----------------------------------token:".$access_token);
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token;
        $data['template_id'] = $tmid;//"nGWNfdGnTC5K20rsqZMVaIBJjI-8M_8tNZ0hvUMYH_w";//消息模板id
        $data['touser'] = $opid;
        //print_log('opid~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~'.$opid);
        $resi = $this -> curlPost($url,json_encode($data));
        if($resi['errcode'] ==0){
            return true;
        }else{
            return false;
        }
        //dump(json_decode($resi,true));
        print_log("-------------------------------".$resi);
        //}
    }
    /**
     * curl Post请求
     * @param unknown $url
     * @param unknown $post
     * @return mixed
     */
    function curlPost($url,$post){
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
     * 安排提车发送短信
     * @param string $code订单号
     * @param return boolean
     */
    function yunSend($code=''){
        $masObj = D('Worktwo');
        $master = json_decode(des_decrypt_php(session('master')),true);
        $info = M("order_assistant")->where(array("order_code"=>$code))->find();
        $us = M("user")->where(array("tel"=>$info['user_code']))->find();
        $yun = M("yundan")->where(array(array("order_code"=>$code),array('yd_type'=>"A")))->find();
        $str = sprintf(C("DUANXIN_MOBAN")['ANPAI'],
            $us['user_name'],
            $this->getPlaceName(explode(",",$info['order_info_star'])[1]),
            $this->getPlaceName(explode(',',$info['order_info_end'])[1]),
            $info['order_info_type'],
            $yun['yd_name'],
            $yun['yd_tel'],
            $yun['yd_indetity']);
        print_log("------------------安排提车员:".$str);
        $arr = explode(";",$info['mess_rec_man']);
        foreach ($arr as $k=>$v){
            $ret = send_mobile_sms($v,$str);
        }
        if($ret['status']==0){
            //$data['msg']="发送成功";
        }else{
            //$data['msg']="发送失败";
        }
        //-----发运日志
        $strsh = C("STATIC_PROPERTY.LOGS")["YUNADD"];
        $strshs = sprintf($strsh[0],$yun['yd_code']);
        $cobj = M('log');
        $admin = json_decode(des_decrypt_php(session('master')),true);
        $datas['admin_code'] = $admin['admin_name'];
        $datas['log_code'] = get_code('tl');
        $datas['log_time'] = date('Y-m-d H:i:s',time());
        $onlineip=$this -> getIp();
        $datas['log_ip'] = $onlineip;
        $datas['order_code'] = $code;
        $datas['log_content'] = $strshs;
        $datas['log_operation'] = $strsh[1];
        $datas['log_back_cont'] = "-";
        $ress = $cobj -> add($datas);
        return true;
    }
    
    /**
     * 审核发送短信
     * @param $code 订单号
     * @param return boolean
     */
    function auditingSend($code=''){
        //获取订单信息
        $masObj = D('Worktwo');
        $master = json_decode(des_decrypt_php(session('master')),true);
        $info = M("order_assistant")->where(array("order_code"=>$code))->find();
        $us = M("user")->where(array("tel"=>$info['user_code']))->find();
        if($info['sh_status'] == "Y"){
            //要发送的内容
            if($info['bill_type'] == ""){
                $shui = "不含税点";
            }else if($info['bill_type'] == "A"){
                $shui = "含普票";
            }else if($info['bill_type'] == "B"){
                $shui = "含增票";
            }
            $mark = $info['order_info_smsc'] == 'Y'?"送车上门":"自提";
            $str = sprintf(C("DUANXIN_MOBAN")['SHENHE'],
                $us['user_name'],
                $this->getPlaceName(explode(",",$info['order_info_star'])[1]),
                $this->getPlaceName(explode(',',$info['order_info_end'])[1]),
                $info['order_info_type'],
                $code,
                $info['order_info_zj']/100,
                $info['order_info_price']/100,
                $shui,
                $mark,
                $master['admin_name']);//审核通过
            print_log("------------------审核发送:".$str);
            $arr = explode(";",$info['mess_rec_man']);
            foreach ($arr as $k=>$v){
                $ret = send_mobile_sms($v,$str);
            }
            if($ret['status']==0){
                //$data['msg']="发送成功";
            }else{
                //$data['msg']="发送失败";
            }
            //-----审核日志
            $strsh = C("STATIC_PROPERTY.LOGS")["SHTG"];
            $yuejie = $info['is_yuej']=="Y"?"月结":"";
            $hui = $info['receipt']=="Y"?"回单":"";
            if($info['bill_type'] == "A"){
                $kai = "普票";
            }else if($info['bill_type'] == "B"){
                $kai = "增票";
            }else if($info['bill_type'] == "C"){
                $kai = "其他";
            }
            $ye = $info['busin_type']=='A'?"散车":"公司";
            $strshs = sprintf($strsh[0],$code,$yuejie.$hui,$kai,$ye);
            $cobj = M('log');
            $admin = json_decode(des_decrypt_php(session('master')),true);
            $datas['admin_code'] = $admin['admin_name'];
            $datas['order_code'] = $code;
            $datas['log_code'] = get_code('tl');
            $datas['log_time'] = date('Y-m-d H:i:s',time());
            $onlineip=$this -> getIp();
            $datas['log_ip'] = $onlineip;
            $datas['log_content'] = $strshs;
            $datas['log_operation'] = $strsh[1];
            $datas['log_back_cont'] = "-";
            $ress = $cobj -> add($datas);
        }else{
            //要发送的内容
            $str = sprintf(C("DUANXIN_MOBAN")['NOSHENHE'],
                $code,
                $info['sh_bei'],
                $master['admin_name']);//审核不通过
            print_log("------------------审核发送:".$str);
            $arr = explode(";",$info['mess_rec_man']);
            foreach ($arr as $k=>$v){
                $ret = send_mobile_sms($v,$str);
            }
            if($ret['status']==0){
                //$data['msg']="发送成功";
            }else{
                //$data['msg']="发送失败";
            }
            //-----审核日志
            $strsh = C("STATIC_PROPERTY.LOGS")["NSHTG"];
            $strshs = sprintf($strsh[0],$code,$info['sh_bei']);
            $cobj = M('log');
            $admin = json_decode(des_decrypt_php(session('master')),true);
            $datas['admin_code'] = $admin['admin_name'];
            $datas['log_code'] = get_code('tl');
            $datas['log_time'] = date('Y-m-d H:i:s',time());
            $onlineip=$this -> getIp();
            $datas['log_ip'] = $onlineip;
            $datas['log_content'] = $strshs;
            $datas['log_operation'] = $strsh[1];
            $datas['log_back_cont'] = "-";
            $ress = $cobj -> add($datas);
        }
        return true;
    }
    
    
    
    function getIp(){
        $onlineip='';
        if(getenv('HTTP_CLIENT_IP')&&strcasecmp(getenv('HTTP_CLIENT_IP'),'unknown')){
            $onlineip=getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')&&strcasecmp(getenv('HTTP_X_FORWARDED_FOR'),'unknown')){
            $onlineip=getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')&&strcasecmp(getenv('REMOTE_ADDR'),'unknown')){
            $onlineip=getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR'])&&$_SERVER['REMOTE_ADDR']&&strcasecmp($_SERVER['REMOTE_ADDR'],'unknown')){
            $onlineip=$_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }
    
    /**
     * 订单详情写入日志
     * @param unknown $key 配置文件key
     * @param unknown $data 替换内容
     * @param unknown $keys 需要查找索引,默认0
     */
    function logsSet($key='',$data='',$keys=0){
        $str = C("STATIC_PROPERTY.LOGS")[$key];
        $strs = sprintf($str[$keys],$data['order_code'],$data['A']);
        $cobj = M('log');
        $admin = json_decode(des_decrypt_php(session('master')),true);
        $datas['admin_code'] = $admin['admin_name'];
        $datas['log_code'] = get_code('tl');
        $datas['log_time'] = date('Y-m-d H:i:s',time());
        $onlineip=$this -> getIp();
        $datas['log_ip'] = $onlineip;
        $datas['log_content'] = $strs;
        $datas['log_operation'] = $str[1];
        if($key == 'YUNADD' || $key=='YUNEDIT'){
            $datas['order_code'] = $data['order_code'];
            $code = $data['yd_code'];
        }else{
            $code = $data['order_code'];
        }
        $datas['order_code'] = $code;
        print_log("-----------订单code".$code);
        $datas['log_back_cont'] = sprintf($str[$keys],$code,$data['B']);
        $ress = $cobj -> add($datas);
        if($ress){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取订单信息
     * @param unknown $code
     * @param unknown $key
     * @return Ambigous <\Think\mixed, NULL, mixed, unknown, multitype:Ambigous <unknown, string> unknown , object>
     */
    function getOrderInfo($code,$key){
        return M("order_assistant") ->where(array("order_code"=>$code))->getField($key);
    }
}