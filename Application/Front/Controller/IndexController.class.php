<?php
namespace Front\Controller;

class IndexController extends BaseObjController {

    //PC登录
    public function index(){
    	$this->display("Login:login");
    }

    function moban(){
        $this->display("HomePage:moban");
    }

    /**
     * 首页
     */
    function homePage(){
        $source = I("get.source");
        session('user_source',$source);
        $jump = session('jump')==""||session('jump')==null?"":session('jump');
        $jumpz = session('jumpz')==""||session('jumpz')==null?"":session('jumpz');
        $this -> assign('jump',$jump['order']);
        $this -> assign('jumpz',$jumpz);
        $pro = get_province();
        $brand = get_brand();
	    /* 父ID 妥妥：GY 新闻：XW 服务：FX 帮助：JR 配送：QQ 支付：FK  关于：BZ */
	    /* 新闻 */
		$art=M("article");
		$map1['article_pid']="XW";
		$map1['article_img'] = array('neq','');
		$artList=$art->field('article_id,article_code,title,article_img,article_time,article_desc')->where($map1)->order("article_time desc")->limit(2)->select();
		//$map3['article_pid']="XW";
		//$map3['article_id'] = array('not in',array($artList[0]['article_id'],$artList[1]['article_id']));
		//$artList2=$art->where($map3)->order("article_time desc")->limit(3)->select();
		for($w=0;$w<count($artList);$w++){
			$artList[$w]['article_desc']=mbstr(($artList[$w]['article_desc']),25);
			$artList[$w]['titles']=mbstr(($artList[$w]['title']),20);
			$artList[$w]['article_time']=date('Y-m-d H:i',strtotime($artList[$w]['article_time']));
		}
		/* 常见问题 */
		$map5['article_pid']="CJ";
		$cj=$art->field('article_id,article_code,title')->where($map5)->order("article_time desc")->limit(10)->select();
		/* 妥妥服务 */
		//$map6['article_pid']="TTFW";
		//$ttfws=$art->where($map6)->order("article_id asc")->limit(6)->select();
	    /* 	友情链接 */
		$link=M("link");
		$map2['fl_status']="Y";
		$linkList=$link->where($map2)->order("fl_sort")->limit(6)->select();
	    /* 首页banner图 */
		$aiObj = M("adv_img");
        $map['adv_code'] = array('eq',"A");
        $banner = $aiObj->where($map)->select();

		$this->assign('cj',$cj);
		//$this->assign("ttfws",$ttfws);
		$this->assign("linkList",$linkList);
		$this->assign("artList",$artList);
		//$this->assign("artList2",$artList2);
        $this->assign("pro",$pro);
        $this->assign("brand",$brand);
        $this->assign("banner",$banner);
    	$this->display("HomePage:home_page");
    }

    //手机动态码登录
    public function mobileLogin(){
        $this->display("MobileLogin:mobile_login");
    }

    //确定发车
    public function confirmDeparture(){
        $this->display("ConfirmDeparture:confirm_departure");
    }

    //详细地址
    public function detailedAddress(){
        $this->display("DetailedAddress:detailed_address");
    }

    //我要发车
    public function iStart(){
        $this->display("IStart:i_start");
    }

    //我的订单
    public function myOrder(){
        $this->display("MyOrder:my_order");
    }

    //个人信息
    public function personalInformation(){
        $this->display("PersonalInformation:personal_information");
    }

    //注册
    public function register(){
        $this->display("Register:register");
    }

    //订单详情
    public function OrderDetail(){
        $this->display("OrderDetail:order_detail");
    }

    //我的优惠券
    public function MyCoupon(){
        $this->display("MyCoupon:my_coupon");
    }

    //运单查询
    public function WaybillQuery(){
        $this->display("WaybillQuery:waybill_query");
    }

    //支付信息
    public function PaymentInformation(){
        $this->display("PaymentInformation:payment_information");
    }

    //优惠线路
    public function PreferentialLine(){
        $this->display("PreferentialLine:preferential_line");
    }

    //新闻终端
    public function NewsTerminal(){
        $this->display("NewsTerminal:news_terminal");
    }

    //妥妥新闻
    public function TTNews(){
        $this->display("TTNews:ttnews");
    }

    //团购线路
    public function BuyLine(){
        $this->display("BuyLine:buy_line");
    }

    //关于我们
    public function AboutUs(){
        $this->display("AboutUs:about_us");
    }

    /**
     * 获取城市
     * @date: 2016-9-4 下午4:01:35
     * @author: liuxin
     */
    public function getCity(){
		print_log("---------------获取城市区域信息--------");
        $pid = I('post.pid');
        $obj = D('Index');
        $data = $obj -> getCity($pid);
		print_log("获取城市信息：".json_encode($data));
        $this -> ajaxReturn($data);
    }
    /**
     * 获取市区
     * @date: 2016-9-4 下午4:01:35
     * @author: liuxin
     */
    public function getBlock(){
        $pid = I('post.pid');
        $obj = D('Index');
        $data = $obj -> getBlock($pid);
        $this -> ajaxReturn($data);
    }
    /**
     * 查询拖车费
     * @date: 2016-9-4 下午6:07:57
     * @author: liuxin
     */
    public function queryPrice(){
        $start = I('post.start');
        $end = I('post.end');
        $obj = D('Index');
        $data = $obj -> queryPrice($start,$end);
        $this -> ajaxReturn($data);
    }
    /**
     * 获取车辆型号
     * @date: 2016-9-5 上午10:30:08
     * @author: liuxin
     */
    public function getType(){
        $pid = I('post.pid');
        $obj = D('Index');
        $data = $obj -> getType($pid);
		print_log("-------------".json_encode($data));
        $this -> ajaxReturn($data);
    }
    /**
     * 获取车辆型号
     * @date: 2016-9-5 上午10:30:08
     * @author: liuxin
     */
    public function getTypeSerch(){
        $name = I('post.name');
        $obj = D('Index');
        $data = $obj -> getTypeSerch($name);
        print_log("-------------".json_encode($data));
        $this -> ajaxReturn($data);
    }
    /**
     * 计算保险费用
     * @date: 2016-9-5 上午11:52:48
     * @author: liuxin
     */
    public function getSecu(){
        $price = I('post.price');
        $obj = D('Index');
        $data = $obj -> getSecu($price);
        $this -> ajaxReturn($data);
    }
    public function getTi(){
        $ti = I('post.start');
        $obj = D('Index');
        $data = $obj -> getTi($ti);
        $this -> ajaxReturn($data);
    }
    public function getSong(){
        $song = I('post.end');
        $obj = D('Index');
        $data = $obj -> getSong($song);
        $this -> ajaxReturn($data);
    }
    public function getSan(){
        $st = I('post.start');
        $end = I('post.end');
        $obj = D('Index');
        $data = $obj -> getSan($st,$end);
        $this -> ajaxReturn($data);
    }
    public function getMaoli(){
        $spro = I('spro');
        $epro = I('epro');
        $obj = D('index');
        $data = $obj -> getMaoli($spro,$epro);
        $this -> ajaxReturn($data);
    }
    //安全保障
    public function SecurityGuarantee(){
        $this->display("SecurityGuarantee:security_guarantee");
    }

    //专业服务
    public function ProfessionalServices(){
        $this->display("ProfessionalServices:professional_services");
    }

    //专人监管
    public function SpecialistSupervision(){
        $this->display("SpecialistSupervision:specialist_supervision");
    }
    
    public function getSanCn(){
        $name = I('post.end');
        $obj = D('index');
        $data = $obj -> getSanCn($name);
        $this -> ajaxReturn($data);
    }
    
    /**
     * -----------------------------------------二期---------------------------
     */
    /**
     * 下单第一步，判断&&价格
     */
    public function getLine(){
        $this->ajaxReturn(D('Worktwo')->getPrice(I("str"),I("end"),I("carid")));
    }

}