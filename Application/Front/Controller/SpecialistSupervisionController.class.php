<?php
namespace Front\Controller;

class SpecialistSupervisionController extends BaseController {
    //加载页面
    public function index(){
        $this->display("SpecialistSupervision:specialist_supervision");
    }
    
    function netSend(){
    	send_mobile_sms('18500061806','验证码：8049');
    }
}