<?php
namespace Back\Controller;
class LiuController extends BaseController{
	//留言列表
	public function index(){
	    $star = I('star');
	    $end = I('end');
	    $phone = I('phone');
	    if ($star!=0 && $end!=0){$where['time'] = array('between',array($star,$end));}
	    if (!empty($phone)){$where['phone'] = array("eq",$phone);}
	    $where[]="1=1";
	    $Liu=M("liuyan");
	    $num = $Liu->where($where)->count();
	    $page = set_page($num,10);
	    $data['page'] = $page -> Backpage();
	    
	    $list = $Liu->where($where)->order("time desc")->limit($page->limit)->select();
	    $size = count($list);
	    if($size > 0){
	        $data['list'] = $list;
	    }else{
	        $data['list'] = '';
	    }
	    $this->assign("data",$data);
	    $this->display();
	}
	
}