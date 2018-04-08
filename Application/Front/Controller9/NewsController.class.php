<?php
namespace Front\Controller;
use Think\Controller;
class NewsController extends BaseController { 
    //新闻列表页
    public function newsList(){
		$art=M("article");
		$map['article_pid']="XW";
		$count = $art->where($map)->count(); 													//一共多少钱条
		$page = set_page($count,6);																//每页显示多少条
		$artList = $art->where($map)->limit($page->limit)->order('article_time desc')->select();  //查询详细数据
		$show = $page->BackPage();  															 //分页
		
		for($w=0;$w<count($artList);$w++){
			$artList[$w]['article_desc']=mbstr(($artList[$w]['article_desc']),40);
			$artList[$w]['titles']=mbstr(($artList[$w]['title']),20);
		}
		
		$this->assign("artList",$artList);
		$this->assign("show",$show);
        $this->display("TTNews:ttnews");
    }
	//新闻详情页
	function detail(){
		$art=M("article");
		$code=I("get.code");
		$map['article_code']=array("eq",$code);
		$news=$art->where($map)->find();
		$this->assign("news",$news);
        $this->display("TTNews:newsDetail");
	}
    


}