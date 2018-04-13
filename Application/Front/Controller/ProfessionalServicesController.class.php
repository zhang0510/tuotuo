<?php
namespace Front\Controller;

class ProfessionalServicesController extends BaseController {
    //加载页面
    public function index(){
        $this->display("ProfessionalServices:professional_services");
    }
    /* public function liucheng(){
        $this->display("ProfessionalServices:liucheng");
    } */
    public function sos(){
        $ret = M("article") ->where(array('article_code'=>I("code")))->find();
        $this->assign("ret",$ret);
        $this->display("ProfessionalServices:sos");
    }
    public function fuwu(){
        $this->display("ProfessionalServices:fuwu");
    }
    public function baozhang(){
        $this->display("ProfessionalServices:baozhang");
    }
}