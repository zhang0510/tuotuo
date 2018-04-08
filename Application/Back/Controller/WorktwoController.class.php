<?php
namespace Back\Controller;
class WorktwoController extends BaseController {
    /**
     * 咨询用户下单
     */
    public function referOrder(){
        
        $masObj = D('Worktwo');
        //dump($masObj->get_province());die();
        $this->assign("cart",$masObj->getCar());
        $this->assign('city',$masObj->get_province());
        $this->display("Refer:ref_order");
    }
    /**
     * 获取用户下过的单
     */
    public function getReferOrder(){
        $val = I("val");
        $this->ajaxReturn(D('Worktwo')->getReferOrder($val));
    }
    /**
     * 获取城市区域
     */
    public function getCitys(){
        $id = I("id");
        $masObj = D('Worktwo');
        $this->ajaxReturn($masObj->getCity($id));
    }
    /**
     * 获取车型
     */
    public function getCarXing(){
        $id = I("id");
        $masObj = D('Worktwo');
        $this->ajaxReturn($masObj->getCar($id));
    }
    /**
     * 获取价格
     */
    public function getPrice(){
        $masObj = D('Worktwo');
        $this->ajaxReturn($masObj->getPrice(I("city_shi"),I("city_jie_shi"),I("car_id")));
    }
    /**
     * 获取保费
     */
    public function getAcale(){
        $this->ajaxReturn(D('Worktwo')->getSecu(I("car_baojia")*10000,"acale_clent"));
    }
    /**
     * 短信回复
     */
    function sendMobile(){
        $master = json_decode(des_decrypt_php(session('master')),true);
        $data['tr_tel'] = I("tr_tel");
        $data['tr_name'] = I("tr_name");
        $data['tr_start'] = I("tr_start");
        $data['tr_end'] = I("tr_end");
        $data['tr_carxing'] = I("tr_carxing");
        $data['tr_bao'] = I("tr_bao")*100;
        $data['tr_yun'] = I("tr_yun")*100;
        $data['tr_bei'] = I("tr_bei");
        $data['tr_mark'] = 'N';
        $data['tr_hui_time'] = I("tr_hui_time");
        $data['tr_duan'] = date("Y-m-d",time());
        $data['tr_ke_code'] = $master['admin_code'];
        
        $masObj = D('Worktwo');
        $res = $masObj->referInsert($data);
        if($res){
            //$str = "{$data['tr_duan']},查询{$masObj->getPlaceName(explode(",",$data['tr_start'])[1])}发{$masObj->getPlaceName(explode(',',$data['tr_end'])[1])}价格,报价".($data['tr_yun']/100)."元。";
            $str = sprintf(C("DUANXIN_MOBAN")['ZIXUN'],$data['tr_name'],$masObj->getPlaceName(explode(",",$data['tr_start'])[1]),$masObj->getPlaceName(explode(',',$data['tr_end'])[1]),$data['tr_yun']/100,$master['admin_name']);
            print_log("--------------内容:".$str);
            $ret = send_mobile_sms($data['tr_tel'],$str);
            if($ret['status']==0){
                $data['msg']="发送成功";
                $data['id'] = $res;
            }else{
                $data['msg']="发送失败";
            }
            
        }else{
            $data['msg']="发送失败";
        }
        $this->ajaxReturn($data);
    }
    /**
     * 判断是否上门送车&&计算价格
     */
    public function smscFun(){
        $masObj = D('Worktwo');
        $id = I("id");
        $type = I("type");
        $sm_star = I("cit_jie_str");
        $str = I("str");
        $info = $masObj->getPrice($str,$sm_star,I("car_id"));
        $sm_end = $sm_star.",".$id;
        $msg['prices'] = ($masObj->getsmPrice($sm_star,$sm_end)['sm_platelets_price'])/100;
        //print_log("----------------------:".$type);
        if($type=='Y'){
            $msg['price'] = $msg['prices'] + $info['totel'];
            $msg['flag'] = true;
        }else{
            $msg['price'] = $info['totel'] - $msg['prices'];
            $msg['flag'] = false;
        }
        $this->ajaxReturn($msg);
    }
    /**
     * 获取票费
     */
    public function getRatePrice(){
        $this->ajaxReturn(D('Worktwo')->getSecu(I("heji"),I("type")));
    }
    
    /**
     * 客服订单提交
     */
    function setOrder(){
        $masObj = D('Worktwo');
        $accs = json_decode(des_decrypt_php(session('master')),true);
        $data['order_code'] = $masObj->getTablecode("M");
        $time = date("Y-m-d H:i:s",time());
        $mobile = I("mobile");
        $data_m['user_code'] = get_code("TU");
        //$data_m['user_name'] = $mobile;
        $data_m['tel'] = $mobile;
        $data_m['addtime'] = $time;
        $data_m['role'] = "C";
        
        $data['admin_name'] = $accs['admin_name'];
        $data['admin_code'] = $accs['admin_code'];
        $data['order_time'] = $time;
        $data['user_code'] = $mobile;
        $data['order_status'] = "S";
        $data['pay_status'] = 'W';
        $data['receipt'] = I('receipt');
        $data['busin_type'] = I("busin_type");
        $data['is_yuej']= I("is_yuej");
        $data['bill_type'] = I("bill_type");
        $data['bill_price'] = I('bill_price')*100;
        $data['mess_rec_man'] = rtrim(I("mess_rec_man"),';');
        $data['source'] = "A";
        $data['product_type'] = I("product_type");
        $data['order_way'] = 'S';
        $data['pay_way'] = 'H';
        $data['kefu_shi'] = 'N';
        $data['order_info_brand'] = I("car_pin");
        $data['order_info_type'] = I("car_xing");
        $data['order_info_carmark'] = I("carmark");
        $data['order_info_zj'] = I("order_info_zj")*100;
        $data['order_info_price'] = I("order_info_price")*100;
        $data['order_info_c_car'] = I("order_info_c_car")*100;
        $data['order_info_t_car'] = I("order_info_t_car")*100;
        $data['order_info_s_car'] = I("order_info_s_car")*100;
        $data['order_smsc_car'] = I("order_smsc_car")*100;
        $data['order_info_bxd'] = I("order_info_bxd")*100;
        $data['order_info_smsc'] = I("order_info_smsc");
        $data['order_info_star'] = I("order_info_star");
        $data['order_info_tclxr'] = I("order_info_tclxr");
        $data['order_info_sclxr'] = I("order_info_sclxr");
        $data['order_info_star_address'] = I("order_info_star_address");
        $data['order_info_end'] = I("order_info_end");
        $data['order_info_smscd'] = I("order_info_smscd");
        $data['order_info_end_address'] = I("order_info_end_address");
        $data['order_info_remark'] = I("order_info_remark");
        $data['order_info_margin'] = I("order_info_margin")*100;
		$data['order_info_carmark'] = I("carmark");//车牌号码
		$data['refer_id'] = I("refer_id");
        $ret = $masObj->setOrder($data,$data_m);
        if($ret){
            $msg['flag'] = true;
            $msg['order_code'] = $data['order_code'];
            
        }else{
            $msg['flag'] = false;
            $msg['msg'] = "下单失败";
        }
        $this->ajaxReturn($msg);
        /* if($ret){
            $this->success('添加成功',U('Worklwt/orderinfo',array('order_code'=>$data['order_code'])));
        }else{
            $this->error("添加失败",U('Worklwt/latencyMemberList'));
        } */
    }
    
    /**
     * 待回电列表
     */
    function referMarkList(){
        $list = D("Worktwo")->referList("N");
        $this->assign("list",$list);
        $this->display("Refer:refer_mark_list");
    }
    /**
     * 确认回电
     */
    function checkRefer(){
        $this->ajaxReturn(D("Worktwo")->checkRefer(I("id")));
    }
    /**
     * 咨询列表列表
     */
    function referList(){
        $list = D("Worktwo")->referList();
        $this->assign("list",$list);
        $this->display("Refer:refer_list");
    }
    /**
     * 待回访列表
     */
    function huiList(){
        $list = D("Worktwo")->huiList("N");
        $this->assign("list",$list);
        $this->display("Refer:hui_list");
    }
    /**
     * 全部回访列表
     */
    function qHuiList(){
        $list = D("Worktwo")->huiList();
        $this->assign("list",$list);
        $this->display("Refer:qhui_list");
    }
    //打印托运合同-妥妥运车服务合同单
    public function pdf_fwhtd($order_code=""){
        $order_code = $order_code==""?I('order_code'):$order_code;
        $status = I('get.status')==""||I('get.status')==null?"":I('get.status');
        print_log("是否打印标示:".$status);
        $html_pdf="";
        $result="";
        if ($order_code!=""){
            $p_Obj = D('PdfPrint');
            if($status==''){
                $result = $p_Obj -> pdf_Order($order_code);
                $strs = '';
                foreach ($result['img'] as $k=>$v){
                    $strs .= "<pre>".$v['verify_img_code']."</pre>";
                }
                $html_pdf = <<<HTML
            <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;"   class="sdsd" align="center">
    
        		<tbody>
    
    
            		 <tr>
            		 <td align="center" style="font-size:24px;"><h3>妥妥运车服务协议（电子版）</h3></td>
            		 </tr>
                        <tr>
            		 <td align="left" style="padding:5px;">起运地：{$result['star']} 目的地：{$result['end']}&nbsp;&nbsp;运输日期：{$result['yd_j_time'][0]}年{$result['yd_j_time'][1]}月{$result['yd_j_time'][2]}日                   No {$order_code} </td>
            		 </tr>
    
               </tbody>
             </table>
       
<table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-top:2px solid #000;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
    
		 <tr>
		 <td align="left" style="padding:0px 5px;border-bottom:1px dotted #eee;">委托方（甲方）：{$result['tclxr'][0]} &nbsp;&nbsp;&nbsp;联系电话：{$result['tclxr'][1]}&nbsp;&nbsp;&nbsp;证件号：{$result['tclxr'][2]}</td>
		 </tr>
            <tr>
		 <td align="left" style="padding:0px 5px;">委托方指定收车人：{$result['sclxr'][0]}&nbsp;&nbsp;&nbsp;联系电话：{$result['sclxr'][1]}&nbsp;&nbsp;&nbsp;证件号：{$result['sclxr'][2]}</td>
		 </tr>
   </tbody>
 </table>
 <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-left:2px solid #000;border-right:2px solid #000;border-bottom:1px solid #000;"   class="sdsd" align="center">
    
		<tbody>
         <tr>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">接车方式</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">{$result['order_way']}</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">交车地址</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="5">{$result['address']}</td>
         </tr>
         <tr>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">车辆名称</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">车辆识别代码或车牌号</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">车辆价值（万元）</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">保险费</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">运输费</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">其他</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">合计</td>
         </tr>
		 <tr>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">{$result['brand']}</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">{$result['carmark']}</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">{$result['car_price']}</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">{$result['bxd_price']}</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">{$result['ct_price']}</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">{$result['qita']}</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">{$result['zjia']}</td>
         </tr>
   </tbody>
 </table>
    
   <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
		 <tr>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>交接内容</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>车钥匙</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>{$result['car_key']}&nbsp;&nbsp;把</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>当前公里数</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;border-bottom:1px solid #000;padding:0px 5px;"><b>{$result['car_km']}&nbsp;&nbsp;KM</b></td>
		   <td colspan="2" style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>提车司机预计使用公里数</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>{$result['car_ti_km']}&nbsp;&nbsp;KM</b></td>
		 </tr>
    
   </tbody>
 </table>
 <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
		 <tr>
		   <td width="64%" >
		   <table cellpadding="0" cellspacing="0">
		   <tr>
		   <td align="left" style="padding:0px 2px;border-bottom:1px solid #000;"><b>行李工具:</b></td>
		   <td style="padding:0px 2px;border-right:1px solid #000;border-bottom:1px solid #000;" height="80" colspan="4">{$result['verify_xingli']}</td>
		   </tr>
		   <tr>
		   <td align="left" style="padding:0px 2px;border-bottom:1px solid #000;"><b>车身外观  :</b></td>
		   <td style="padding:0px 2px;border-right:1px solid #000;border-bottom:1px solid #000;" height="80" colspan="4">{$result['verify_car_wai']}</td>
		   </tr>
		   <tr>
		   <td align="left" style="padding:0px 2px;"><b>备注:</b></td>
		   <td style="padding:0px 2px;border-right:1px solid #000;" height="80" colspan="4">{$result['verify_bei']}</td>
		   </tr>
		   </table>
		   </td>
		   <td width="36%">
		      <table   cellpadding="0" cellspacing="0">
		       <tr>
		          <td align="left" style="padding:0px 5px;border-bottom:1px solid #000;">验车照片编号</td>
		       </tr>
		       <tr>
		          <td>
		              {$strs}
		          </td>
		       </tr>
		       </table>
		   </td>
		 </tr>
        </tbody>
 </table>
    
 <table width="650" cellpadding="0" cellspacing="0" style="line-height:24px;font-size:13px;border-top:0px solid #000;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
    
		 <tr>
		 <td  width="72%" style="padding:0px;">
		  <table   cellpadding="2" cellspacing="0" style="font-size:12px;border-right:2px solid #000;">
		   <tr>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;">费用总计</td>
		   <td colspan="2" style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;">
		   ({$result['number'][1]} 万{$result['number'][2]} 千{$result['number'][3]} 佰{$result['number'][4]} 拾{$result['number'][5]}元整)</td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;"><b>结算方式：</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;" >{$result['payway']}</td>
		   </tr>
		 
		   <tr>
		   <td align="left" colspan="3" style="font-weight:700;border-top:2px solid #000;border-right:1px dotted #000;padding:2px;" width="60%">协议事项：<br>
1.车辆到达目的地后，接车人必须如约提车。<br>
2.委托方交付车辆时，视为电子合同签字。<br>
3.委托方验车无误，接收车辆签字，视为合同履行完成。<br>
4.车辆如运输过程中发生质损，托运方必须配合承运公司办理理赔手续，托运方不得擅自扣除运费抵充。</td>
	   <td colspan="2" align="left" style="font-weight:700;border-top:2px solid #000;color:red;padding:0px;padding:0px 5px;">●特别声明：<br>
此车为贵重商品，为保障双方权益，请托运方主动投保或委托承运方代为投保；托运方投保不足的，如遇任何意外所造成的经济损失，承运方按保险公司投保比例的相关规定予以赔偿。</td>
		   </tr>
		   <tr>
		   <td colspan="5" style="font-weight:700;border-top:2px solid #000;border-right:1px dotted #000;padding:2px;">注：请认真阅读该运输单的运输条款。除非另有约定，托运方即已同意运输条款。
		   </td></tr>
		
		  </table>
    
		 </td>
		  <td  width="28%" style="padding:0px;">
		  	  <table   cellpadding="0" cellspacing="0">
		   <tr><td align="left" height="145" style="font-size:12px;font-weight:700;border-bottom:1px solid #000;">承运方盖章、经办人确认
签章：<br><br><br><br>
日期：{$result['time'][0]}年{$result['time'][1]}月{$result['time'][2]}日
</td></tr>
		  		   <tr><td align="left" height="95" style="font-size:12px;font-weight:700;border-bottom:1px solid #000;">委托方、经办人确认
签字：<br />{$result['tclxr'][0]}<br><br>
日期：{$result['yd_j_time'][0]}年{$result['yd_j_time'][1]}月{$result['yd_j_time'][2]}日
</td></tr>
		 
		  </table>
    
    
		  </td>
		 </tr>
    
   </tbody>
 </table>
 <table width="650" cellpadding="2" cellspacing="0" style="line-height:24px;font-size:14px;"   class="sdsd" align="left">
 	   <tr>
        <td>
            	<br />
            	依据相关法律规定，双方本着平等、自愿、公平之原则，经充分协商，就乙方向甲方提供运输乘用车服务事项达成一致，为保障双方的利益，特达成如下协议：
            <br />
            	一、甲方的权利、义务
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.甲方应认真、准确填写本单，确保所交运的车辆不涉及盗抢、套牌、走私等涉案不合法车辆，并能提供证明该车辆的合法来源，使其适合运输。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2.甲方应在乙方客户端准确写明收车人的名称或者姓名或者凭指定的收车人，车辆的品牌、型号、收车地点等有关车辆运输的必要情况。因甲方填写不实或遗漏重要情况，造成乙方损失的，甲方应当承担损害赔偿责任。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;3.甲方应确保所托运的车辆内严禁携带易燃、易爆、易腐蚀、放射性以及国家法律明文规定的各种管制刀具、枪械、毒品等物品。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;4.甲方在车内放置的物品（≤200kg）需确保车辆车窗、车门、后备箱能正常关闭，并确保能安全装卸上下车，但不确保所搭载的物品不影响视线。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;5.甲方在乙方将运输车辆交于收车人之前，甲方可以要求乙方中止运输、返还运输车辆、变更到达地或者将运输车辆交给其他收车人，但应赔偿乙方因此遭受到的损失。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;6.甲方可以在托运车辆期间随时查询车辆在运输途中的状态，但必须是乙方的工作期间内。</b>
            <br />
            	<b>&nbsp;</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;7.甲方必须按照双方约定的期限结算该次运输的相关费用，甲方可以对乙方的工作提出建议，乙方接受并及时改正。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;8.甲方若变更收车人信息，应及时通知乙方，并将收车人的身份证号和联系方式一并告知，同时视为授权乙方在电子合同单上修改收车人信息。</b>
            <br />
            	二、乙方的权利、义务
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.乙方应认真、准确填写《妥妥运车服务合同单》，并按照协议内容及时运输并准时完成运输事宜。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2.乙方在甲方确认托运后，给甲方提供一份不填有车辆实际情况的《妥妥运车服务合同单》（不视为完整合同）。乙方所派遣工作人员现场拍照验车后提供验车单，验车单与合同单共同组成一份完整合同，具有相应的法律效力。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;3. 甲乙双方根据国家相关规定负有投保义务，甲方可自行投保或委托乙方代为投保，投保额度为车辆的市场销售价格或当前车辆估值投保，甲方投保不足的，如遇任何意外所造成的经济损失，承运方按保险公司投保比例的相关规定予以赔偿。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;4.乙方有权检查被运输车辆的合法性，并核对收车人的身份证等合法有效的证件。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;5.乙方有义务保证被运输的车辆在运输过程中不得被其他单位或个人使用，并有义务为甲方提供车辆在运输过程中状态信息的查询服务。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;6.车辆抵达目的地时，乙方应及时通知收车人提车并验车。若收车人因故迟来，乙方工作人员所产生的正常支出由甲方承担。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;7.乙方及时将车辆运输至甲方指定地点，甲方或指定收车人未能及时支付乙方运输的相关费用，乙方有权根据《中华人民共和国合同法》第三百一十五条行使留置权。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;8.乙方对运输过程中车辆的毁损、灭失承担损害赔偿责任，但乙方证明车辆的毁损、灭失是因不可抗力、车辆本身的自然性质或者合理损耗的，乙方不承担赔偿责任。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;9.乙方在验车或运输时发现甲方车内放置有易燃、易爆、易腐蚀、放射性等物品，乙方可以拒绝运输，也可以采取相应措施避免损失的发生，因此产生的费用由甲方负担。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;10.收车人已按规定接受车辆，乙方交车人员已离开现场，时候发现车辆有损或者随车物品缺失的，乙方不负任何法律责任。</b>
            <br />
            	三、保密条款
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.甲、乙双方从对方获取的资料和相关的商业机密、无需公开的信息等，双方负有保密义务，并应采取一切合法的措施以使其所接受的资料免于被无关人员接触。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2.此信息仅供委托人使用，如果不是预期的委托人，特此声明，对于本承运单的复印、印刷等任何形式使用或依此产生的任何行动都是严格禁止和无效的。</b>
           <br />
            	四、保险条款
           <br />
            	车辆运输的保险由太平洋、中国平安、中国人民财产保险等公司全程承保，保险金额为车辆实际价格，最高不超过市场的销售价格或当前车辆估值。
           <br />
            	五、责任索赔
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.车辆运达目的地并经接收方签字前，若甲方已经自行办理的运输保险或者委托乙方代办运输保险，因运输原因导致甲方车辆出现划痕、碰撞、弯曲、开裂等现象，保险公司承担责任，乙方不承担责任但有义务协助甲方向保险公司提出车辆实际的申报向保险公司索要赔偿，但运费不免。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2．车辆一旦发生划痕、碰撞等现象，乙方将负责车辆维修，但维修费用最高不超过甲方支付给乙方的运费2倍（运输费用全额付清给乙方后在进行维修）。</b>
            <br />
            	六、其他
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1．本协议签署以用户客户端确认为准，用户使用客户端操作视为同意我公司电子签约协议，在客户端的所有操作视同本人实际操作并承担相应责任。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2．任何一方欲解除运输合同，必须提前通知对方。运输结束后，合同自然解除。协议解除后尚有待结运费的，甲方在接到结算通知后5日内结清。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;3．甲、乙双方在履行过程中发生任何争议应及时沟通解决，如不能协商解决的可向北京市顺义区人民法院提起诉讼。</b>
            <br />
            <div style="text-align:right;">
            	妥妥运车项目部
            </div>
        </td>
       </tr>
</table>
HTML;
            }else{
				$html_pdf = <<<HTML
            <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;"   class="sdsd" align="center">
    
        		<tbody>
    
    
            		 <tr>
            		 <td align="center" style="font-size:24px;"><h3>妥妥运车服务协议（电子版）</h3></td>
            		 </tr>
                        <tr>
            		 <td align="left" style="padding:5px;">起运地：xxx 目的地：xxx运输日期：xxxx年xx月xx日                   No xxxxxxxx </td>
            		 </tr>
    
               </tbody>
             </table>
       
<table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-top:2px solid #000;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
    
		 <tr>
		 <td align="left" style="padding:0px 5px;border-bottom:1px dotted #eee;">委托方（甲方）：xxx &nbsp;&nbsp;&nbsp;联系电话：xxxxxxxx&nbsp;&nbsp;&nbsp;证件号：xxxxxxxxxxxx</td>
		 </tr>
            <tr>
		 <td align="left" style="padding:0px 5px;">委托方指定收车人：xxx&nbsp;&nbsp;&nbsp;联系电话：xxxxxxxx&nbsp;&nbsp;&nbsp;证件号：xxxxxxxxxxxx</td>
		 </tr>
   </tbody>
 </table>
 <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-left:2px solid #000;border-right:2px solid #000;border-bottom:1px solid #000;"   class="sdsd" align="center">
    
		<tbody>
         <tr>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">接车方式</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">xxxxxxxx</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">交车地址</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="5">xxxxxxxx</td>
         </tr>
         <tr>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">车辆名称</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">车辆识别代码或车牌号</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">车辆价值（万元）</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">保险费</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">运输费</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">其他</td>
            <td style="font-size:12px;padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">合计</td>
         </tr>
		 <tr>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">x</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">x</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;" colspan="2">x</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">x</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">x</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">x</td>
            <td style="padding:0px 5px;border-bottom:1px solid #000;border-right:1px solid #000;padding:0px 5px;">x</td>
         </tr>
   </tbody>
 </table>
    
   <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
		 <tr>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>交接内容</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>车钥匙</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>xx&nbsp;&nbsp;&nbsp;&nbsp;把</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>当前公里数</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;border-bottom:1px solid #000;padding:0px 5px;"><b>xxx&nbsp;&nbsp;&nbsp;&nbsp;KM</b></td>
		   <td colspan="2" style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>提车司机预计使用公里数</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;border-bottom:1px solid #000;"><b>xxx&nbsp;&nbsp;&nbsp;&nbsp;KM</b></td>
		 </tr>
    
   </tbody>
 </table>
 <table width="650" cellpadding="2" cellspacing="0" style="font-size:13px;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
		 <tr>
		   <td width="64%" >
		   <table cellpadding="0" cellspacing="0">
		   <tr>
		   <td align="left" style="padding:0px 2px;border-bottom:1px solid #000;"><b>行李工具:</b></td>
		   <td style="padding:0px 2px;border-right:1px solid #000;border-bottom:1px solid #000;" height="80" colspan="4">xxxxx</td>
		   </tr>
		   <tr>
		   <td align="left" style="padding:0px 2px;border-bottom:1px solid #000;"><b>车身外观  :</b></td>
		   <td style="padding:0px 2px;border-right:1px solid #000;border-bottom:1px solid #000;" height="80" colspan="4">xxxxx</td>
		   </tr>
		   <tr>
		   <td align="left" style="padding:0px 2px;"><b>备注:</b></td>
		   <td style="padding:0px 2px;border-right:1px solid #000;" height="80" colspan="4">xxxxx</td>
		   </tr>
		   </table>
		   </td>
		   <td width="36%">
		      <table   cellpadding="0" cellspacing="0">
		       <tr>
		          <td align="left" style="padding:0px 5px;border-bottom:1px solid #000;">验车照片编号</td>
		       </tr>
		       <tr>
		          <td>xxxxx</td>
		       </tr>
		       </table>
		   </td>
		 </tr>
        </tbody>
 </table>
 <table width="650" cellpadding="0" cellspacing="0" style="line-height:24px;font-size:13px;border-top:0px solid #000;border-left:2px solid #000;border-right:2px solid #000;border-bottom:2px solid #000;"   class="sdsd" align="center">
    
		<tbody>
    
    
		 <tr>
		 <td  width="72%" style="padding:0px;">
		  <table   cellpadding="2" cellspacing="0" style="font-size:12px;border-right:2px solid #000;">
		   <tr>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;">费用总计</td>
		   <td colspan="2" style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;">
		   ( x万 x千 x佰 x拾 x元整)</td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;"><b>结算方式：</b></td>
		   <td style="padding:0px 5px;border-right:1px solid #000;padding:0px 5px;" >xxxxx</td>
		   </tr>
		 
		   <tr>
		   <td align="left" colspan="3" style="font-weight:700;border-top:2px solid #000;border-right:1px dotted #000;padding:2px;" width="60%">协议事项：<br>
1.车辆到达目的地后，接车人必须如约提车。<br>
2.委托方交付车辆时，视为电子合同签字。<br>
3.委托方验车无误，接收车辆签字，视为合同履行完成。<br>
4.车辆如运输过程中发生质损，托运方必须配合承运公司办理理赔手续，托运方不得擅自扣除运费抵充。</td>
	   <td colspan="2" align="left" style="font-weight:700;border-top:2px solid #000;color:red;padding:0px;padding:0px 5px;">●特别声明：<br>
此车为贵重商品，为保障双方权益，请托运方主动投保或委托承运方代为投保；托运方投保不足的，如遇任何意外所造成的经济损失，承运方按保险公司投保比例的相关规定予以赔偿。</td>
		   </tr>
		   <tr>
		   <td colspan="5" style="font-weight:700;border-top:2px solid #000;border-right:1px dotted #000;padding:2px;">注：请认真阅读该运输单的运输条款。除非另有约定，托运方即已同意运输条款。
		   </td></tr>
		
		  </table>
    
		 </td>
		  <td  width="28%" style="padding:0px;">
		  	  <table   cellpadding="0" cellspacing="0">
		   <tr><td align="left" height="145" style="font-size:12px;font-weight:700;border-bottom:1px solid #000;">承运方盖章、经办人确认
签章：<br><br><br><br>
日期：xxxx年xx月xx日
</td></tr>
		  		   <tr><td align="left" height="95" style="font-size:12px;font-weight:700;border-bottom:1px solid #000;">委托方、经办人确认
签字：xxx<br><br><br>
日期：xxxx年xx月xx日
</td></tr>
		 
		  </table>
    
    
		  </td>
		 </tr>
    
   </tbody>
 </table>
 <table width="650" cellpadding="2" cellspacing="0" style="line-height:24px;font-size:14px;"   class="sdsd" align="left">
 	   <tr>
        <td>
            	<br />
            	依据相关法律规定，双方本着平等、自愿、公平之原则，经充分协商，就乙方向甲方提供运输乘用车服务事项达成一致，为保障双方的利益，特达成如下协议：
            <br />
            	一、甲方的权利、义务
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.甲方应认真、准确填写本单，确保所交运的车辆不涉及盗抢、套牌、走私等涉案不合法车辆，并能提供证明该车辆的合法来源，使其适合运输。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2.甲方应在乙方客户端准确写明收车人的名称或者姓名或者凭指定的收车人，车辆的品牌、型号、收车地点等有关车辆运输的必要情况。因甲方填写不实或遗漏重要情况，造成乙方损失的，甲方应当承担损害赔偿责任。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;3.甲方应确保所托运的车辆内严禁携带易燃、易爆、易腐蚀、放射性以及国家法律明文规定的各种管制刀具、枪械、毒品等物品。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;4.甲方在车内放置的物品（≤200kg）需确保车辆车窗、车门、后备箱能正常关闭，并确保能安全装卸上下车，但不确保所搭载的物品不影响视线。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;5.甲方在乙方将运输车辆交于收车人之前，甲方可以要求乙方中止运输、返还运输车辆、变更到达地或者将运输车辆交给其他收车人，但应赔偿乙方因此遭受到的损失。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;6.甲方可以在托运车辆期间随时查询车辆在运输途中的状态，但必须是乙方的工作期间内。</b>
            <br />
            	<b>&nbsp;</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;7.甲方必须按照双方约定的期限结算该次运输的相关费用，甲方可以对乙方的工作提出建议，乙方接受并及时改正。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;8.甲方若变更收车人信息，应及时通知乙方，并将收车人的身份证号和联系方式一并告知，同时视为授权乙方在电子合同单上修改收车人信息。</b>
            <br />
            	二、乙方的权利、义务
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.乙方应认真、准确填写《妥妥运车服务合同单》，并按照协议内容及时运输并准时完成运输事宜。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2.乙方在甲方确认托运后，给甲方提供一份不填有车辆实际情况的《妥妥运车服务合同单》（不视为完整合同）。乙方所派遣工作人员现场拍照验车后提供验车单，验车单与合同单共同组成一份完整合同，具有相应的法律效力。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;3. 甲乙双方根据国家相关规定负有投保义务，甲方可自行投保或委托乙方代为投保，投保额度为车辆的市场销售价格或当前车辆估值投保，甲方投保不足的，如遇任何意外所造成的经济损失，承运方按保险公司投保比例的相关规定予以赔偿。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;4.乙方有权检查被运输车辆的合法性，并核对收车人的身份证等合法有效的证件。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;5.乙方有义务保证被运输的车辆在运输过程中不得被其他单位或个人使用，并有义务为甲方提供车辆在运输过程中状态信息的查询服务。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;6.车辆抵达目的地时，乙方应及时通知收车人提车并验车。若收车人因故迟来，乙方工作人员所产生的正常支出由甲方承担。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;7.乙方及时将车辆运输至甲方指定地点，甲方或指定收车人未能及时支付乙方运输的相关费用，乙方有权根据《中华人民共和国合同法》第三百一十五条行使留置权。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;8.乙方对运输过程中车辆的毁损、灭失承担损害赔偿责任，但乙方证明车辆的毁损、灭失是因不可抗力、车辆本身的自然性质或者合理损耗的，乙方不承担赔偿责任。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;9.乙方在验车或运输时发现甲方车内放置有易燃、易爆、易腐蚀、放射性等物品，乙方可以拒绝运输，也可以采取相应措施避免损失的发生，因此产生的费用由甲方负担。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;10.收车人已按规定接受车辆，乙方交车人员已离开现场，时候发现车辆有损或者随车物品缺失的，乙方不负任何法律责任。</b>
            <br />
            	三、保密条款
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.甲、乙双方从对方获取的资料和相关的商业机密、无需公开的信息等，双方负有保密义务，并应采取一切合法的措施以使其所接受的资料免于被无关人员接触。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2.此信息仅供委托人使用，如果不是预期的委托人，特此声明，对于本承运单的复印、印刷等任何形式使用或依此产生的任何行动都是严格禁止和无效的。</b>
           <br />
            	四、保险条款
           <br />
            	车辆运输的保险由太平洋、中国平安、中国人民财产保险等公司全程承保，保险金额为车辆实际价格，最高不超过市场的销售价格或当前车辆估值。
           <br />
            	五、责任索赔
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1.车辆运达目的地并经接收方签字前，若甲方已经自行办理的运输保险或者委托乙方代办运输保险，因运输原因导致甲方车辆出现划痕、碰撞、弯曲、开裂等现象，保险公司承担责任，乙方不承担责任但有义务协助甲方向保险公司提出车辆实际的申报向保险公司索要赔偿，但运费不免。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2．车辆一旦发生划痕、碰撞等现象，乙方将负责车辆维修，但维修费用最高不超过甲方支付给乙方的运费2倍（运输费用全额付清给乙方后在进行维修）。</b>
            <br />
            	六、其他
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;1．本协议签署以用户客户端确认为准，用户使用客户端操作视为同意我公司电子签约协议，在客户端的所有操作视同本人实际操作并承担相应责任。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;2．任何一方欲解除运输合同，必须提前通知对方。运输结束后，合同自然解除。协议解除后尚有待结运费的，甲方在接到结算通知后5日内结清。</b>
            <br />
            	<b>&nbsp;&nbsp;&nbsp;&nbsp;3．甲、乙双方在履行过程中发生任何争议应及时沟通解决，如不能协商解决的可向北京市顺义区人民法院提起诉讼。</b>
            <br />
            <div style="text-align:right;">
            	妥妥运车项目部
            </div>
        </td>
       </tr>
</table>
HTML;
            }
    
            $this->export_pdf($html_pdf,$result['time'][0].$result['time'][1].$result['time'][2],'T',$status);
        }
    }
    
    //pdf方法
    public function export_pdf($data='',$fileName='',$mark,$status=''){
		$fileName = $fileName==""?date('Ydm',time()):$fileName;
		print_log("-------------".$data);
        print_log("pdfmingcheng:".$fileName);
        set_time_limit(120);
        if(empty($data)){
			print_log("------测----试------测----试-----测----试--------");
			$this->error("导出的数据为空！");
		}else{
			print_log("------测试------测试-----测试--------");
		vendor("tcpdf6.tcpdf");
        require_cache(VENDOR_PATH . 'tcpdf/examples/lang/eng.php');
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);//新建pdf文件
        //设置文件信息
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("Author");
        $pdf->SetTitle("pdf test");
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        //设置页眉页脚
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetHeaderData("", "", 'www.lfmnet.com','',array(66,66,66), array(0,0,0));
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);//设置默认等宽字体
        $pdf->SetMargins(15, 14, PDF_MARGIN_RIGHT);//设置页面边幅
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);//设置自动分页符
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //$pdf->setLanguageArray($l);
        $pdf->SetFont('droidsansfallback', '');
        $pdf->AddPage();
        $pdf->SetFillColor(245, 245, 245);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(66, 66, 66);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('droidsansfallback', '',9);
        if($mark=="K"&&$status==""){
            //$pdf->Image('Public/Front/images/gzss.png', 20, 85, 40, 40, 'png');
        }else if($mark=="T"&&$status==""){
            $pdf->Image('Public/Front/images/tuologo.png', 15, 0, 0, 0, 'png');
            //$pdf->Image('Public/Front/images/gzss.png', 150, 130, 40, 40, 'png');
        }
        $pdf->writeHTML($data,true, false, true, false, '');
        $showType= "I";//PDF输出的方式。I，在浏览器中打开；D，以文件形式下载；F，保存到服务器中；S，以字符串形式输出；E：以邮件的附件输出。
        $pdf->Output($fileName.'.pdf', $showType);
        exit;
		}
    
    }
    
    
    
    
    function wrgerg(){
        $data['data'] = array(
            'first'=>array("value"=>"测试","color"=>"#173177"),
            'keyword1'=>array("value"=>'测试一下子测试一下子测试一下子测试一下子测试一下子',"color"=>"#173177"),
            'keyword2'=>array("value"=>'lisanli',"color"=>"#173177"),
            'keyword3'=>array("value"=>date("Y-m-d H:i:s",time()),"color"=>"#173177"),
            'remark'=>array("value"=>"啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦啦。","color"=>"#173177")
        );
        D("Worktwo")->senWxTmedMages('oizv4spagfeILyMJHyONUwOnX7J4','1YLw7MPt0VFbHx0eMCCksQVSh--1d8t5tIXrkpCXW3k',$data);
    }
    
    function logsSet(){
        $data = D("Worktwo")->logsSet();
        dump($data);die();
    }
    
}