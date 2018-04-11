<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=0.7">

<?php if($news['key_words'] != ''): ?><meta name="keywords" content="<?php echo ($news['key_words']); ?>">
<?php else: ?>
 <meta name="keywords" content="轿车托运，轿车运输，异地运车，二手车托运，私家车托运，自驾游托运，越野车托运，全国轿车托运，北京轿车托运，上海轿车托运，深圳轿车托运"><?php endif; ?>

<?php if($news['article_desc'] != ''): ?><meta name="description" content="<?php echo ($news['article_desc']); ?>">
<?php else: ?>
 <meta name="description" content="妥妥运车  汽车托运  轿车托运   汽车托运公司"><?php endif; ?>

<?php if($news['title'] != ''): ?><title><?php echo ($news['title']); ?></title>
<?php else: ?>
 <title>妥妥运车---私家车托运专家</title><?php endif; ?>

<!-- Bootstrap core CSS -->
<link href="/Public/Front/style/bootstrap.css" rel="stylesheet" type="text/css">
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="/Public/Front/style/style.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style1200.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style960.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style768.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style480.css" rel="stylesheet" type="text/css">
<link href="/Public/Front/style/style320.css" rel="stylesheet" type="text/css">

<script src="/Public/Front/js/jquery-1.js"></script>
<script src="/Public/JS/jquerytool_1.0v.js"></script>
<script src="/Public/JS/layer/layer.js"></script>
<script src="/Public/Front/js/bootstrap.js"></script>
<script src="/Public/Front/js/jquery.SuperSlide.js"></script>
<!--百度统计-->
<script>
/* var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?fadb8c3f2b777cb42752d48990106a58";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})(); */
</script>




<body>

<div class="pc header_top">
  <div class="header_top0 container">

  <div class="fss">
	<?php if($UserInfo["login"] == 0): ?><div class="header_top2">
		<span class="login">
			<a  class="deng1" href="/Front/Login/pclogin/">请登录</a>&nbsp;&nbsp;|&nbsp;
			<a  class="deng2" href="/Front/Register/index/">请注册</a>
		</span>
		</div>
	<?php else: ?>
		<div class="header_top1">
			<span>Hi&nbsp;123123<!--<?php echo ($UserInfo['userInfo']['user_name']==""?$UserInfo['userInfo']['tel']:$UserInfo['userInfo']['user_name']); ?>-->&nbsp;</span>
			<h3>
			<a  class="deng3" href="javascript:;">个人中心</a>
			<dl>
				<dt><a href="/Front/Personal/personalInfo">个人资料</a></dt>
				<dt><a href="/Front/MyOrder/index">我的订单</a></dt>
				<dt><a href="/Front/MyCoupon/index">我的优惠券</a></dt>
			</dl>
			</h3>
			<a class="deng4" href="#" onclick="loginout();">退出</a>
		</div>
		<script>
			function loginout(){
				$.post('/Front/Login/logout/',function(data){
						window.location.reload();
				})
			}
		</script><?php endif; ?>
	</div>
  </div>
  <!--<div class="header_top2">
	<p>
		<a  class="te11" ><em>&nbsp;</em><img src="/Public/Front/images/timg.png"></a>
		<a  class="te12" ><em>&nbsp;</em><img src="/Public/Front/images/wskk1.png"></a>
		&lt;!&ndash; <a  class="te13" href="">&nbsp;</a> &ndash;&gt;
		<span>400-877-1107</span>
	</p>

  </div>-->
  </div>
</div>
<script>
	$('.header_top2 a em').click(function(){
		$(this).siblings().show();
	});
	
	$('.header_top2 a img').click(function(){
		$(this).hide();
	});
</script>
<!--logo and nav-->
<nav class="navbar navbar-default">
	<div id="sasa" class="container">
		<div class="head1">
			<a class="navbar-brand0" href="/"><img class="logoimg" src="/Public/Front/images/logo.png"></a>
		</div>
		<a href="/Front/Personal/personalInfo">
		<img class="phone renimg" src="/Public/Front/images/ren.png">
		</a>
		<a href="javascript:volid(0);" data-toggle="collapse" data-target="#sousuok" aria-expanded="false" aria-controls="sousuok">
		<img class="phone sousuoimg" src="/Public/Front/images/sousuo.png">
		</a>
		<a href="javascript:volid(0);" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<img class="phone dhimg" src="/Public/Front/images/sjdh.png" style="width: 6%">
		</a>
		<div id="sousuok" class="phone du3d">
			<input type="text" placeholder="请在此输入订单号" class="cx1" id="keyword" ><!-- onkeyup="sel(this);" --><button onclick="tiaoFun();" type="button"></button>
			<div id="searchBoxs"></div>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<div class="baotio">
				<ul class="nav navbar-nav">
					<li  <?php if(CONTROLLER_NAME == 'Index'): ?>class="active"<?php endif; ?>>
					<h2><a href="/">首页</a></h2>
					</li>

					<li <?php if(CONTROLLER_NAME == 'ProfessionalServices'): ?>class="active"<?php endif; ?>><h2><a  href="javascript:;">妥妥服务</a></h2>
					<dl>
						<div class="fgrr"></div>
						<?php if(is_array($ttfw)): foreach($ttfw as $key=>$vo): ?><dd><a href="/Front/ProfessionalServices/sos/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
						<!-- <dd><a href="/Front/Worklwt/lineDis">长途托运</a></dd> -->
					</dl>
					</li>
					</li>
					<!-- <li id="tt1"><h2><a href="javascript:;">托车优惠</a></h2>
                         <dl>
                          <div class="fgrr"></div>

                          <dd><a href="/Front/Worklwt/lineDisList">优惠线路</a></dd>
                          <dd><a href="/Front/GroupBuy/gotoGroupBuy">团购线路</a></dd>

                         </dl>
                    </li> -->
					</li>
					<li <?php if(CONTROLLER_NAME == 'SecurityGuarantee'): ?>class="active"<?php endif; ?>><h2><a  href="javascript:;">安全保障</a></h2>
					<dl>
						<div class="fgrr"></div>
						<?php if(is_array($aq)): foreach($aq as $key=>$vo): ?><dd><a href="/Front/SecurityGuarantee/index/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>

					</dl>
					</li>
					</li>
					<li  <?php if(CONTROLLER_NAME == 'AboutUs'): ?>class="active"<?php endif; ?>><h2><a  href="javascript:;">关于妥妥</a></h2>
					<dl>
						<div class="fgrr"></div>
						<?php if(is_array($dh)): foreach($dh as $key=>$vo): ?><dd><a href="/Front/AboutUs/index/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>

						<dd><a href="/Front/News/newsList">妥妥新闻</a></dd>
					</dl>
					</li>
					<li><h2><a href="/Front/Ordersel/orderselView">运单查询</a></h2>

					</li>

				</ul>

			</div>
		</div>

	</div>
</nav>
<!--logo and nav-->

<script>
	/* $(document).ready(function(){
		var zong = '<?php echo ($jump["total"]); ?>';
		var bao = '<?php echo ($jump["sprice"]); ?>';
		var yun = '<?php echo ($jump["tprice"]); ?>';
		var ewai = '<?php echo ($jump["eprice"]); ?>';
		if(zong!=''){
			$("#zong").html(zong);
			$("#quickshop").show();
		}
		if(bao!=''){
			$("#secu").html(bao);
		}
		if(yun!=''&&ewai!=''){
			$("#trans").html(parseInt(ewai)/100 + parseInt(yun));
		}
		var zongz = '<?php echo ($jumpz["order"]["total"]); ?>';
		if(zongz!=''){
			$("#zongz").html(zongz);
		}
	}) */

	function ceshi(obj){
		var qsrcz = $("#qsrcz").val();
		if(qsrcz.trim()==""){
			layer.msg("请先选择出发地!");
			//$("#qepz").hide();
			//$("#q5").hide();
			//$("#qecz").hide();
			//$(".selected0").hide();
			return false;
		}else{
			$(obj).siblings(".selected0").show();
		}
	}
</script>
<script src="/Public/JS/indexTuo.js"></script>
<!--banner-->
	<div class="bannersy">
		<div class="bannerdiv">
			<div class="serchimg">
				<div class="tiaofun"  onclick="ddxs('320')">
					<center><font class="tbddfont"><a class="dfontd">订单查询</a></font></center>
				</div>
			</div>
			<div class="xiadan">
				<div class="tiaofun"  onclick="xdxs()">
					<center><font class="tbxdfont"><a class="xfontd">下&nbsp;单</a></font></center>
				</div>
			</div>
			<div class="ksfw">
				<table id="searchtable" class="pc fwtable1">
					<tr>
						<td style="width:40%;">
							<div class="csczz">
								<p>请输入订单号查询当前订单状况，如果当前订单不存在，请联系客服人员。</p>
							</div>
							<div class="du3d" id="tiao1">
								<input type="text" placeholder="请在此输入订单号" class="cx1" id="keyword" ><!-- onkeyup="sel(this);" --><button onclick="tiaoFun();" type="button"></button>
								<div id="searchBoxs"></div>
							</div>
							<div class="phone serchsj" id="tiao2">
								<input type="text" placeholder="请在此输入订单号" class="cx2" id="keyword1" ><!-- onkeyup="sel(this);" --><button onclick="tiaoFun1();" type="button"></button>
								<div id="searchBoxs"></div>
							</div>
						</td>
					</tr>
					<tr class="searchtd">
						<td>
							<div class="xddiv">
								<div class="xdchild"  onclick="tiaoFun1();">
									<center><font class="xddfont"><a>订单查询</a></font></center>
								</div>
							</div>
						</td>
					</tr>
				</table>
				<table id="xdtable">
					<form method="post" action="/Front/Order/normal" id="quickz">
						<div style="display: none">
							<!-- 开始地 -->
							<input type="hidden" name="qsrez" id="qsrez" value="" />
							<!-- 目的地 -->
							<input type="hidden" name="qerez" id="qerez" value="" />
							<!-- 开始地中文名称 -->
							<input type="hidden" name="qsrezname" id="qsrezname" value="" />
							<!-- 目的地中文名称 -->
							<input type="hidden" name="qerezname" id="qerezname" value="" />
							<!-- 车品牌 -->
							<input type="hidden" name="qsctez" id="qsctez" value="" />
							<!-- 车型号 -->
							<input type="hidden" name="qsctcz" id="qsctcz" value="" />
							<!-- 车id -->
							<input type="hidden" name="carids" id="carids" value="" />
							<!-- 运费 -->
							<input type="hidden" name="lineprice" id="lineprice" value="0" />
							<!-- 类型 -->
							<input type="hidden" name="product_type" id="product_type" value="0" />
							<!-- 总费 -->
							<input type="hidden" name="totalz" id="totalz" value="0" />
							<!-- 提车费 -->
							<input type="hidden" name="tiz" id="tiz" value="0" />
							<!-- 送车费 -->
							<input type="hidden" name="songz" id="songz" value="0" />
							<!-- 集散地起点 -->
							<input type="hidden" name="sansz" id="sansz" value="" />
							<!-- 集散地重点 -->
							<input type="hidden" name="sanez" id="sanez" value="" />
							<!-- 提车地id -->
							<input type="hidden" name="tidz" id="tidz" value="" />
							<!-- 送车地id -->
							<input type="hidden" name="sidz" id="sidz" value="" />
							<!-- 毛利 -->
							<input type="hidden" name="maoliz" id="maoliz" value="0" />
							<!-- 普通下单钱数第一部分 -->
							<input type="hidden" name="ptxd1" id="ptxd1" value=0 />
							<!-- 普通下单钱数第二部分 -->
							<input type="hidden" name="ptxd2" id="ptxd2" value=0 />
							<!-- 集散地B地名（汉字） -->
							<input type="hidden" name="ptjsd" id="ptjsd" value='' />
							<!-- 数据是否可用 -->
							<input type="hidden" name="flag" id="flag" value='N' />
							<input type="hidden" name="msg" id="msg" value='N' />
						</div>
					<tr>
						<td colspan="2">
							<font class="ycfont1">妥妥运车</font>&nbsp;&nbsp;&nbsp;<font class="ycfont2">爱车与您同在</font>
						</td>
					</tr>
					<tr>
						<td colspan="2"><font class="ycfont3">Happy every day</font></td>
					</tr>
					<tr class="jiange"></tr>
					<tr>
						<td class="blacktd"><div class="buttonblack1"><font>出发地:</font></div></td>
						<td style="width:45%"><!-- 开始地 -->
							<div class="tab-pay1 top_search2">
								<dl class="dlbottom">
									<dd>
										<input type="text" placeholder="" class="txt1a inko" readonly="readonly" name="qsrcz" id="qsrcz" value="<?php echo ($jumpz['order']['start']); ?>" onclick="ceshi3(this);">
										<span class="xxsj"></span>
										<div class="selected0" id="q4">
											<div class="province star_province" id="qspz">
												<!-- <li data-id="14">请选择</li> -->
												<?php if(is_array($pro)): foreach($pro as $key=>$vo): ?><li data-id="1"  onclick="getCityz('<?php echo ($vo["area_id"]); ?>','S','<?php echo ($vo["area_name"]); ?>')"><?php echo ($vo["area_name"]); ?></li><?php endforeach; endif; ?>
											</div>
											<div class="city star_city" data-id="" style="display:none" id="qscz"></div>
											<div class="county star_county" data-id="" style="display:none" id="qsbz"></div>
										</div>
									</dd>
								</dl>
							</div>
						</td>
					</tr>
					<tr class="jiange"></tr>
					<tr>
						<td><div class="buttonblack1"><font>目的地:</font></div></td>
						<td><!-- 目的地 -->
							<div class="tab-pay1 top_search2">
								<dl class="dlbottom"><dd><input type="text" placeholder="" class="txt1a inko" readonly="readonly" name="qercz" id="qercz" value="<?php echo ($jumpz['order']['end']); ?>" onclick="ceshi(this);">
									<span class="xxsj"></span>
									<div class="selected0" id="q5">
										<div class="province star_province" id="qepz">
											<?php if(is_array($pro)): foreach($pro as $key=>$vo): ?><li data-id="1"  onclick="getCityz('<?php echo ($vo["area_id"]); ?>','E','<?php echo ($vo["area_name"]); ?>')"><?php echo ($vo["area_name"]); ?></li><?php endforeach; endif; ?>
										</div>
										<div class="city star_city" data-id="" id="qecz" style="display:none"></div>
										<!-- <div class="county star_county" data-id=""></div> -->
									</div> </dd></dl>
							</div>
						</td>
					</tr>
					<tr class="jiange"></tr>
					<tr>
						<td><div class="buttonblack1"><font>品牌车系:</font></div></td>
						<td><!-- 车品牌 -->
							<div class="tab-pay1 top_search2">
								<dl class="dlbottom"><dd><input type="text" placeholder="" class="txt1a inko" id="qbtz" name="carInfoz" value="<?php echo ($jumpz['order']['carInfo']); ?>" onkeyup="serchCar(this);" onclick="ceshi3(this);">
									<span class="xxsj"></span>
									<div class="selected0" id="q6">
										<div class="province star_province" id="qbrz">
											<?php if(is_array($brand)): foreach($brand as $key=>$vo): ?><li data-id="1"  onclick="getTypez('<?php echo ($vo["cxjj_id"]); ?>','<?php echo ($vo["cxjj_brand"]); ?>')"><?php echo ($vo["cxjj_name"]); ?>--<?php echo ($vo["cxjj_brand"]); ?></li><?php endforeach; endif; ?>
										</div>
										<div class="city star_city" data-id="" style="display:none" id="qtz"></div>
										<!-- <div class="county star_county" data-id=""></div> -->
									</div> </dd></dl>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="heighttd"></td>
					</tr>
					<tr>
						<td colspan="2">
							<center>
								<font class="moneyfont">费用：&nbsp;￥<bold id="zongz1">0</bold>元</font>
							</center>
						</td>
					</tr>
					<tr style="height:50px;">
						<td colspan="2">
							<div class="xddiv">
								<div class="xdchild"  onclick="goOrder();">
									<center><font class="xddfont"><a>立即下单</a></font></center>
								</div>
							</div>
						</td>
					</tr>
					</form>
				</table>
			</div>
		</div>
		<div class="pc bannerdiv1">
			<div class="yuan1" onmouseover="yuan1()" ></div>
			<div class="yuan2" onmouseover="yuan2()" ></div>
		</div>
		<div class="phone bannerdiv1">
			<div class="yuan1" onmouseover="yuansj1()" ></div>
			<div class="yuan2" onmouseover="yuansj2()" ></div>
		</div>
		<div class="pc bannerdiv2">
			<img src="/Public/Front/images/zhishijiantou.png">
		</div>
		<div class="bannerdiv3">
			<center><strong><span style="font-size:28px;">关注我们</span></strong></center>
			<img src="/Public/Front/images/wskk1.jpg">
		</div>
		<img class="pc bannerimg" src="/Public/Front/images/BANNER.png">
		<img class="phone bannerimg" src="/Public/Front/images/bannersj.png">
	</div>
<!--content-->
<div class="part1" style="width: 100%">
	<img class="pc" src="/Public/Front/images/HEARTONFIRE2.png"  style="width: 100%">
	<img class="phone" src="/Public/Front/images/qiche.png"  style="width: 100%">
	<div class="fwfont fwfontx">
		<font><strong>流程展示</strong></font>
		<h3>Process display</h3>
		<img src="/Public/Front/images/Rectangle.png">
	</div>
	<div style="text-align: center;">
		<img class="pc" src="/Public/Front/images/HEARTONFIRE1.png" style="width: 90%;margin-left: 5%;">
		<img class="phone" src="/Public/Front/images/liucheng.png" style="width: 80%;margin-left: 10%;">
	</div>
</div>
<div class="part8">
	  <div class="part8left">
		  <img style="width:100%" src="/Public/Front/images/gongsijieshao.png">
		  <div class="gsjsfont">
			  <div class="fwfont gslc">
				  <font>妥妥运车&nbsp;<strong><span class="jsbzfont">公司介绍</span></strong></font>
				  <h3>Company introduction</h3>
			  </div>
			  <div class="xddiv xddivxg">
				  <div class="xdchild">
					  <center><font class="xddfont"><a href="/Front/AboutUs/index/code/AC14920644586W3N">详情</a></font></center>
				  </div>
			  </div>
		  </div>
	  </div>
	  <div class="part8right">
		  <img style="width:100%" src="/Public/Front/images/fuwubaozhang.png">
		  <div class="fwbzfont">
			  <div class="fwfont gslc">
				  <font>妥妥运车&nbsp;<strong><span class="jsbzfont">服务保障</span></strong></font>
				  <h3>Service guarantee</h3>
			  </div>
			  <div class="xddiv xddivxg">
				  <div class="xdchild">
					  <center><font class="xddfont"><a href="/Front/AboutUs/index/code/AC14920644902AGS">更多</a></font></center>
				  </div>
			  </div>
		  </div>
	  </div>
</div>

<div class="ttxw">
	<img class="pc" src="/Public/Front/images/HEARTONFIRE2.png"  style="width: 100%">
	<img class="phone" src="/Public/Front/images/qiche.png"  style="width: 100%">
	<div class="fwfont fwfontx">
		<font><strong>妥妥新闻</strong></font>
		<h3>Proper news</h3>
		<img src="/Public/Front/images/Rectangle.png">
	</div>
	<div class="container">
		<div class="iske1">
			<div class="iske2">
				<table class="xwtable">
					<tr>
						<td class="xdtd1">
							<div class="td1div">
								<img class="pc" src="/Public/Front/images/neirongtu.png">
								<img class="phone nrsj" src="/Public/Front/images/neirongtusj.png">
							</div>
							<div class="xddiv1">
								<font><?php echo ($artList["0"]["title"]); ?></font>
							</div>
							<div class="xddiv2">
								<font><?php echo ($artList["0"]["article_time"]); ?></font>
							</div>
							<div class="xddiv3">
								<font><?php echo ($artList["0"]["article_desc"]); ?></font>
							</div>
							<div class="xddiv4">
								<div class="more">
									<div class="morechild">
										<center><font class="morefont"><a href="/Front/News/detail/code/<?php echo ($artList["0"]["article_code"]); ?>">MORE</a></font></center>
									</div>
								</div>
							</div>
						</td>
						<td class="xdtd1 xdleft">
							<div class="td1div">
								<img class="pc" src="/Public/Front/images/neirongtu1.png">
								<img class="phone nrsj" src="/Public/Front/images/neirongtusj1.png">
							</div>
							<div class="xddiv1">
								<font><?php echo ($artList["1"]["title"]); ?></font>
							</div>
							<div class="xddiv2">
								<font><?php echo ($artList["1"]["article_time"]); ?></font>
							</div>
							<div class="xddiv3">
								<font><?php echo ($artList["1"]["article_desc"]); ?></font>
							</div>
							<div class="xddiv4">
								<div class="more">
									<div class="morechild">
										<center><font class="morefont"><a href="/Front/News/detail/code/<?php echo ($artList["1"]["article_code"]); ?>">MORE</a></font></center>
									</div>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="iske7">
				<h2><span>FAQ </span> 常见问题</h2>
				<ul>
					<?php if(is_array($cj)): foreach($cj as $k=>$vo): if($k < 7): ?><li><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><p><?php echo ($k+1); ?>、<?php echo ($vo["title"]); ?></p></a></li><?php endif; endforeach; endif; ?>
				</ul>
				<div style="margin-top: 50px;">
					<div class="more moreques">
						<div class="morechild">
							<center><font class="morefont"><a href="/Front/Footer/detail/code/AC14920671855R3B">MORE</a></font></center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="padding-bottom: 64px;" class="part61 container">
  <div class="fwfont" style="margin-bottom: 56px;">
	  <center><font><strong>合作伙伴</strong></font>
	  <h3>Cooperation</h3></center>
	  <img src="/Public/Front/images/xhx.png" style="margin-top: 10px;width: 100%;">
  </div>
   <ul class="hzul">
   <?php if(is_array($linkList)): foreach($linkList as $k=>$vo): ?><li><a href="<?php echo ($vo["fl_link"]); ?>" target="_blank">
   <img  class="nb1"  src="<?php echo ($vo["fl_img"]); ?>">
   <img  class="nb2"  src="<?php echo ($vo["fl_img1"]); ?>">
   </a></li><?php endforeach; endif; ?>
   <!--<li><a href=""><img src="/Public/Front/images/logo2.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo3.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo4.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo5.png"></a></li>
   <li><a href=""><img src="/Public/Front/images/logo6.png"></a></li>-->
   </ul>
</div>
<script>
	var navtime = 0;
	var type = 2;
	function yuan1(){
		$(".yuan1").attr("style","background: #ff8000; border: 1px solid #ffffff;");
		$(".yuan2").attr("style","background: #ffffff;border: 1px solid #ff8000;");
		$(".bannerimg").attr("src","/Public/Front/images/BANNER.png");
		$(".bannerdiv").attr("style","left:50%");
		$(".bannerdiv2, .bannerdiv3").hide();
		navtime = 0;
		type = 2;
	}
	function yuan2(){
		$(".yuan1").attr("style","background: #ffffff;border: 1px solid #ff8000;");
		$(".yuan2").attr("style","background: #ff8000; border: 1px solid #ffffff;");
		$(".bannerimg").attr("src","/Public/Front/images/banner1.png");
		$(".bannerdiv").attr("style","margin-left:-35%;");
		$(".bannerdiv2, .bannerdiv3").show();
		navtime = 0;
		type = 1;
	}
	function timejia(){
		navtime++;
	}
	setInterval(function(){
		timejia();
		if(navtime == 5){
			//window['yuan'+type]();
		}
	},3000);

	function yuansj1(){
		$(".yuan1").attr("style","background: #ff8000; border: 1px solid #ffffff;");
		$(".yuan2").attr("style","background: #ffffff;border: 1px solid #ff8000;");
		$(".bannerimg").attr("src","/Public/Front/images/bannersj.png");
		window.navtimesj = 0;
		window.typesj = 2;
	}
	function yuansj2(){
		$(".yuan1").attr("style","background: #ffffff;border: 1px solid #ff8000;");
		$(".yuan2").attr("style","background: #ff8000; border: 1px solid #ffffff;");
		$(".bannerimg").attr("src","/Public/Front/images/BANNER.png");
		window.navtimesj = 0;
		window.typesj = 1;
	}
	function timejiasj(){
		window.navtimesj++;
	}
	setInterval(function(){
		timejiasj();
		if(window.navtimesj == 2){
			window['yuansj'+typesj]();
		}
	},3000);

	function ddxs(){
		$(".xiadan").attr("style","background:url(/Public/Front/images/xiadanf.png) left top no-repeat");
		$(".serchimg").attr("style","background:url(/Public/Front/images/dingdanchaxunb.png) right top no-repeat");
	    $("#searchtable").show();
	    $("#xdtable").hide();
	    $(".dfontd").attr("style","color:#ff8000");
	    $(".xfontd").attr("style","color:#FFFFFF");
	}
    function xdxs(){
        $(".xiadan").attr("style","background:url(/Public/Front/images/xiadanb.png) left top no-repeat");
        $(".serchimg").attr("style","background:url(/Public/Front/images/dingdanchaxun.png) right top no-repeat");
        $("#searchtable").hide();
        $("#xdtable").show();
        $(".dfontd").attr("style","color:#FFFFFF")
        $(".xfontd").attr("style","color:#ff8000")
    }
	function tiaoFun(){
		var keyword = $("#keyword").val();
		if(keyword==""){
			layer.msg("请输入订单号");
			return false;
		}
		window.location.href="/Front/Ordersel/orderselView/status/2/keyword/"+keyword;
	}
    function tiaoFun1(){
        var keyword = $("#keyword1").val();
        if(keyword==""){
            layer.msg("请输入订单号");
            return false;
        }
        window.location.href="/Front/Ordersel/orderselView/status/2/keyword/"+keyword;
    }
	$('.aske1 ul li').click(function(){
		$(this).addClass('on').siblings().removeClass('on');
		$('.tab-cont1 .tab-pay1').eq($(this).index()).fadeIn(300).siblings().hide();
	});
</script>
<!--content-->
<!--footer-->
   	<div class="footer-box">
	<div class="footer-box1">
	<div class="container">
       <div class="dnn0">
			 <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">妥妥运车</a></h2>
                    <dl>
				<?php if(is_array($tuoList)): foreach($tuoList as $k=>$vo): if($vo["title"] == '我要运车'): ?><dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Order/normal"><?php echo ($vo["title"]); ?></a></dd>
					<?php else: ?>
						<dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endif; endforeach; endif; ?>
					 <!--<dd><a href="">企业运车</a></dd>
					 <dd><a href="">时效查询</a></dd>
					 <dd><a href="">服务网点</a></dd>-->

					</dl>
                    </div>
            </div>
			<!-- <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">服务产品</a></h2>
                    <dl>
				<?php if(is_array($serviceList)): foreach($serviceList as $k=>$vo): ?><dd><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>

					</dl>
                    </div>
            </div>-->
			 <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">帮助中心</a></h2>
                    <dl>
				<?php if(is_array($helpList)): foreach($helpList as $k=>$vo): ?><dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
					</dl>
                    </div>
            </div>

			 <div class="col-sm-6 col-md-2 jkl1">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">支付方式</a></h2>
                    <dl>
				<?php if(is_array($payList)): foreach($payList as $k=>$vo): ?><dd><span><img src="/Public/Front/images/dddd.png">&nbsp;&nbsp;</span><a href="/Front/Footer/detail/code/<?php echo ($vo["article_code"]); ?>"><?php echo ($vo["title"]); ?></a></dd><?php endforeach; endif; ?>
					</dl>
                    </div>
            </div>
			 <div class="col-sm-6 col-md-2 jkl1 jkl1b">
            	 	<div class="dnn1">
					<h2><a href="javascript:;">关于妥妥</a></h2>
                    <dl>
						<dd>妥妥运车，运车妥妥，微笑服务，专注服务。</dd>
						<dd><span><img src="/Public/Front/images/jtphoto.png">&nbsp;&nbsp;</span>机场东路翼之城4号楼</dd>
						<dd><span><img src="/Public/Front/images/xfphoto.png">&nbsp;&nbsp;</span>postmaster@tuotuoyunche.com</dd>
						<dd><span><img src="/Public/Front/images/tell.png">&nbsp;&nbsp;</span>400-877-1107</dd>
					</dl>
                    </div>
            </div>
		   <div class="col-sm-6 col-md-2 jkl1 jkl1c">
			   <img src="/Public/Front/images/shx.png">
		   </div>
		   <div class="col-sm-6 col-md-2 jkl1 jkl1a">

			   <div class="dnn1  ffdsf">
				   <span class="pc">关注我们<br><br></span>
				   <h2 class="phone">关注我们</h2>
				   <div class="hoof2">
					   <div class="bdsharebuttonbox">
						   <img style="width:158px;height:158px;" src="/Public/Front/images/wskk1.jpg">
						   <div class="hoof2">
							   <div class="bdsharebuttonbox"><a title="分享到新浪微博" href="#" class="bds_tsina te11" data-cmd="tsina"></a>
								   <a title="分享到QQ好友" href="#" class="bds_sqq te12" data-cmd="sqq"></a>
								   <a title="分享到微信" href="#" class="bds_weixin te13" data-cmd="weixin"></a>
							   </div>
						   </div>
					   </div>


  </div>

                    </div>
            </div>
         </div>

            </div>
			<div class="fooh1">
			  <div class="fooh2 container">
			  <div class="fooh21">
			   <p><span>©2016 安达承运物流 京ICP备16022345号-1</span></p>
			   </div>

			   </div>
			</div>
        </div>


    </div>
<div class="phone xin1">
	<ul>
		<li style="width:50%;"><a href="tel:4008771107"><h2>电话咨询</h2></a></li>
		<!--<li><a target="_blank" href="http://p.qiao.baidu.com/cps/chat?siteId=10022073&userId=20439003"><h2>在线咨询</h2></a></li>0-->
		<li class="xin4" style="width:50%;"><h2>在线留言</h2></li>
	</ul>
</div>
<div class="phone xin2"> 
	<div class="xin3">
		<div class="xin6">
			<a><img src="/Public/Front/images/xin6.png"/></a>
		</div>
	
		<h3>在线留言</h3>
		<dl>
			<h2>您的电话：</h2>
			<input type="text" id="phone" name="" value="" placeholder="电话">
		</dl>
		<dl>
			<h2>您的需求：</h2>
			<textarea id="cont" name="" placeholder="需求信息"></textarea>
		</dl>
		
		<button type="submit" id="zixun">确定</button>
		
	</div>
</div>
<!-- <div class="xin5">
	<h2>感谢您的信任，请保持工作日电话畅通。</h2>
</div> -->
<!-- 留言框 -->
<script>
	$(".xin4").click(function(){
		$(".xin2").show();
	});
	/* $(".xin3 button").click(function(){
		layer.msg('感谢您的信任，请保持工作日电话畅通。');
	}); */
	$(".xin6").click(function(){
		$(".xin2").hide();
	});
	$("#zixun").click(function(){
		var phone=$("#phone").val();
		var content=$("#cont").val();
		if(phone == ''){
			layer.msg('手机号不能为空！');
			return false;
		}
		if(content == ''){
			layer.msg('内容不能为空！');
			return false;
		}
		var reg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[6789]|18[0-9]|14[57])[0-9]{8}$/;
		var r = phone.match(reg);
		if(r==null){
			layer.msg('手机号格式不对！');
			return false;
		}
		$.post("/Front/Liu/add",{phone:phone,content:content},function(data){
			if(data.status == 'Y'){
				layer.msg('感谢您的信任，请保持工作日电话畅通。');
				$(".xin2").hide();
			}else{
				layer.msg('咨询失败，我们正在处理！');
			}
		})
		
	})
</script> 
  <script>
  $(".qqr01 ul li").click(function(){
	  $(this).addClass("on").siblings().removeClass('on');
	  var tt=$(this).index();
	  $(".part13  .part3b").eq(tt).show().siblings().hide();


	  });




 	    $(".inko").click(function(){
	  $(this).siblings(".selected").show();
	  //$(this).siblings(".selected0").show();

	  });
	      $(".xiandan").click(function(){
$(".korder0").animate({width:"100%"});

	  });
	      $(".close2").click(function(){
	    	  $(".korder0").animate({width:"0%"});

	    	  });




	   $(".selected li").click(function(){
	  $(this).parent().parent().hide();
	   var oop= $(this).html();
	  $(this).parent().parent().siblings('.inko').val(oop);

	  });


	    $(".mess1 p").click(function(){
	  $(this).parent().parent().hide();

	  });
	    $('.xiandan').hide();
	    $(function(){
	    	$(window).scroll(function() {
	    		if($(window).scrollTop() >= 400){
	    			$('.xiandan').fadeIn(300);
	    		}else{
	    			$('.xiandan').fadeOut(300);
	    		}
	    	});

	    });

	    function ceshi3(obj){
	    	$(obj).siblings(".selected0").show();
	    }





  </script>


<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>


<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?fadb8c3f2b777cb42752d48990106a58";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>











<!--footer-->

</body></html>