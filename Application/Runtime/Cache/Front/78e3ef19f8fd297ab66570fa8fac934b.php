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

<div class="header_top">
  <div class="header_top0 container">
  <div class="header_top2">
  <div class="fss">
	<?php if($UserInfo["login"] == 0): ?><span style="color: #000000;">Hi 欢迎来到妥妥运车 </span>
		<span class="login">
			<a  class="deng1" href="/Front/Login/pclogin/">请登录</a>&nbsp;&nbsp;|&nbsp;
			<a  class="deng2" href="/Front/Register/index/">请注册</a>
		</span>
	<?php else: ?>
		<span>Hi&nbsp;<?php echo ($UserInfo['userInfo']['user_name']==""?$UserInfo['userInfo']['tel']:$UserInfo['userInfo']['user_name']); ?>&nbsp;</span>
		<h3>
		<a  class="deng3" href="javascript:;">个人中心</a>
		<dl>
			<dt><a href="/Front/Personal/personalInfo">个人资料</a></dt>
			<dt><a href="/Front/MyOrder/index">我的订单</a></dt>
			<dt><a href="/Front/MyCoupon/index">我的优惠券</a></dt>
			
		</dl>
		</h3>
		<a class="deng4" href="#" onclick="loginout();">退出</a>
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
		<div class="head1"><a class="navbar-brand0" href="/"><img src="/Public/Front/images/logo.png"></a></div>

		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
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

<!--content-->
<div class="order_body">
<div class="order_main container">
  <div class="order_h2"><h2>订单列表</h2></div>
<div class="order_list">

	<?php if(is_array($oList)): foreach($oList as $key=>$vo): ?><div  class="mlist">
     <div  class="mlista">
	 <h2><a>订单号：<?php echo ($vo["order_code"]); ?></a></h2>
	 			<div class="order_lisa2">
			<div class="olist1"><?php if(($vo["start_name"] != '') and ($vo["start_name"] != null)): echo ($vo["start_name"]); else: ?>--<?php endif; ?> <img class="eq1" src="/Public/Front/images/ee1.png"><img  class="eq2" src="/Public/Front/images/ee2.png"> <?php if(($vo["end_name"] != '') and ($vo["end_name"] != null)): echo ($vo["end_name"]); else: ?>--<?php endif; ?></div>
			<div class="olist2">
				<p><span>车型：<?php if(($vo["order_info_type"] != '') and ($vo["order_info_type"] != null)): echo ($vo["order_info_type"]); else: ?>--<?php endif; ?></span></p>
			</div>
		</div>
	    <div class="mlista2">
		 <h2 class="xinh2">跟踪信息</h2>
		 <dl>
		 	<?php if(is_array($vo["posit"])): $i = 0; $__LIST__ = $vo["posit"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voi): $mod = ($i % 2 );++$i; if($key == 0): ?><dt class="on"><?php echo (date('Y年m月d日',strtotime($voi["time"]))); ?>   <?php echo ($voi["content"]); ?></dt>
		 		<?php else: ?>
		 		<dt class=""><?php echo (date('Y年m月d日',strtotime($voi["time"]))); ?>   <?php echo ($voi["content"]); ?></dt><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		  <div class="bkl1"></div>
		  <div class="bkl2"></div>
		 </dl>
		</div>
	 
	 </div>
     <div  class="mlistb">
	    <div  class="mlistb1">	<p>订单状态：
			<a>
				<?php if(($vo["order_status"] == 'S')): ?>待审核
				<?php elseif(($vo["order_status"] == 'A')): ?>
				 待安排
				<?php elseif(($vo["order_status"] == 'Z')): ?>
				 待核实
				 <?php elseif(($vo["order_status"] == 'Y') OR ($vo["order_status"] == 'M') OR ($vo["order_status"] == 'N') OR ($vo["order_status"] == 'B') OR ($vo["order_status"] == 'G') OR ($vo["order_status"] == 'D')): ?>
				 运输中
				 <?php elseif(($vo["order_status"] == 'W')): ?>
				 已完成
				 <?php else: ?> 
				--<?php endif; ?>
			</a>
			</p></div>
			  <div  class="mlistb2">
				  <p>
				  	<a href="/Front/MyOrder/orderInfo/orderCode/<?php echo ($vo["order_code"]); ?>">订单详情</a>
				  	<?php if(($vo["order_status"] == 'T') OR ($vo["order_status"] == 'Y') OR ($vo["order_status"] == 'M') OR ($vo["order_status"] == 'N') OR ($vo["order_status"] == 'B') OR ($vo["order_status"] == 'G') OR ($vo["order_status"] == 'D') OR ($vo["order_status"] == 'W')): ?><a class="bmm1" href="/Front/PdfPrint/pdf_sqwts/order_code/<?php echo ($vo["order_code"]); ?>">委托书 </a>
					<?php else: ?>
						<a class="bmm1" href="/Front/PdfPrint/pdf_sqwts/order_code/<?php echo ($vo["order_code"]); ?>/status/N">委托书 </a><?php endif; ?>
					<?php if(($vo["order_status"] == 'A') OR ($vo["order_status"] == 'T') OR ($vo["order_status"] == 'Y') OR ($vo["order_status"] == 'M') OR ($vo["order_status"] == 'N') OR ($vo["order_status"] == 'B') OR ($vo["order_status"] == 'G') OR ($vo["order_status"] == 'D') OR ($vo["order_status"] == 'W')): ?><a class="bmm1" href="/Front/PdfPrint/pdf_fwhtd/order_code/<?php echo ($vo["order_code"]); ?>">运输协议(合同)</a>
					<?php else: ?>
						<a class="bmm1" href="/Front/PdfPrint/pdf_fwhtd/order_code/<?php echo ($vo["order_code"]); ?>/status/N">运输协议(合同)</a><?php endif; ?>
				  </p>
			  </div>
			 </div>
  
  		</div>
	
<!-- 	
	<div class="order_lisa">
		<div class="order_lisa1">
			<h2><a>订单号：<?php echo ($vo["order_code"]); ?></a></h2>
			<p>订单状态：
			<a>
				<?php if(($vo["order_status"] == 'S')): ?>待审核
				<?php elseif(($vo["order_status"] == 'A')): ?>
				 待安排
				<?php elseif(($vo["order_status"] == 'Z')): ?>
				 待核实
				 <?php elseif(($vo["order_status"] == 'Y') OR ($vo["order_status"] == 'M') OR ($vo["order_status"] == 'N') OR ($vo["order_status"] == 'B') OR ($vo["order_status"] == 'G') OR ($vo["order_status"] == 'D')): ?>
				 运输中
				 <?php elseif(($vo["order_status"] == 'W')): ?>
				 已完成
				 <?php else: ?> 
				--<?php endif; ?>
			</a>
			</p>
		</div>
		<div class="order_lisa2">
			<div class="olist1"><?php if(($vo["start_name"] != '') and ($vo["start_name"] != null)): echo ($vo["start_name"]); else: ?>--<?php endif; ?> <img class="eq1" src="/Public/Front/images/ee1.png"><img  class="eq2" src="/Public/Front/images/ee2.png"> <?php if(($vo["end_name"] != '') and ($vo["end_name"] != null)): echo ($vo["end_name"]); else: ?>--<?php endif; ?></div>
			<div class="olist2">
				<p><span>车型：<?php if(($vo["order_info_type"] != '') and ($vo["order_info_type"] != null)): echo ($vo["order_info_type"]); else: ?>--<?php endif; ?></span></p>
			</div>
		</div>
		<div class="conts">
			<!-- <a href=""><h2>去付款 </h2></a> -->
<!-- 			<a href="/Front/MyOrder/orderInfo/orderCode/<?php echo ($vo["order_code"]); ?>"><h3>订单详情</h3></a>
		</div>
	</div> --><?php endforeach; endif; ?>
	
</div>

	<div class="num">
		<?php if($num > 0 ): echo ($show); endif; ?>
		
	</div>
</div>
 </div> 
<!--content-->
<script>
	function pay(code,total,bxd,smsc_car){
		var str="";
		if(smsc_car!=""){
			str += "/smsc_car/"+smsc_car;
		}
		window.location.href = '/Front/MyOrder/payNow/code/'+code+'/fee/'+total+'/bxd/'+bxd+str;
	}
</script>
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
				<div class="col-sm-6 col-md-2 jkl1" style="width: 27%;">
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
				<div class="col-sm-6 col-md-2 jkl1" style="width:1px;padding-top: 85px;margin-left: 20px;">
					<img src="/Public/Front/images/shx.png">
				</div>
				<div class="col-sm-6 col-md-2 jkl1 jkl1a">

					<div class="dnn1  ffdsf">
						关注我们<br><br>
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