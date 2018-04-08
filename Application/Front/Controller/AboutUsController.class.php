<?php
namespace Front\Controller;

class AboutUsController extends BaseController {
    //加载页面
    public function index(){
        $ret = M("article") ->where(array('article_code'=>I("code")))->find();
        $this->assign("ret",$ret);
        $this->display("AboutUs:about_us");
    }
    public function nian(){
        $this->display("AboutUs:nian");
    }
    public function fuwu(){
        $this->display("AboutUs:fuwu");
    }
    public function baozhang(){
        $this->display("AboutUs:baozhang");
    }

}