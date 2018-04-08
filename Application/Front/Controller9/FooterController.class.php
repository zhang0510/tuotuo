<?php
namespace Front\Controller;
use Think\Controller;
class FooterController extends BaseController { 
    //个人信息
    public function footer(){
		$art=M("article");
	/*  妥妥*/
		$map2['article_pid']="GY";
		$tuoList=$art->where($map2)->select();

	/*  服务 */
		$map3['article_pid']="LX";
		$serviceList=$art->where($map3)->select();
	/*  帮助 */
		$map4['article_pid']="JR";
		$helpList=$art->where($map4)->select();
	/*  配送 */
		$map5['article_pid']="QQ";
		$patchList=$art->where($map5)->select();
	/*  支付 */
		$map6['article_pid']="FK";
		$payList=$art->where($map6)->select();
	/*  关于 */
		$map7['article_pid']="BZ";
		$aboutList=$art->where($map7)->select();
		
       	$this->assign("tuoList",$tuoList);
		$this->assign("serviceList",$serviceList);
		$this->assign("helpList",$helpList);
		$this->assign("patchList",$patchList);
		$this->assign("payList",$payList);
		$this->assign("aboutList",$aboutList);
		$this->display("Public:foot");
	}
	
	function detail(){
		$code=I("get.code");
		$art=M("article");
		$map['article_code']=array("eq",$code);
		$artDetail=$art->where($map)->find();
		 $this->assign("artDetail",$artDetail);
		 $this->display("Footer:detail");
	}
	
}