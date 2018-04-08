<?php
namespace Front\Controller;

class SecurityGuaranteeController extends BaseController {
    //加载页面
    public function index(){
        $ret = M("article") ->where(array('article_code'=>I("code")))->find();
        $this->assign("ret",$ret);
        $this->display("SecurityGuarantee:security_guarantee");
    }
}