<?php
namespace Front\Controller;

class LiuController extends BaseController {
    //添加留言
    public function add(){
        $phone = I("phone");
        $content = I("content");
        $Liu=M("liuyan");
        $data['phone'] = $phone;
        $data['content'] = $content;
        $data['time'] = date("Y-m-d H:i:s",time());
        $res = $Liu -> add($data);
        if($res){
            $re['status'] = 'Y';
        }else{
            $re['status'] = 'N';
        }
        $this->ajaxReturn($re);
    } 
}